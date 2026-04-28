<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - SID Gunung Sembung')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="bg-bg-color text-text-main font-sans flex h-screen overflow-hidden antialiased">

    @include('components.admin.sidebar')

    <main class="flex-1 flex flex-col overflow-hidden">

        @include('components.admin.topbar')

        <div class="p-[30px] overflow-y-auto flex-1">
            @yield('content')
        </div>

    </main>

    @stack('scripts')
</body>
</html>