@extends('layouts.admin')

@section('title', 'login')

@push('head')
<style>
body{margin:0;background:#f5f7fb;font-family:Arial,sans-serif}
.wrap{min-height:100vh;display:grid;place-items:center;padding:24px;box-sizing:border-box}
.card{width:min(440px,100%);background:#fff;border:1px solid #e5e7eb;border-radius:14px;padding:30px;box-shadow:0 12px 35px rgba(0,0,0,.08)}
h1{margin:0 0 6px;font-size:24px}.sub{color:#667085;margin-bottom:24px}
label{display:block;font-weight:600;margin:14px 0 7px}
input{width:100%;box-sizing:border-box;padding:12px;border:1px solid #d0d5dd;border-radius:9px}
button{width:100%;margin-top:20px;padding:12px;border:0;border-radius:9px;background:#4c1d95;color:#fff;font-weight:700;cursor:pointer}
.alert{padding:11px;border-radius:8px;background:#fee4e2;color:#b42318;margin-bottom:14px}
.badge{display:inline-block;padding:6px 10px;border-radius:999px;background:#fef3f2;color:#b42318;font-size:12px;font-weight:800;margin-bottom:12px}
</style>
@endpush

@section('content')
<div class="wrap"><div class="card">
<span class="badge">SUPER ADMIN</span>
<h1>Web Haven Academy</h1>
<div class="sub">Restricted admin access</div>
@if($errors->any())<div class="alert">{{ $errors->first() }}</div>@endif
<form method="POST" action="{{ route('admin.login.submit') }}">
@csrf
<label>Username / Email / User No.</label>
<input name="username" value="{{ old('username') }}" autocomplete="username" required>
<label>Password</label>
<input type="password" name="password" autocomplete="current-password" required>
<button type="submit">Login</button>
</form>
</div></div>
@endsection
