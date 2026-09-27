@extends('layouts.student')

@section('title', "Update Password")

@push('head')
<style>
body{font-family:Arial;background:#f5f7fa;margin:0;padding:40px}.box{max-width:600px;margin:auto;background:#fff;padding:28px;border-radius:16px;box-shadow:0 8px 25px #0001}label{display:block;font-weight:bold;margin:14px 0 6px}input{width:100%;box-sizing:border-box;padding:12px;border:1px solid #ddd;border-radius:10px}.btn{margin-top:20px;padding:12px 18px;border:0;border-radius:10px;background:#318d5d;color:#fff;font-weight:bold}.ok{color:green}.err{color:#b00020}
</style>
@endpush

@section('content')
<div class="box"><h1>Update Password</h1>@if(session('success'))<p class="ok">{{session('success')}}</p>@endif @if(session('error'))<p class="err">{{session('error')}}</p>@endif @if($errors->any())<p class="err">{{$errors->first()}}</p>@endif<form method="POST" action="{{route('student.password.update')}}">@csrf<label>Old Password</label><input type="password" name="student_password" required><label>New Password</label><input type="password" name="student_new_password" minlength="8" required><label>Confirm Password</label><input type="password" name="student_confirm_password" minlength="8" required><button class="btn">Update Password</button></form></div>
@endsection
