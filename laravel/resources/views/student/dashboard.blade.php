<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Student Dashboard</title>
    <style>
        body{font-family:Arial,sans-serif;background:#0f2027;color:#fff;margin:0}
        .wrap{max-width:1100px;margin:0 auto;padding:40px 20px}
        .top{display:flex;justify-content:space-between;align-items:center;gap:15px;flex-wrap:wrap}
        .card{background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.16);border-radius:18px;padding:24px;margin-top:20px}
        .grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px}
        .label{font-size:12px;text-transform:uppercase;opacity:.7}.value{font-size:20px;font-weight:700;margin-top:7px}
        .badge{padding:8px 14px;border-radius:999px;font-weight:700;background:#ffc107;color:#111}
        .badge.active{background:#28a745;color:#fff}.btn{display:inline-block;padding:10px 16px;border-radius:10px;background:#ffc107;color:#111;text-decoration:none;font-weight:700}
        .muted{opacity:.75}
    </style>
</head>
<body>
<div class="wrap">
    <div class="top">
        <div>
            <div class="muted">Student Dashboard</div>
            <h1>{{ $student->student_name }}</h1>
        </div>
        <span class="badge {{ (int)$student->student_status === 1 ? 'active' : '' }}">
            {{ (int)$student->student_status === 1 ? 'ACTIVE' : 'INACTIVE' }}
        </span>
    </div>

    <div class="card">
        <div class="grid">
            <div><div class="label">Student No</div><div class="value">{{ $student->student_no }}</div></div>
            <div><div class="label">Email</div><div class="value">{{ $student->student_email }}</div></div>
            <div><div class="label">Phone</div><div class="value">{{ $student->student_phone }}</div></div>
            <div><div class="label">City</div><div class="value">{{ $student->student_city ?: 'Not set' }}</div></div>
            <div><div class="label">Trainer</div><div class="value">{{ trim(($student->firstname ?? '').' '.($student->lastname ?? '')) ?: 'Not assigned' }}</div></div>
            <div><div class="label">Team Leader</div><div class="value">{{ trim(($student->tl_firstname ?? '').' '.($student->tl_lastname ?? '')) ?: 'Not assigned' }}</div></div>
        </div>
    </div>

    <div class="grid">
        <div class="card"><div class="label">Activation Point</div><div class="value">{{ $activation_point ?? '—' }}</div></div>
        <div class="card"><div class="label">WhatsApp Pending</div><div class="value">{{ $total_whatsapp_status }}</div></div>
    </div>

    <div class="card">
        <a class="btn" href="{{ route('student.profile') }}">Edit Profile</a>
        <a class="btn" href="{{ route('student.welcome') }}">Student Home</a>
    </div>
</div>
</body>
</html>
