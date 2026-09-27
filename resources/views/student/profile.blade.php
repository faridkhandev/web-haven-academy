<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Student Profile</title>
    <style>
        body{font-family:Arial,sans-serif;background:#0f2027;color:#fff;margin:0}
        .wrap{max-width:1000px;margin:0 auto;padding:35px 20px}.card{background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.16);border-radius:18px;padding:24px;margin-bottom:20px}
        .grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px}.field{display:flex;flex-direction:column;gap:7px}
        label{font-weight:700}input{padding:12px;border-radius:10px;border:1px solid #ccd4df}input[disabled]{background:#eee}
        .btn{border:0;padding:11px 18px;border-radius:10px;background:#ffc107;color:#111;font-weight:700;cursor:pointer}.alert{padding:12px;border-radius:10px;background:#d4edda;color:#155724;margin-bottom:20px}
        .error{padding:12px;border-radius:10px;background:#f8d7da;color:#721c24;margin-bottom:20px}img{max-width:140px;border-radius:12px;margin-top:10px}
        .muted{opacity:.75}.actions{display:flex;gap:10px;flex-wrap:wrap}
    </style>
</head>
<body>
<div class="wrap">
    <p class="muted">Student Profile</p>
    <h1>{{ $student->student_name }}</h1>

    @if(session('success'))<div class="alert">{{ session('success') }}</div>@endif
    @if($errors->any())<div class="error">@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>@endif

    <form method="POST" action="{{ route('student.profile.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <h2>Account Information</h2>
            <p class="muted">These fields are locked for security.</p>
            <div class="grid">
                <div class="field"><label>Name</label><input value="{{ $student->student_name }}" disabled></div>
                <div class="field"><label>Email</label><input value="{{ $student->student_email }}" disabled></div>
                <div class="field"><label>Phone</label><input value="{{ $student->student_phone }}" disabled></div>
                <div class="field"><label>Gender</label><input value="{{ $student->student_gender }}" disabled></div>
                <div class="field"><label>Language</label><input value="{{ $student->student_language }}" disabled></div>
                <div class="field"><label>Country</label><input value="{{ $student->student_country }}" disabled></div>
                <div class="field"><label>WhatsApp</label><input name="student_whatsapp" value="{{ $student->student_whatsapp }}" {{ $total_whatsapp_status > 0 ? 'disabled' : '' }}>
                    @if($total_whatsapp_status > 0)<small class="muted">WhatsApp is locked until the pending verification state is resolved.</small>@endif
                </div>
            </div>
        </div>

        <div class="card">
            <h2>Editable Details</h2>
            <p class="muted">Legacy behavior: City, Facebook, YouTube and profile image can be changed.</p>
            <div class="grid">
                <div class="field"><label>City</label><input name="student_city" value="{{ old('student_city',$student->student_city) }}" required></div>
                <div class="field"><label>Facebook Profile URL</label><input type="url" name="student_fb_link" value="{{ old('student_fb_link',$student->student_fb_link) }}"></div>
                <div class="field"><label>YouTube Profile URL</label><input type="url" name="student_youtube_link" value="{{ old('student_youtube_link',$student->student_youtube_link) }}"></div>
                <div class="field"><label>Profile Image</label><input type="file" name="student_image" accept=".jpg,.jpeg,.png">
                    @if($student->student_image)<img src="{{ asset($student->student_image) }}" alt="Profile image">@endif
                </div>
            </div>
        </div>

        <div class="actions">
            <button class="btn" type="submit">Update Profile</button>
            <a class="btn" href="{{ route('student.dashboard') }}">Back to Dashboard</a>
        </div>
    </form>
</div>
</body>
</html>
