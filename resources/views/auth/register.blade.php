<x-guest-layout>
    <div class="login-card">
        <div class="login-header">
            <h1 id="register-heading">Create Account</h1>
            <p>Join the dispatch hub today</p>
        </div>

        <form method="POST" action="{{ route('register') }}" id="register-form">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name">Full Name</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-user"></i>
                    <input
                        id="name"
                        class="form-input"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="John Doe"
                    >
                </div>
                @error('name')
                    <div class="input-error">
                        <ul><li>{{ $message }}</li></ul>
                    </div>
                @enderror
            </div>

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
                        value="{{ old('email') }}"
                        required
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
                <label for="password">Password</label>
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
                <label for="password_confirmation">Confirm Password</label>
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

            <!-- Register Button -->
            <button type="submit" class="btn-login" id="btn-register">
                <span>Create Account</span>
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </form>

        <div class="divider"><span>or</span></div>

        <div class="register-link">
            Already registered?
            <a href="{{ route('login') }}">Sign In</a>
        </div>
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
