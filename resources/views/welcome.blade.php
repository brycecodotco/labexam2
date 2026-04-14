<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rice Store - Welcome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100 dark:bg-gray-900">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-extrabold text-green-600 dark:text-green-400">🌾 RICE STORE</h1>
            <p class="text-gray-600 dark:text-gray-400">Quality Rice at Your Fingertips</p>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            
            @if (Route::has('login'))
                <div class="mb-4 flex justify-around border-b border-gray-200 dark:border-gray-700">
                    <button id="loginBtn" class="py-2 px-4 text-green-600 border-b-2 border-green-600 font-bold">Login</button>
                    <button id="registerBtn" class="py-2 px-4 text-gray-500 hover:text-green-600 font-bold">Register</button>
                </div>
            @endif

            <div id="loginForm">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password" value="Password" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="w-full justify-center bg-green-600 hover:bg-green-700">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <div id="registerForm" class="hidden">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div>
                        <x-input-label for="name" value="Name" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="reg_email" value="Email" />
                        <x-text-input id="reg_email" class="block mt-1 w-full" type="email" name="email" required />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="reg_password" value="Password" />
                        <x-text-input id="reg_password" class="block mt-1 w-full" type="password" name="password" required />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password_confirmation" value="Confirm Password" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="w-full justify-center bg-blue-600 hover:bg-blue-700">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const lBtn = document.getElementById('loginBtn');
        const rBtn = document.getElementById('registerBtn');
        const lForm = document.getElementById('loginForm');
        const rForm = document.getElementById('registerForm');

        lBtn.addEventListener('click', () => {
            lForm.classList.remove('hidden');
            rForm.classList.add('hidden');
            lBtn.classList.add('text-green-600', 'border-b-2', 'border-green-600');
            rBtn.classList.remove('text-green-600', 'border-b-2', 'border-green-600');
        });

        rBtn.addEventListener('click', () => {
            rForm.classList.remove('hidden');
            lForm.classList.add('hidden');
            rBtn.classList.add('text-green-600', 'border-b-2', 'border-green-600');
            lBtn.classList.remove('text-green-600', 'border-b-2', 'border-green-600');
        });
    </script>
</body>
</html>