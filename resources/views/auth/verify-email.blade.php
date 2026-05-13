<x-guest-layout>
    <div class="login-card">
        <div class="login-header">
            <h1 id="verify-heading">Verify Your Email</h1>
            <p>Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="session-status" id="session-status">
                A new verification link has been sent to the email address you provided during registration.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}" id="verify-form" style="margin-bottom: 20px;">
            @csrf
            <!-- Submit Button -->
            <button type="submit" class="btn-login" id="btn-resend">
                <span>Resend Verification Email</span>
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="width: 100%; padding: 12px; background: transparent; border: 1px solid var(--glass-border); border-radius: 14px; color: var(--text-muted); cursor: pointer; transition: all 0.3s ease;">
                Log Out
            </button>
        </form>
    </div>
</x-guest-layout>
