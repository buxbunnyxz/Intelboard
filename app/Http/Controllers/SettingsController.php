<?php

namespace App\Http\Controllers;

use App\Models\Broker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $broker = $user->broker;
        $canChangePassword = is_null($user->google_id);
        return view('usersettings', compact('user', 'broker', 'canChangePassword'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'full_name'    => ['required','string','max:255'],
            'email'        => ['required','email','max:255','unique:users,email,' . $user->id],
            'phone_number' => ['required','digits:10'],
            'company_name' => ['required','string','max:255'],
            'logo'         => ['nullable','image'],
        ]);

        $user->update([
            'full_name'    => $request->full_name,
            'email'        => $request->email,
            'phone_number' => $request->phone_number,
        ]);

        $payload = ['company_name' => $request->company_name];

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('company_logos', 'public');
            $payload['logo'] = $path;
        }

        $broker = $user->broker;
        if ($broker) {
            if (isset($payload['logo']) && $broker->logo && Storage::disk('public')->exists($broker->logo)) {
                Storage::disk('public')->delete($broker->logo);
            }
            $broker->update($payload);
        } else {
            $broker = Broker::create($payload + ['user_id' => $user->id]);
        }

        $passwordChanged = false;

        if (is_null($user->google_id) && ($request->filled('current_password') || $request->filled('new_password'))) {
            $request->validate([
                'current_password' => ['required'],
                'new_password'     => ['required','string','min:8'],
            ]);

            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()
                    ->route('user.settings')
                    ->withErrors(['current_password' => __('messages.current_password_incorrect')])
                    ->withInput()
                    ->with('status', __('messages.partial_details_saved'));
            }

            $user->password = Hash::make($request->new_password);
            $user->save();
            $passwordChanged = true;
        }

        $status = __('messages.settings_saved_success');
        if ($passwordChanged) {
            $status .= ' ' . __('messages.password_changed_success');
        }

        return redirect()->route('user.settings')->with('status', $status);
    }
}