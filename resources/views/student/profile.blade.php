@extends('layouts.student')

@section('title', 'Profile')

@section('content')
<div class="panel"><p class="muted">Student Profile</p><h1>{{ $student->student_name }}</h1>
@if(session('success'))<div class="alert" style="background:#dcfce7;color:#166534">{{ session('success') }}</div>@endif
@if($errors->any())<div class="alert">@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>@endif
<form method="POST" action="{{ route('student.profile.update') }}" enctype="multipart/form-data">@csrf
<h2>Account Information</h2><div class="grid">
<div><label>Name</label><input value="{{ $student->student_name }}" disabled></div><div><label>Email</label><input value="{{ $student->student_email }}" disabled></div><div><label>Phone</label><input value="{{ $student->student_phone }}" disabled></div><div><label>Gender</label><input value="{{ $student->student_gender }}" disabled></div><div><label>Language</label><input value="{{ $student->student_language }}" disabled></div><div><label>Country</label><input value="{{ $student->student_country }}" disabled></div>
<div><label>WhatsApp</label><input name="student_whatsapp" value="{{ $student->student_whatsapp }}" {{ $total_whatsapp_status > 0 ? 'disabled' : '' }}></div></div>
<h2>Editable Details</h2><div class="grid">
<div><label>City</label><input name="student_city" value="{{ old('student_city',$student->student_city) }}" required></div>
<div><label>Facebook Profile URL</label><input type="url" name="student_fb_link" value="{{ old('student_fb_link',$student->student_fb_link) }}"></div>
<div><label>YouTube Profile URL</label><input type="url" name="student_youtube_link" value="{{ old('student_youtube_link',$student->student_youtube_link) }}"></div>
<div><label>Profile Image</label><input type="file" name="student_image" accept=".jpg,.jpeg,.png">@if($student->student_image)<img src="{{ asset($student->student_image) }}" alt="Profile image" style="max-width:140px">@endif</div>
</div><p><button class="btn" type="submit">Update Profile</button> <a class="btn btn-secondary" href="{{ route('student.dashboard') }}">Back</a></p></form></div>
@endsection
