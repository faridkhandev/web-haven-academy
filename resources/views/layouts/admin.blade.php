<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') | {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    @stack('head')
</head>
<body class="portal admin-portal">
<header class="portal-header"><div class="container nav">
    <a class="brand" href="{{ route('admin.dashboard') }}">{{ config('app.name') }} Admin</a>
    <nav>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.students.index') }}">Students</a>
        <a href="{{ route('admin.courses.index') }}">Courses</a>
        <a href="{{ route('admin.sessions.index') }}">Sessions</a>
        <a href="{{ route('admin.finance.passbook') }}">Finance</a>
        <a href="{{ route('admin.settings.index') }}">Settings</a>
        <form class="inline" method="POST" action="{{ route('admin.logout') }}">@csrf<button class="link-button">Logout</button></form>
    </nav>
</div></header>
<main class="container page">@yield('content')</main>
@stack('scripts')
</body>
</html>
