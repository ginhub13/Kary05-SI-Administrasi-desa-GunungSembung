<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - SID Gunung Sembung')</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #115E59;
            --primary-light: #14B8A6;
            --bg-color: #F1F5F9;
            --sidebar-bg: #0F172A;
            --sidebar-hover: #1E293B;
            --text-main: #0F172A;
            --text-muted: #64748B;
            --border: #E2E8F0;
            --white: #FFFFFF;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--bg-color);
            color: var(--text-main);
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* CSS Sidebar */
        .sidebar {
            width: 260px;
            background-color: var(--sidebar-bg);
            color: var(--white);
            display: flex;
            flex-direction: column;
            transition: all 0.3s;
            z-index: 10;
            flex-shrink: 0;
        }

        .brand {
            padding: 25px 20px;
            font-size: 18px;
            font-weight: 700;
            color: var(--white);
            text-decoration: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand-icon {
            background-color: var(--primary-light);
            color: var(--sidebar-bg);
            border-radius: 6px;
            padding: 2px 6px;
            font-size: 16px;
        }

        .menu {
            list-style: none;
            padding: 20px 0;
            margin: 0;
            flex-grow: 1;
            overflow-y: auto;
        }

        .menu-title {
            padding: 0 20px 10px 20px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94A3B8;
            font-weight: 600;
        }

        .menu-item a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #CBD5E1;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .menu-item a:hover {
            background-color: var(--sidebar-hover);
            color: var(--white);
        }

        .menu-item a.active {
            background-color: rgba(20, 184, 166, 0.1);
            color: var(--primary-light);
            border-left-color: var(--primary-light);
        }

        .menu-item span.icon {
            width: 24px;
            margin-right: 10px;
            font-size: 18px;
            text-align: center;
        }

        .logout {
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logout a {
            display: block;
            text-align: center;
            color: #F87171;
            text-decoration: none;
            font-weight: 600;
            padding: 10px;
            border: 1px solid rgba(248, 113, 113, 0.3);
            border-radius: 8px;
            transition: all 0.2s;
        }

        .logout a:hover {
            background-color: rgba(248, 113, 113, 0.1);
        }

        /* CSS Main Content & Topbar */
        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .topbar {
            background-color: var(--white);
            height: 70px;
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            z-index: 5;
            flex-shrink: 0;
        }

        .search {
            display: flex;
            align-items: center;
            background-color: var(--bg-color);
            border-radius: 8px;
            padding: 8px 15px;
            width: 300px;
            border: 1px solid var(--border);
        }

        .search input {
            border: none;
            background: transparent;
            outline: none;
            width: 100%;
            font-family: inherit;
            font-size: 14px;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .profile-info {
            text-align: right;
        }

        .profile-name {
            margin: 0;
            font-weight: 600;
            font-size: 14px;
        }

        .profile-role {
            margin: 0;
            font-size: 12px;
            color: var(--text-muted);
        }

        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary);
            color: var(--white);
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
            font-size: 16px;
        }

        /* Content Area */
        .content {
            padding: 30px;
            overflow-y: auto;
            flex: 1;
        }

        /* Global Admin Elements */
        .page-header {
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-header h1 {
            margin: 0;
            font-size: 24px;
            color: var(--text-main);
        }

        .btn-action {
            background-color: var(--primary);
            color: var(--white);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background 0.2s;
            text-decoration: none;
        }

        .btn-action:hover {
            background-color: #0F766E;
        }
    </style>
    @stack('styles')
</head>

<body>

    @include('components.admin.sidebar')

    <main class="main-wrapper">
        @include('components.admin.topbar')

        <div class="content">
            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>

</html>