<x-guest-layout>
    <div class="col-lg-6 d-none d-lg-flex auth-side-image">
        <h1 class="display-4 fw-bold">RICE<span class="text-warning">BIZ</span></h1>
        <p class="lead">Start managing your rice stocks and sales today.</p>
    </div>

    <div class="col-lg-6 p-4 p-md-5">
        <div class="mb-4">
            <h2 class="fw-bold text-dark">Register Account</h2>
            <p class="text-muted">Join our platform to streamline your business.</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger border-0 small">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mb-3">
                <label class="form-label fw-semibold small">Full Name</label>
                <input type="text" name="name" class="form-control border-light-subtle bg-light" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold small">Email Address</label>
                <input type="email" name="email" class="form-control border-light-subtle bg-light" required>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Password</label>
                    <input type="password" name="password" class="form-control border-light-subtle bg-light" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                        class="form-control border-light-subtle bg-light" required>
                </div>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mb-3 small" />

            <button type="submit" class="btn btn-dark btn-lg w-100 py-3 fw-bold shadow-sm mb-3">Create Account</button>

            <p class="text-center small text-muted">
                Already registered? <a href="{{ route('login') }}" class="fw-bold text-decoration-none">Login here</a>
            </p>
        </form>
    </div>
</x-guest-layout>