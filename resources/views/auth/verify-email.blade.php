<x-guest-layout>
    <div class="col-lg-6 d-none d-lg-flex auth-side-image">
        <h1 class="display-4 fw-bold">RICE<span class="text-warning">BIZ</span></h1>
        <p class="lead">Almost there! We just need to verify your identity to keep your business data secure.</p>
    </div>

    <div class="col-lg-6 p-4 p-md-5">
        <div class="mb-4">
            <h2 class="fw-bold text-dark">Verify Email</h2>
            <p class="text-muted">
                Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success border-0 shadow-sm mb-4 small">
                A new verification link has been sent to the email address you provided during registration.
            </div>
        @endif

        <div class="mt-4 d-flex flex-column gap-3">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-dark btn-lg w-100 py-3 fw-bold shadow-sm">
                    Resend Verification Email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="text-center">
                @csrf
                <button type="submit" class="btn btn-link text-decoration-none text-muted small">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>