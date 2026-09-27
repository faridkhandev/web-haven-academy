<!doctype html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', config('app.name')) | {{ config('app.name') }}</title>
<link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">@stack('head')</head>
<body><main class="container page">
@if(session('success'))<div class="alert">{{ session('success') }}</div>@endif
@if(session('error'))<div class="alert">{{ session('error') }}</div>@endif
@if($errors->any())<div class="alert">{{ $errors->first() }}</div>@endif
@yield('content')</main>@stack('scripts')</body></html>