<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    @include('partials.flow-navbar')
    <div class="p-2 sm:ml-64 h-full dark:bg-gray-900">
        <div class="p-3 mt-16 dark:bg-gray-900">
            {{ $slot }}
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.0/dist/flowbite.min.js"></script>
</body>

</html>