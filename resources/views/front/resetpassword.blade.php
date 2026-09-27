<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Reset Password</title></head>
<body><main><h1>Reset Password</h1>
@if($errors->any())<ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>@endif
<form method="POST" action="{{ route('forgot.reset.update',['token'=>$token]) }}">@csrf
<label>Password <input type="password" name="password" required></label>
<label>Confirm Password <input type="password" name="passconf" required></label>
<button type="submit">Update Password</button>
</form>
<p><a href="{{ route('student.login') }}">Login Now</a></p></main></body></html>