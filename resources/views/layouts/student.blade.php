<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Student') | {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    @stack('head')
</head>
<body class="portal student-portal">
<header class="portal-header"><div class="container nav">
    <a class="brand" href="{{ route('student.welcome') }}">{{ config('app.name') }}</a>
    <nav>
        <a href="{{ route('student.dashboard') }}">Dashboard</a>
        <a href="{{ route('student.course') }}">Courses</a>
        <a href="{{ route('student.profile') }}">Profile</a>
        <a href="{{ route('student.passbook') }}">Passbook</a>
        <a href="{{ route('student.logout') }}">Logout</a>
    </nav>
</div></header>
<main class="container page">@yield('content')</main>
@stack('scripts')
</body>
</html>
