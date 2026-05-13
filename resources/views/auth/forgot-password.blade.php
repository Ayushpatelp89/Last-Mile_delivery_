<x-guest-layout>
    <div class="login-card">
        <div class="login-header">
            <h1 id="forgot-heading">Reset Password</h1>
            <p>Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="session-status" id="session-status">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" id="forgot-form">
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
                        placeholder="you@company.com"
                    >
                </div>
                @error('email')
                    <div class="input-error">
                        <ul><li>{{ $message }}</li></ul>
                    </div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-login" id="btn-forgot">
                <span>Email Password Reset Link</span>
                <i class="fa-solid fa-envelope-open-text"></i>
            </button>
        </form>

        <div class="divider"><span>or</span></div>

        <div class="register-link">
            Remembered your password?
            <a href="{{ route('login') }}">Sign In</a>
        </div>
    </div>
</x-guest-layout>
