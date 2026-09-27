@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="wrap">
<div class="top"><div><h1>Admin Dashboard</h1><div class="muted">Web Haven Academy</div></div>
<div><a href="{{ route('admin.profile.edit') }}">Profile</a> &nbsp; <a href="{{ route('admin.users.index') }}">Users</a> &nbsp; <a href="{{ route('admin.permissions.index') }}">Permissions</a> &nbsp; <a href="{{ route('admin.settings.index') }}">Settings</a> &nbsp; <a href="{{ route('admin.userfinance.passbook') }}">User Finance</a> &nbsp; <a href="{{ route('admin.pointbuysell.index') }}">Point Buy/Sell</a> &nbsp; <a href="{{ route('admin.reports.students') }}">Reports</a> &nbsp; <a href="{{ route('admin.attendance.student') }}">Attendance</a> &nbsp; <form style="display:inline" method="POST" action="{{ route('admin.logout') }}">@csrf<button class="logout">Logout</button></form></div></div>
<div class="grid">
<div class="card"><div class="muted">Today's New Leads</div><div class="num">{{ $todayLeads }}</div></div>
<div class="card"><div class="muted">Active Students</div><div class="num">{{ $activeStudents }}</div></div>
<div class="card"><div class="muted">Total Students</div><div class="num">{{ $totalStudents }}</div></div>
<div class="card"><div class="muted">Total Credit Points</div><div class="num">{{ number_format($totalCredit, 2) }}</div></div>
</div>
@if($groupId === 17)
<div class="grid wallet">
<div class="card"><div class="muted">Buy Point in Wallet</div><div class="num">{{ number_format($buyBalance, 2) }}</div></div>
<div class="card"><div class="muted">Sell Point in Wallet</div><div class="num">{{ number_format($sellBalance, 2) }}</div></div>
</div>
@endif
</div>
@endsection
