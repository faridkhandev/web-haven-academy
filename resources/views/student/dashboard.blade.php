@extends('layouts.student')

@section('title', 'Dashboard')

@section('content')
<div class="panel">
    <div style="display:flex;justify-content:space-between;align-items:center;gap:15px;flex-wrap:wrap">
        <div>
            <div class="muted">Student Dashboard</div>
            <h1>{{ $student->student_name }}</h1>
        </div>
        <span class="btn {{ (int)$student->student_status === 1 ? '' : 'btn-secondary' }}">
            {{ (int)$student->student_status === 1 ? 'ACTIVE' : 'INACTIVE' }}
        </span>
    </div>
</div>

<div class="grid">
    <div class="card"><div class="muted">Student No</div><strong>{{ $student->student_no }}</strong></div>
    <div class="card"><div class="muted">Email</div><strong>{{ $student->student_email }}</strong></div>
    <div class="card"><div class="muted">Phone</div><strong>{{ $student->student_phone }}</strong></div>
    <div class="card"><div class="muted">City</div><strong>{{ $student->student_city ?: 'Not set' }}</strong></div>
    <div class="card"><div class="muted">Trainer</div><strong>{{ trim(($student->firstname ?? '').' '.($student->lastname ?? '')) ?: 'Not assigned' }}</strong></div>
    <div class="card"><div class="muted">Team Leader</div><strong>{{ trim(($student->tl_firstname ?? '').' '.($student->tl_lastname ?? '')) ?: 'Not assigned' }}</strong></div>
</div>

<div class="grid">
    <div class="card"><div class="muted">Activation Point</div><strong>{{ $activation_point ?? '—' }}</strong></div>
    <div class="card"><div class="muted">WhatsApp Pending</div><strong>{{ $total_whatsapp_status }}</strong></div>
</div>

@if ((int)$student->student_status === 0 && (float)($student->student_point ?? 0) >= (float)($activation_point ?? 0))
<div class="card">
    <strong>Activation available</strong>
    <p>You have enough points to activate your account.</p>
    <form method="POST" action="{{ route('student.profile.active') }}">
        @csrf
        <button class="btn" type="submit">Account Activation Request</button>
    </form>
</div>
@endif

<div class="card">
    <a class="btn" href="{{ route('student.profile') }}">Edit Profile</a>
    <a class="btn btn-secondary" href="{{ route('student.welcome') }}">Student Home</a>
</div>

@if ((int)$student->student_status === 1)
<div class="grid">
    <div class="card">
        <div class="muted">Referral</div>
        <p>Share your referral link via WhatsApp.</p>
        <a class="btn" target="_blank" rel="noopener" href="https://api.whatsapp.com/send?text={{ urlencode($student->refer_link ?? '') }}">New Refer Request</a>
    </div>
    <div class="card">
        <div class="muted">Copy Referral Link</div>
        <input id="copyText" value="{{ $student->refer_link ?? '' }}" readonly style="width:100%;padding:10px;border-radius:8px;border:1px solid #ddd">
        <button class="btn" type="button" id="copyButton" style="margin-top:10px">Copy</button>
    </div>
</div>
<div class="card">
    <div class="muted">Active Student Group</div>
    <p>Join the official WhatsApp group for active students.</p>
    <a class="btn" target="_blank" rel="noopener" href="https://chat.whatsapp.com/EtDN0714YFeBekqpss0hrQ">Join Now</a>
</div>
@endif
@endsection

@push('scripts')
<script>
document.getElementById('copyButton')?.addEventListener('click', async function () {
    const input = document.getElementById('copyText');
    try {
        await navigator.clipboard.writeText(input.value);
        alert('Referral link copied.');
    } catch (e) {
        input.select();
        document.execCommand('copy');
        alert('Referral link copied.');
    }
});
</script>
@endpush
