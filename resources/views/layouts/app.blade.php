<!doctype html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>@yield('title', config('app.name'))</title><link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">@stack('head')</head>
<body>
<header class="site-header"><div class="container nav"><a class="brand" href="{{ route('home') }}">{{ config('app.name') }}</a><nav><a href="{{ route('home') }}">Home</a><a href="{{ route('courses') }}">Courses</a><a href="{{ route('about') }}">About</a><a href="{{ route('contact') }}">Contact</a><a href="{{ route('student.login') }}">Student Login</a></nav></div></header>
<main class="container page">
@if(session('success'))<div class="alert">{{ session('success') }}</div>@endif
@if(session('error'))<div class="alert">{{ session('error') }}</div>@endif
@if($errors->any())<div class="alert">{{ $errors->first() }}</div>@endif
@yield('content')
</main>
<footer class="site-footer"><div class="container">{{ config('app.name') }}</div></footer>
@stack('scripts')
</body></html>