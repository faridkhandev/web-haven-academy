@extends('layouts.auth')
@section('title','Student Login')
@section('content')
<div class="panel" style="max-width:520px;margin:auto"><h1>Student Login</h1>
<form method="POST" action="{{ route('student.login.submit') }}">@csrf
<label>Phone No</label><div style="display:flex;gap:8px"><select name="country"><option value="+88">+88</option><option value="+91">+91</option><option value="+977">+977</option><option value="+966">+966</option><option value="+971">+971</option></select><input type="text" name="email" value="{{ old('email') }}" required></div>
<label>Password</label><input type="password" name="password" required>
<button class="btn" type="submit">Login</button></form></div>
@endsection