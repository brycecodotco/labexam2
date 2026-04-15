<x-guest-layout>
    <div class="col-lg-6 d-none d-lg-flex auth-side-image">
        <h1 class="display-4 fw-bold">RICE<span class="text-warning">BIZ</span></h1>
        <p class="lead">Efficient Inventory & Transaction Management for your Rice Business.</p>
        <div class="mt-4 pt-4 border-top border-secondary">
            <small class="text-white-50">Enterprise Edition v1.0</small>
        </div>
    </div>

    <div class="col-lg-6 p-4 p-md-5">
        <div class="mb-4">
            <h2 class="fw-bold text-dark">Welcome Back</h2>
            <p class="text-muted">Please enter your details to sign in.</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold small">Email Address</label>
                <input type="email" name="email" class="form-control form-control-lg border-light-subtle bg-light" required autofocus>
                <x-input-error :messages="$errors->get('email')" class="mt-1 small" />
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold small">Password</label>
                <input type="password" name="password" class="form-control form-control-lg border-light-subtle bg-light" required>
            </div>

            <div class="d-flex justify-content-between mb-4">
                <div class="form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="rem">
                    <label class="form-check-label small" for="rem">Remember me</label>
                </div>
                <a href="{{ route('password.request') }}" class="small text-decoration-none">Forgot Password?</a>
            </div>

            <button type="submit" class="btn btn-dark btn-lg w-100 py-3 fw-bold shadow-sm mb-3">Sign In</button>
            
            <p class="text-center small text-muted">
                Don't have an account? <a href="{{ route('register') }}" class="fw-bold text-decoration-none">Create Account</a>
            </p>
        </form>
    </div>
</x-guest-layout>