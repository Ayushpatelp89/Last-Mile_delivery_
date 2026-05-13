<x-guest-layout>
    <div class="login-card">
        <!-- Top gradient bar is in CSS ::before -->
        <div class="login-header">
            <h1 id="login-heading">Welcome back</h1>
            <p>Sign in to your dispatch hub</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="session-status" id="session-status">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" id="login-form">
            @csrf

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
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-lock"></i>
                    <input
                        id="password"
                        class="form-input"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                    >
                    <button type="button" id="toggle-password" onclick="togglePassword()" style="position:absolute;right:16px;top:50%;transform:translateY(-50%);background:none;border:none;color:var(--text-muted);cursor:pointer;z-index:2;font-size:14px;">
                        <i class="fa-solid fa-eye" id="eye-icon"></i>
                    </button>
                </div>
                @error('password')
                    <div class="input-error">
                        <ul><li>{{ $message }}</li></ul>
                    </div>
                @enderror
            </div>

            <!-- Remember Me & Forgot -->
            <div class="form-options">
                <label for="remember_me" class="remember-label">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span>Remember me</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>

            <!-- Login Button -->
            <button type="submit" class="btn-login" id="btn-login">
                <span>Sign In</span>
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </form>

        <!-- Divider -->
        <div class="divider"><span>or</span></div>

        <!-- Register Link -->
        @if (Route::has('register'))
            <div class="register-link">
                Don't have an account?
                <a href="{{ route('register') }}">Create one</a>
            </div>
        @endif
    </div>

    <script>
        function togglePassword() {
            const pw = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
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
