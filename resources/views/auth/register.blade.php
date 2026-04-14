<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Rice Business Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen" style="background-image: url('https://www.transparenttextures.com/patterns/rice-paper.png');">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border-t-8 border-green-600">
        
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-800">Create <span class="text-green-600">Account</span></h2>
            <p class="text-gray-500 mt-1">Register for the Rice System</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 px-4 py-2">
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 px-4 py-2">
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Password</label>
                <input type="password" name="password" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 px-4 py-2">
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 px-4 py-2">
            </div>

            <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 px-4 rounded-lg shadow hover:bg-green-700 transition duration-300">
                Register Account
            </button>

            <div class="mt-6 text-center border-t pt-4">
                <p class="text-sm text-gray-600">Already have an account?</p>
                <a href="{{ route('login') }}" class="text-green-600 hover:text-green-800 font-bold text-sm">Sign in here</a>
            </div>
        </form>

    </div>

</body>
</html>