<x-guest-layout>
    <div class="login-card">
        <div class="login-header">
            <h1 id="confirm-heading">Secure Area</h1>
            <p>This is a secure area of the application. Please confirm your password before continuing.</p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}" id="confirm-form">
            @csrf

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

            <button type="submit" class="btn-login" id="btn-confirm">
                <span>Confirm</span>
                <i class="fa-solid fa-shield-halved"></i>
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
