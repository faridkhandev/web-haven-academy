<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Forgot Password</title></head>
<body><main><h1>Forgot Password</h1>
@if(session('success'))<p>{{ session('success') }}</p>@endif
@if(session('error'))<p>{{ session('error') }}</p>@endif
@if($errors->any())<ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>@endif
<form method="POST" action="{{ route('forgot.send') }}">@csrf
<label>Email <input type="email" name="email" value="{{ old('email') }}" required></label>
<button type="submit">Send Reset Link</button>
</form>
<p><a href="{{ route('student.login') }}">Login Now</a></p></main></body></html>