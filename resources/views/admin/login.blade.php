@extends('layouts.auth')
@section('title','Admin Login')
@section('content')
<div class="panel" style="max-width:440px;margin:auto"><div class="muted">SUPER ADMIN</div><h1>Web Haven Academy</h1><p>Restricted admin access</p>
<form method="POST" action="{{ route('admin.login.submit') }}">@csrf
<label>Username / Email / User No.</label><input name="username" value="{{ old('username') }}" autocomplete="username" required>
<label>Password</label><input type="password" name="password" autocomplete="current-password" required>
<button class="btn" type="submit">Login</button></form></div>
@endsection