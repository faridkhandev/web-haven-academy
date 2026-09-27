@extends('layouts.admin')

@section('title', 'index')

@push('head')
<style>body{font-family:Arial;background:#f5f7fb;margin:0;color:#1f2937}.wrap{max-width:1100px;margin:auto;padding:25px}.bar{display:flex;justify-content:space-between;align-items:center}.card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:18px;margin-top:18px}select,input{padding:9px;border:1px solid #d0d5dd;border-radius:7px}button,.btn{padding:9px 12px;border:0;border-radius:7px;background:#2563eb;color:#fff;text-decoration:none}.row{display:grid;grid-template-columns:1fr 1fr;gap:20px}.list{max-height:520px;overflow:auto;border:1px solid #eee;padding:10px}.item{padding:7px;border-bottom:1px solid #f1f1f1}.muted{color:#667085}.ok{color:#15803d}@media(max-width:700px){.row{grid-template-columns:1fr}}</style>
@endpush

@section('content')
<div class="wrap"><div class="bar"><div><h1>Admin Permissions</h1><div class="muted">Legacy-compatible user-group access and modify permissions</div></div><a class="btn" href="{{ route('admin.users.index') }}">Users</a></div>
@if(session('success'))<div class="card ok">{{ session('success') }}</div>@endif
<div class="card"><form method="GET"><label>User Group</label><select name="group_id" onchange="this.form.submit()">@foreach($groups as $g)<option value="{{ $g->user_group_id }}" @selected($g->user_group_id==$group->user_group_id)>{{ $g->name }} (#{{ $g->user_group_id }})</option>@endforeach</select></form></div>
@php
$accessRoutes = [
 'admin.dashboard','admin.reports.students',
 'admin.userfinance.passbook','admin.userfinance.payments','admin.userfinance.withdrawals',
 'admin.pointbuysell.index','admin.pointbuysell.requests','admin.pointbuysell.wallet',
 'admin.attendance.student','admin.attendance.all','admin.attendance.teacher','admin.attendance.teacher.details',
 'admin.settings.index','admin.permissions.index','admin.profile.edit',
 'admin.users.index','admin.users.create','admin.users.edit',
 'admin.students.index','admin.students.quick','admin.students.referrals','admin.students.edit',
 'admin.finance.passbook','admin.finance.payments','admin.finance.withdrawals','admin.finance.withdrawal.process',
 'admin.courses.index','admin.courses.create','admin.courses.edit',
 'admin.sessions.index','admin.sessions.create','admin.sessions.edit','admin.sessions.submissions'
];
$modifyRoutes = [
 'admin.userfinance.withdrawals.process',
 'admin.pointbuysell.accept','admin.pointbuysell.complain','admin.pointbuysell.convert','admin.pointbuysell.status',
 'admin.settings.update','admin.permissions.update','admin.profile.update',
 'admin.users.store','admin.users.update','admin.users.destroy',
 'admin.students.activate','admin.students.add-point','admin.students.remove-point','admin.students.assign-counsellor',
 'admin.students.join-approve','admin.students.join-send','admin.students.update','admin.students.block','admin.students.unblock',
 'admin.finance.withdrawal.process.submit',
 'admin.courses.store','admin.courses.update',
 'admin.sessions.store','admin.sessions.update','admin.sessions.submission.approve','admin.sessions.submission.wrong'
];
@endphp
<form method="POST" action="{{ route('admin.permissions.update') }}">@csrf<input type="hidden" name="group_id" value="{{ $group->user_group_id }}"><div class="card"><div class="row"><div><h3>Access</h3><div class="list">@foreach($accessRoutes as $route)<label class="item"><input type="checkbox" name="access[]" value="{{ $route }}" @checked(in_array($route,$permission['access'],true))> {{ $route }}</label>@endforeach</div></div><div><h3>Modify</h3><div class="list">@foreach($modifyRoutes as $route)<label class="item"><input type="checkbox" name="modify[]" value="{{ $route }}" @checked(in_array($route,$permission['modify'],true))> {{ $route }}</label>@endforeach</div></div></div><button style="margin-top:18px">Save Permissions</button></div></form></div>
@endsection
