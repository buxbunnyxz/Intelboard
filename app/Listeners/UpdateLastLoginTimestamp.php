<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class UpdateLastLoginTimestamp
{
    public function handle(Login $event): void
    {
        $user = $event->user;
        // Always set each successful auth (email or Google)
        $user->last_login_at = now();
        $user->save();
    }
}