<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Forgot Password</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Flowbite CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="flex flex-col lg:flex-row w-full max-w-6xl bg-white rounded-2xl shadow-2xl overflow-hidden">

            <!-- Left Section -->
            <div class="hidden lg:flex w-full lg:w-1/2 bg-gradient-to-br from-blue-400 to-indigo-500 text-white p-8 lg:p-12 flex-col justify-center relative overflow-hidden">
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
                        <!-- Lock Icon -->
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-2xl mb-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h1 class="text-4xl lg:text-5xl font-bold mb-2">LUMEN GENERATION</h1>
                        <div class="w-20 h-1 bg-white/60 rounded-full mx-auto lg:mx-0 mb-6"></div>
                    </div>

                    <h2 class="text-xl lg:text-2xl font-semibold text-blue-100 mb-1">
                        Account Recovery
                    </h2>
                    <h2 class="text-xl lg:text-2xl font-semibold mb-4 text-blue-100">
                        We've got you covered
                    </h2>

                    <p class="text-blue-100 leading-relaxed mb-8">
                        Forgot your password? No problem. Enter your registered email address and we'll send you a secure link to reset it instantly.
                    </p>

                    <!-- Steps -->
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-white/20 flex items-center justify-center text-xs font-bold text-white mt-0.5">1</div>
                            <p class="text-sm text-blue-100">Enter your registered email address below</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-white/20 flex items-center justify-center text-xs font-bold text-white mt-0.5">2</div>
                            <p class="text-sm text-blue-100">Check your inbox for the reset link</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-white/20 flex items-center justify-center text-xs font-bold text-white mt-0.5">3</div>
                            <p class="text-sm text-blue-100">Create a new password and regain access</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Section -->
            <div class="w-full lg:w-1/2 p-8 lg:p-12 bg-white">
                <div class="max-w-md mx-auto">

                    <!-- Header -->
                    <div class="text-center lg:text-left mb-8">
                        <h3 class="text-3xl font-bold text-gray-900 mb-2">Forgot password?</h3>
                        <p class="text-gray-600">Enter your email to receive a password reset link</p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                    <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-sm text-green-700">{{ session('status') }}</p>
                    </div>
                    @endif

                    <!-- Form -->
                    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                        @csrf

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                        <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                                        <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                                    </svg>
                                </div>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    autocomplete="email"
                                    placeholder="juan.tamad@gmail.com"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 transition duration-150 ease-in-out @error('email') border-red-500 @enderror">
                            </div>
                            @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button
                            type="submit"
                            data-test="email-password-reset-link-button"
                            class="w-full text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 text-center transition duration-150 ease-in-out transform hover:scale-105">
                            Email password reset link
                        </button>
                    </form>

                    <!-- Back to Login -->
                    <p class="mt-6 text-sm text-center text-gray-600">
                        Remember your password?
                        <a href="{{ route('login') }}" wire:navigate class="font-medium text-blue-600 hover:underline">
                            Sign in
                        </a>
                    </p>

                    <!-- Footer -->
                    <div class="mt-12 text-center">
                        <p class="text-xs text-gray-500 leading-relaxed">
                            &copy; {{ date('Y') }} LUMEN Generation.<br>
                            All rights reserved. Powered by
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium transition duration-150 ease-in-out">Git Solutions</a>
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Flowbite JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>

</html>