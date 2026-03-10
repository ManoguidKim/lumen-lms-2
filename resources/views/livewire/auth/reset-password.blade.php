<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Reset Password</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="flex flex-col lg:flex-row w-full max-w-6xl bg-white rounded-2xl shadow-2xl overflow-hidden">

            <!-- Left Section -->
            <div
                class="hidden lg:flex w-full lg:w-1/2 bg-gradient-to-br from-blue-400 to-indigo-500 text-white p-8 lg:p-12 flex-col justify-center relative overflow-hidden">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                                <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5" />
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#grid)" />
                    </svg>
                </div>

                <div class="relative z-10 text-center lg:text-left">
                    <div class="mb-6">
                        <!-- Shield Icon -->
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-2xl mb-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h1 class="text-4xl lg:text-5xl font-bold mb-2">LUMEN GROUP</h1>
                        <div class="w-20 h-1 bg-white/60 rounded-full mx-auto lg:mx-0 mb-6"></div>
                    </div>

                    <h2 class="text-xl lg:text-2xl font-semibold text-blue-100 mb-1">
                        Password Reset
                    </h2>
                    <h2 class="text-xl lg:text-2xl font-semibold mb-4 text-blue-100">
                        Secure your account
                    </h2>

                    <p class="text-blue-100 leading-relaxed mb-8">
                        Create a strong new password to protect your account. Make sure it's unique and hard to guess to
                        keep your data safe.
                    </p>

                    <!-- Tips -->
                    <div class="space-y-3">
                        <p class="text-xs font-semibold text-white/60 uppercase tracking-widest mb-3">Password Tips</p>
                        <div class="flex items-center text-sm text-blue-100">
                            <svg class="w-5 h-5 mr-3 text-blue-200 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            At least 8 characters long
                        </div>
                        <div class="flex items-center text-sm text-blue-100">
                            <svg class="w-5 h-5 mr-3 text-blue-200 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Mix of uppercase & lowercase letters
                        </div>
                        <div class="flex items-center text-sm text-blue-100">
                            <svg class="w-5 h-5 mr-3 text-blue-200 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Include numbers and special characters
                        </div>
                        <div class="flex items-center text-sm text-blue-100">
                            <svg class="w-5 h-5 mr-3 text-blue-200 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Avoid using your name or email
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Section -->
            <div class="w-full lg:w-1/2 p-8 lg:p-12 bg-white">
                <div class="max-w-md mx-auto">

                    <!-- Header -->
                    <div class="text-center lg:text-left mb-8">
                        <h3 class="text-3xl font-bold text-gray-900 mb-2">Reset password</h3>
                        <p class="text-gray-600">Please enter your new password below</p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                    <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <p class="text-sm text-green-700">{{ session('status') }}</p>
                    </div>
                    @endif

                    <!-- Form -->
                    <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                        @csrf
                        <input type="hidden" name="token" value="{{ request()->route('token') }}">

                        <!-- Email -->
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email
                                address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 16">
                                        <path
                                            d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                                        <path
                                            d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                                    </svg>
                                </div>
                                <input type="email" id="email" name="email" value="{{ request('email') }}"
                                    required autocomplete="email" placeholder="juan.tamad@gmail.com"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 transition duration-150 ease-in-out @error('email') border-red-500 @enderror">
                            </div>
                            @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">New
                                password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 16 20">
                                        <path
                                            d="M14 7h-1V4a5 5 0 1 0-10 0v3H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2ZM5 4a3 3 0 1 1 6 0v3H5V4Z" />
                                    </svg>
                                </div>
                                <input type="password" id="password" name="password" required
                                    autocomplete="new-password" placeholder="••••••••"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-10 p-2.5 transition duration-150 ease-in-out @error('password') border-red-500 @enderror">
                                <button type="button" onclick="togglePassword('password', 'eye-password')"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                                    <svg id="eye-password" class="w-4 h-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation"
                                class="block mb-2 text-sm font-medium text-gray-900">Confirm new password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 16 20">
                                        <path
                                            d="M14 7h-1V4a5 5 0 1 0-10 0v3H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2ZM5 4a3 3 0 1 1 6 0v3H5V4Z" />
                                    </svg>
                                </div>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    required autocomplete="new-password" placeholder="••••••••"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-10 p-2.5 transition duration-150 ease-in-out @error('password_confirmation') border-red-500 @enderror">
                                <button type="button"
                                    onclick="togglePassword('password_confirmation', 'eye-confirm')"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                                    <svg id="eye-confirm" class="w-4 h-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password_confirmation')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-1">
                            <button type="submit" data-test="reset-password-button"
                                class="w-full text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 text-center transition duration-150 ease-in-out transform hover:scale-105">
                                Reset password
                            </button>
                        </div>
                    </form>

                    <!-- Back to Login -->
                    <p class="mt-6 text-sm text-center text-gray-600">
                        Remember your password?
                        <a href="{{ route('login') }}" wire:navigate
                            class="font-medium text-blue-600 hover:underline">
                            Sign in
                        </a>
                    </p>

                    <!-- Footer -->
                    <div class="mt-10 text-center">
                        <p class="text-xs text-gray-500 leading-relaxed">
                            &copy; {{ date('Y') }} LUMEN Generation.<br>
                            All rights reserved. Powered by
                            <a href="https://graceit.ph"
                                class="text-blue-600 hover:text-blue-800 font-medium transition duration-150 ease-in-out">GraceIT
                                Software</a>
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script>
        function togglePassword(fieldId, iconId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            const isPassword = field.type === 'password';
            field.type = isPassword ? 'text' : 'password';
            icon.innerHTML = isPassword ?
                `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />` :
                `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
        }
    </script>
</body>

</html>