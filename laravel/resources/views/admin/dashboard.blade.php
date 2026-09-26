<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin Dashboard</title>
<style>
body{margin:0;background:#f5f7fb;font-family:Arial,sans-serif;color:#1f2937}.wrap{max-width:1100px;margin:auto;padding:28px}.top{display:flex;justify-content:space-between;align-items:center;margin-bottom:22px}.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:16px}.card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:22px}.num{font-size:30px;font-weight:700;margin-top:8px}.muted{color:#667085;font-size:13px}.logout{border:0;background:#111827;color:#fff;padding:9px 14px;border-radius:8px}.wallet{margin-top:16px}
</style></head>
<body><div class="wrap">
<div class="top"><div><h1>Admin Dashboard</h1><div class="muted">Web Haven Academy</div></div>
<div><a href="{{ route('admin.users.index') }}">Users</a> &nbsp; <a href="{{ route('admin.permissions.index') }}">Permissions</a> &nbsp; <a href="{{ route('admin.settings.index') }}">Settings</a> &nbsp; <form style="display:inline" method="POST" action="{{ route('admin.logout') }}">@csrf<button class="logout">Logout</button></form></div></div>
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
</div></body></html>
