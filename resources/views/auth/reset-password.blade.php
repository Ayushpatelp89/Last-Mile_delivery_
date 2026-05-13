<x-guest-layout>
    <div class="login-card">
        <div class="login-header">
            <h1 id="reset-heading">Choose a New Password</h1>
            <p>Please enter your new password below.</p>
        </div>

        <form method="POST" action="{{ route('password.store') }}" id="reset-form">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-envelope"></i>
                    <input
                        id="email"
                        class="form-input"
                        type="email"
                        name="email"
                        value="{{ old('email', $request->email) }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="you@company.com"
                    >
                </div>
                @error('email')
                    <div class="input-error">
                        <ul><li>{{ $message }}</li></ul>
                    </div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">New Password</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-lock"></i>
                    <input
                        id="password"
                        class="form-input"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                    >
                    <button type="button" id="toggle-password" onclick="togglePassword('password', 'eye-icon')" style="position:absolute;right:16px;top:50%;transform:translateY(-50%);background:none;border:none;color:var(--text-muted);cursor:pointer;z-index:2;font-size:14px;">
                        <i class="fa-solid fa-eye" id="eye-icon"></i>
                    </button>
                </div>
                @error('password')
                    <div class="input-error">
                        <ul><li>{{ $message }}</li></ul>
                    </div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation">Confirm New Password</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-lock"></i>
                    <input
                        id="password_confirmation"
                        class="form-input"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                    >
                    <button type="button" id="toggle-password-conf" onclick="togglePassword('password_confirmation', 'eye-icon-conf')" style="position:absolute;right:16px;top:50%;transform:translateY(-50%);background:none;border:none;color:var(--text-muted);cursor:pointer;z-index:2;font-size:14px;">
                        <i class="fa-solid fa-eye" id="eye-icon-conf"></i>
                    </button>
                </div>
                @error('password_confirmation')
                    <div class="input-error">
                        <ul><li>{{ $message }}</li></ul>
                    </div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-login" id="btn-reset">
                <span>Reset Password</span>
                <i class="fa-solid fa-check"></i>
            </button>
        </form>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const pw = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (pw.type === 'password') {
                pw.type = 'text';
                icon.className = 'fa-solid fa-eye-slash';
            } else {
                pw.type = 'password';
                icon.className = 'fa-solid fa-eye';
            }
        }
    </script>
</x-guest-layout>
