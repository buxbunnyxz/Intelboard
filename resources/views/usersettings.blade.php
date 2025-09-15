@extends('layouts.master')

@section('content')
    <div class="row pt-3">
        <div class="card cardtopb">
            <div class="card-body p-2">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-3 mb-3">
                    <h4 class="page-title m-0">{{ __('messages.company_settings') }}</h4>
                </div>

                @if (session('status'))
                    <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show" role="alert"
                        id="statusAlert">
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                        <strong>{{ __('messages.success') }} - </strong> {!! session('status') !!}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <ul class="m-0 ps-3">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('user.settings.store') }}" method="POST" enctype="multipart/form-data"
                    id="settingsForm">
                    @csrf
                    {{-- COMPANY SECTION --}}
                    <h5 class="mb-3 mt-2 text-uppercase bg-light p-2">
                        <i class="mdi mdi-office-building me-1"></i> {{ __('messages.company_section') }}
                    </h5>

                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="company_name" class="form-label">{{ __('messages.company_name') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="mdi mdi-domain"></i></span>
                                <input id="company_name" type="text" name="company_name" class="form-control"
                                    value="{{ old('company_name', optional($broker)->company_name) }}" required
                                    placeholder="{{ __('messages.company_name') }}">
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="logo" class="form-label">{{ __('messages.company_logo') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="mdi mdi-file-image"></i></span>
                                <input type="file" id="logo" name="logo" class="form-control" accept="image/*">
                            </div>
                            @if (optional($broker)->logo)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $broker->logo) }}" alt="logo"
                                        style="max-height:70px;" class="border rounded p-1 bg-white">
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- USER DETAILS --}}
                    <h5 class="mb-3 text-uppercase bg-light p-2">
                        <i class="mdi mdi-account-outline me-1"></i> {{ __('messages.user_details_section') }}
                    </h5>

                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="full_name" class="form-label">{{ __('messages.register_full_name_label') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="mdi mdi-account"></i></span>
                                <input id="full_name" type="text" name="full_name" class="form-control"
                                    value="{{ old('full_name', $user->full_name) }}" required
                                    placeholder="{{ __('messages.register_full_name_placeholder') }}">
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="email" class="form-label">{{ __('messages.register_email_label') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="mdi mdi-email"></i></span>
                                <input id="email" type="email" name="email" class="form-control"
                                    value="{{ old('email', $user->email) }}" required
                                    placeholder="{{ __('messages.register_email_placeholder') }}">
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="phone_number" class="form-label">{{ __('messages.register_phone_label') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="mdi mdi-phone"></i></span>
                                <input id="phone_number" type="text" name="phone_number" maxlength="10"
                                    inputmode="numeric" class="form-control"
                                    value="{{ old('phone_number', $user->phone_number) }}" required
                                    placeholder="{{ __('messages.register_phone_placeholder') }}">
                            </div>
                        </div>
                    </div>

                    {{-- PASSWORD / SECURITY SECTION --}}
                    @if ($canChangePassword)
                        {{-- If the user registered via email (no google_id) show current password and reveal new password on focus --}}
                        @if (empty($user->google_id))
                            <div class="col-12 mb-3">
                                <label for="current_password"
                                    class="form-label">{{ __('messages.current_password') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="mdi mdi-lock"></i></span>
                                    <input id="current_password" type="password" name="current_password"
                                        class="form-control" placeholder="{{ __('messages.current_password') }}">
                                    <span class="input-group-text toggle-visibility" data-target="#current_password"
                                        style="cursor:pointer">
                                        <i class="mdi mdi-eye-off-outline"></i>
                                    </span>
                                </div>
                            </div>

                            {{-- new password wrapper - hidden until the current_password field is focused --}}
                            <div id="newPasswordWrapper" class="col-12 mb-3 d-none">
                                <label for="new_password" class="form-label">{{ __('messages.new_password') }} - <span
                                        class="form-text">{{ __('messages.leave_blank_ignore') }}</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="mdi mdi-lock"></i></span>
                                    <input type="password" id="new_password" name="new_password" class="form-control"
                                        placeholder="{{ __('messages.new_password_placeholder') }}">
                                    <span class="input-group-text toggle-visibility" data-target="#new_password"
                                        style="cursor:pointer">
                                        <i class="mdi mdi-eye-off-outline"></i>
                                    </span>
                                </div>

                            </div>
                        @else
                            {{-- Google-registered users: keep toggle button + hidden section (no password visible by default) --}}
                            <div class="mt-2 mb-3">
                                <button type="button" class="btn btn-outline-secondary btn-sm"
                                    id="togglePasswordSection">
                                    <i class="mdi mdi-lock-reset me-1"></i> {{ __('messages.change_password') }}
                                </button>
                            </div>

                            <div id="passwordSection" class="border rounded p-3 mb-4 d-none bg-light position-relative">
                                <h6 class="text-uppercase mb-3">
                                    <i class="mdi mdi-lock-outline me-1"></i> {{ __('messages.password_section') }}
                                </h6>

                                <div class="mb-3 position-relative">
                                    <label for="current_password"
                                        class="form-label d-flex justify-content-between align-items-center">
                                        <span>{{ __('messages.current_password') }}</span>
                                        <small class="text-muted">{{ __('messages.leave_blank_ignore') }}</small>
                                    </label>
                                    <div class="input-group @error('current_password') has-error @enderror">
                                        <span class="input-group-text"><i class="mdi mdi-shield-key-outline"></i></span>
                                        <input type="password" id="current_password" name="current_password"
                                            class="form-control @error('current_password') is-invalid shake-now @enderror"
                                            placeholder="{{ __('messages.current_password') }}">
                                        <span class="input-group-text toggle-visibility" data-target="#current_password"
                                            style="cursor:pointer">
                                            <i class="mdi mdi-eye-off-outline"></i>
                                        </span>
                                    </div>
                                    @error('current_password')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- new password wrapper for google users - hidden until current_password focused --}}
                                <div id="newPasswordWrapper" class="mb-2 d-none">
                                    <label for="new_password"
                                        class="form-label">{{ __('messages.new_password') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="mdi mdi-lock"></i></span>
                                        <input type="password" id="new_password" name="new_password"
                                            class="form-control"
                                            placeholder="{{ __('messages.new_password_placeholder') }}">
                                        <span class="input-group-text toggle-visibility" data-target="#new_password"
                                            style="cursor:pointer">
                                            <i class="mdi mdi-eye-off-outline"></i>
                                        </span>
                                    </div>
                                    <div class="form-text">{{ __('messages.leave_blank_ignore') }}</div>
                                </div>
                            </div>
                        @endif
                    @endif

                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-content-save me-1"></i>
                            <span>{{ __('messages.confirm') }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    @if ($canChangePassword)
        <style>
            @keyframes shake {

                0%,
                100% {
                    transform: translateX(0);
                }

                20% {
                    transform: translateX(-6px);
                }

                40% {
                    transform: translateX(6px);
                }

                60% {
                    transform: translateX(-4px);
                }

                80% {
                    transform: translateX(4px);
                }
            }

            .shake-now {
                animation: shake 0.35s ease-in-out;
            }

            /* smooth reveal for new password field */
            #newPasswordWrapper {
                transition: max-height .18s ease, opacity .18s ease;
                overflow: hidden;
            }

            #newPasswordWrapper.d-none {
                max-height: 0;
                opacity: 0;
            }

            #newPasswordWrapper:not(.d-none) {
                max-height: 200px;
                opacity: 1;
            }
        </style>
    @endif
@endpush

@push('scripts')
    @if ($canChangePassword)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Toggle only if the toggle button exists (keeps behavior safe for email users)
                const toggleBtn = document.getElementById('togglePasswordSection');
                const section = document.getElementById('passwordSection');

                if (toggleBtn && section) {
                    toggleBtn.addEventListener('click', () => {
                        section.classList.toggle('d-none');
                        if (!section.classList.contains('d-none')) {
                            const cp = document.getElementById('current_password');
                            if (cp) cp.focus();
                        }
                    });
                }

                // Show/hide the new password wrapper when current_password is focused/blurred (applies in both branches)
                function attachCurrentPasswordReveal() {
                    const current = document.getElementById('current_password');
                    const newWrapper = document.getElementById('newPasswordWrapper');

                    if (!current || !newWrapper) return;

                    const showNew = () => newWrapper.classList.remove('d-none');
                    const hideNewIfEmpty = () => {
                        // if user hasn't typed anything, collapse the new password field
                        if (!current.value || current.value.trim() === '') {
                            newWrapper.classList.add('d-none');
                        }
                    };

                    current.addEventListener('focus', showNew, {
                        passive: true
                    });
                    current.addEventListener('input', showNew, {
                        passive: true
                    });
                    current.addEventListener('blur', function() {
                        // small timeout to allow focus to move into new password field
                        setTimeout(hideNewIfEmpty, 150);
                    });
                }

                attachCurrentPasswordReveal();

                // Visibility toggles: attach only if matching elements exist
                document.querySelectorAll('.toggle-visibility').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const targetSel = this.getAttribute('data-target');
                        const input = document.querySelector(targetSel);
                        if (!input) return;
                        if (input.type === 'password') {
                            input.type = 'text';
                            const icon = this.querySelector('i');
                            if (icon) icon.classList.replace('mdi-eye-off-outline', 'mdi-eye-outline');
                        } else {
                            input.type = 'password';
                            const icon = this.querySelector('i');
                            if (icon) icon.classList.replace('mdi-eye-outline', 'mdi-eye-off-outline');
                        }
                    });
                });
            });
        </script>
    @endif
@endpush
