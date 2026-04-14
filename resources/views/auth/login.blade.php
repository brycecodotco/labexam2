<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rice Business Management</title>
    <!-- Loads Laravel's default Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen" style="background-image: url('https://www.transparenttextures.com/patterns/rice-paper.png');">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border-t-8 border-green-600">
        
        <!-- Custom Branding / Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-800">Rice<span class="text-green-600">POS</span></h2>
            <p class="text-gray-500 mt-1">Sign in to manage your inventory & orders</p>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf <!-- Required Laravel Security Token -->

            <!-- Email Address -->
            <div class="mb-5">
                <label class="block text-gray-700 font-bold mb-2">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus 
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 px-4 py-2">
            </div>

            <!-- Password -->
            <div class="mb-5">
                <label class="block text-gray-700 font-bold mb-2">Password</label>
                <input type="password" name="password" required 
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 px-4 py-2">
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500">
                    <span class="ml-2 text-sm text-gray-600">Keep me logged in</span>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 px-4 rounded-lg shadow hover:bg-green-700 transition duration-300">
                Sign In to System
            </button>

            <!-- Register Link -->
            <div class="mt-6 text-center border-t pt-4">
                <p class="text-sm text-gray-600">Don't have an account yet?</p>
                <a href="{{ route('register') }}" class="text-green-600 hover:text-green-800 font-bold text-sm">Register a new business account</a>
            </div>
        </form>

    </div>

</body>
</html>