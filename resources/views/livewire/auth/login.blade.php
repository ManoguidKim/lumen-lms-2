<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Flowbite CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="flex flex-col lg:flex-row w-full max-w-6xl bg-white rounded-2xl shadow-2xl overflow-hidden">
            <!-- Left Section - Enhanced -->
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
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-2xl mb-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                            </svg>
                        </div>
                        <h1 class="text-4xl lg:text-5xl font-bold mb-2 text-glow">LUMEN v1.0</h1>
                        <div class="w-20 h-1 bg-white/60 rounded-full mx-auto lg:mx-0 mb-6"></div>
                    </div>

                    <h2 class="text-xl lg:text-2xl font-semibold text-blue-100 text-glow">
                        LUMEN GENERATION
                    </h2>
                    <h2 class="text-xl lg:text-2xl font-semibold mb-4 text-blue-100 text-glow">
                        Empowering Filipinos with High-Value Skills
                    </h2>

                    <p class="text-blue-100 leading-relaxed mb-8">
                        Advocating for a generation of multi-skilled, competitive, and world-class Filipino workforce. Building pathways to high-paying careers through in-demand skills training and development opportunities.
                    </p>

                    <!-- Feature highlights -->
                    <div class="space-y-3">
                        <div class="flex items-center text-sm text-blue-100">
                            <svg class="w-5 h-5 mr-3 text-blue-200" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            High-paying, in-demand skills training
                        </div>
                        <div class="flex items-center text-sm text-blue-100">
                            <svg class="w-5 h-5 mr-3 text-blue-200" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            World-class workforce development
                        </div>
                        <div class="flex items-center text-sm text-blue-100">
                            <svg class="w-5 h-5 mr-3 text-blue-200" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Multi-skilled, competitive professionals
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Section - Enhanced with Flowbite -->
            <div class="w-full lg:w-1/2 p-8 lg:p-12 bg-white">
                <div class="max-w-md mx-auto">
                    <!-- Header -->
                    <div class="text-center lg:text-left mb-8">
                        <h3 class="text-3xl font-bold text-gray-900 mb-2 text-glow">Welcome back</h3>
                        <p class="text-gray-600">Please sign in to your account</p>
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Login Form with Flowbite components -->
                    <form method="POST" action="{{ route('login.store') }}" class="space-y-6">
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
                                <input type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    autocomplete="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 transition duration-150 ease-in-out @error('email') border-red-500 @enderror"
                                    placeholder="juan.tamad@gmail.com">
                            </div>
                            @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                        <path d="M14 7h-1V4a5 5 0 1 0-10 0v3H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2ZM5 4a3 3 0 1 1 6 0v3H5V4Z" />
                                    </svg>
                                </div>
                                <input type="password"
                                    id="password"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 transition duration-150 ease-in-out @error('password') border-red-500 @enderror"
                                    placeholder="••••••••">
                            </div>
                            @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember me and Forgot password -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember"
                                        name="remember"
                                        aria-describedby="remember"
                                        type="checkbox"
                                        {{ old('remember') ? 'checked' : '' }}
                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500">Remember me</label>
                                </div>
                            </div>
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" wire:navigate class="text-sm font-medium text-blue-600 hover:underline">Forgot password?</a>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            data-test="login-button"
                            class="w-full text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 text-center transition duration-150 ease-in-out transform hover:scale-105">
                            Sign in to your account
                        </button>
                    </form>

                    <!-- Sign Up Link -->
                    @if (Route::has('register'))
                    <p class="mt-6 text-sm text-center text-gray-600">
                        Don't have an account?
                        <a href="{{ route('register') }}" wire:navigate class="font-medium text-blue-600 hover:underline">
                            Sign up
                        </a>
                    </p>
                    @endif

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