@extends('layouts.student')

@section('title', "Welcome | Student Panel")

@push('head')
<style>

body{margin:0;background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);color:#fff;font-family:Arial,sans-serif}
.wrap{max-width:1100px;margin:auto;padding:28px 18px}.card{background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.16);border-radius:18px;padding:20px;margin:14px 0}.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:14px}.btn{display:inline-block;padding:10px 16px;border-radius:999px;background:#ffc107;color:#111;text-decoration:none;font-weight:700}.muted{opacity:.75}.img{width:100%;height:210px;object-fit:cover;border-radius:12px}.pill{font-weight:800;color:#ffc107}

</style>
@endpush

@section('content')
<div class="wrap">
<div class="card" style="display:flex;justify-content:space-between;gap:15px;flex-wrap:wrap;align-items:center">
<div><h1>Welcome to Student Panel</h1><div class="muted">Web Haven Media • Learn • Grow • Earn</div></div>
<div><a class="btn" href="{{ route('student.dashboard') }}">Student Profile</a>
<a class="btn" target="_blank" href="https://www.facebook.com/profile.php?id=100094887172397">Teacher FB</a></div></div>

@if((int)$student->student_status===1)
<div class="card"><h2>Your Growth Hub</h2><p class="muted">Access courses, updates, performers, meetings, gallery and support.</p>
<a class="btn" href="{{ route('student.course') }}">Our Course</a></div>

<div class="grid">
<div class="card"><h3>Help line</h3><p class="muted">Support & assistance</p>@if($helpline_link)<a class="btn" href="{{ $helpline_link }}">Click Here</a>@else<span class="muted">Upcoming</span>@endif</div>
<div class="card"><h3>Town hall Meeting</h3><p class="muted">Company updates & Q/A</p>@if($townhall_link)<a class="btn" href="{{ $townhall_link }}">Click Here</a>@else<span class="muted">Upcoming</span>@endif</div>
</div>

@if($notifications->count())<div class="card"><h2 class="pill">Notifications</h2>@foreach($notifications as $n)<div style="padding:12px 0;border-bottom:1px solid #ffffff22">{{ $n->notifcation ?? $n->notification ?? '' }}</div>@endforeach</div>@endif

@if($daily->count())<div class="card"><h2 class="pill">Daily Best Performer</h2><div class="grid">@foreach($daily as $item)<div><img class="img" src="https://webhavenmedia.com/weblogin/image/{{ $item->entity_image }}" alt=""><h3>{{ $item->entity_name }}</h3><div class="muted">{{ strtoupper($item->type) }} • {{ $item->entity_no }}</div><p class="muted">{{ $item->entity_description }}</p></div>@endforeach</div></div>@endif

@if($week_student)<div class="card"><h2 class="pill">Weekly Best Performer</h2><img class="img" src="https://webhavenmedia.com/weblogin/image/{{ $week_student->entity_image }}" alt=""><h3>{{ $week_student->entity_name }}</h3><p class="muted">{{ $week_student->entity_description }}</p></div>@endif

<div class="card"><h2 class="pill">My Team</h2><div class="grid">
@foreach([['My Trainer',$mytrainer],['My Team Leader',$mytl],['My STL',$mystl]] as [$label,$person])
@if($person)<div><h3>{{ $label }}</h3><p>{{ $person->firstname }} {{ $person->lastname }}</p>@if($person->whatsapp)<a class="btn" target="_blank" href="https://api.whatsapp.com/send?phone={{ $person->whatsapp }}">WhatsApp</a>@endif</div>@endif
@endforeach
</div></div>
@endif

@if($photos)<div class="card"><h2 class="pill">Photo Zoon</h2><div class="grid">@foreach($photos as $photo)<a target="_blank" href="{{ $photo }}"><img class="img" src="{{ $photo }}" alt="photo"></a>@endforeach</div></div>@endif

@if((int)$student->student_status===1)
<div class="card"><h2 class="pill">Weekly Leaders</h2><div class="grid">
@foreach([['Weekly Best Trainer',$week_trainer],['Weekly Best TL',$week_teamleader]] as [$label,$item])
@if($item)<div><h3>{{ $label }}</h3><img class="img" src="https://webhavenmedia.com/weblogin/image/{{ $item->entity_image }}" alt=""><strong>{{ $item->entity_name }}</strong><p class="muted">{{ $item->entity_description }}</p></div>@endif
@endforeach</div></div>

@if($weekly_activity->count())<div class="card"><h2 class="pill">Weekly Activity</h2><div class="grid">@foreach($weekly_activity as $item)<div><h3>{{ $item->name }}</h3><p class="muted">{{ $item->description }}</p></div>@endforeach</div></div>@endif

<div class="card"><h2 class="pill">Motivational Speech</h2>@if($motivational_link)<a class="btn" href="{{ $motivational_link }}">Click Here</a>@else<span class="muted">Upcoming</span>@endif</div>
@else
<div class="card"><h2>Account awaiting activation</h2><p class="muted">Complete activation from your Student Profile when eligible.</p></div>
@endif
</div>
@endsection
