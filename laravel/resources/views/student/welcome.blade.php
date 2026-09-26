<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome | Student Panel - Web Haven Media</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div><h1>Welcome, {{ $student->student_name }}</h1><p class="text-white-50 mb-0">Web Haven Media Student Panel</p></div>
        <a class="btn btn-warning" href="{{ url('/student/dashboard') }}">Student Profile</a>
    </div>

    @if ((int) $student->student_status === 1)
        <div class="row g-3">
            <div class="col-md-6"><div class="card bg-secondary text-white p-3"><h5>Help line</h5><p>Support & assistance</p>@if($helpline_link)<a class="btn btn-warning" href="{{ $helpline_link }}">Click Here</a>@endif</div></div>
            <div class="col-md-6"><div class="card bg-secondary text-white p-3"><h5>Town hall Meeting</h5><p>Company updates & Q/A</p>@if($townhall_link)<a class="btn btn-warning" href="{{ $townhall_link }}">Click Here</a>@endif</div></div>
        </div>

        <div class="mt-4"><h3>Notifications</h3>
            @forelse($notifications as $notification)<div class="alert alert-info">{{ $notification->title ?? $notification->description ?? 'New notification' }}</div>@empty<p class="text-white-50">No notifications.</p>@endforelse
        </div>
    @else
        <div class="alert alert-info">Your account is awaiting activation.</div>
    @endif
</div>
</body>
</html>
