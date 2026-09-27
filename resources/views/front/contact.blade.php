<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Contact</title></head>
<body><main>
<h1>Contact For Any Query</h1>
<p>Our Contact: Ruma, Rahul</p>
<p>Our Email: Webhaven755@gmail.com</p>
<p>Our Address: No Physical Address</p>
@if(session('success'))<p>{{ session('success') }}</p>@endif
@if(session('error'))<p>{{ session('error') }}</p>@endif
@if($errors->any())<ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>@endif
<form method="POST" action="{{ route('contact.send') }}">@csrf
<input name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required>
<input name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required>
<input type="email" name="email" placeholder="Your Email" value="{{ old('email') }}" required>
<input name="subject" placeholder="Subject" value="{{ old('subject') }}" required>
<textarea name="message" placeholder="Message" required>{{ old('message') }}</textarea>
<button type="submit">Send Message</button>
</form>
</main></body></html>