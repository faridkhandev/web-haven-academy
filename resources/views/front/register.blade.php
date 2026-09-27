@extends('layouts.app')
@section('title','Register')
@section('content')
<div class="panel"><h1>Register</h1>
@if(!$referrer)<div class="alert">Registration is available only with an active student referral code.</div>
@else
<form method="POST" action="{{ route('register.store') }}">@csrf<input type="hidden" name="refferal_code" value="{{ $referCode }}">
<div class="grid">
<label>Name<input name="student_name" value="{{ old('student_name') }}" required></label>
<label>Password<input type="password" name="student_password" required></label>
<label>Confirm Password<input type="password" name="student_confirm_password" required></label>
<label>Gender<select name="student_gender"><option>Male</option><option>Female</option></select></label>
<label>Country<select name="country" required><option value="+88">Bangladesh</option><option value="+91">India</option><option value="+966">Saudi Arabia</option><option value="+971">United Arab Emirates</option></select></label>
<label>Language<select name="student_language"><option value="Bengali">Bengali</option></select></label>
<label>Phone<input name="student_phone" value="{{ old('student_phone') }}" inputmode="numeric" required></label>
<label>WhatsApp<input name="student_whatsapp" value="{{ old('student_whatsapp') }}" inputmode="numeric" required></label>
</div><button class="btn" type="submit">Register</button></form>@endif
<p><a href="{{ route('student.login') }}">Login Now</a></p></div>
@endsection