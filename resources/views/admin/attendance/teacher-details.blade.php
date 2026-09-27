@extends('layouts.admin')

@section('title', 'teacher details')

@push('head')
<style>body{font-family:Arial;background:#f5f7fb;margin:0;color:#1f2937}.wrap{max-width:1100px;margin:auto;padding:25px}.card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:18px;margin-top:18px}input,select{padding:9px;border:1px solid #d0d5dd;border-radius:7px}button,.btn{padding:9px 12px;border:0;border-radius:7px;background:#2563eb;color:#fff;text-decoration:none}table{width:100%;border-collapse:collapse;margin-top:15px}th,td{padding:10px;border-bottom:1px solid #eee;text-align:left}.nav a{margin-right:12px}</style>
@endpush

@section('content')
<div class="wrap"><div class="nav"><a href="{{route('admin.dashboard')}}">Dashboard</a> <a href="{{route('admin.attendance.student')}}">Student Attendance</a> <a href="{{route('admin.attendance.all')}}">All Attendance</a> <a href="{{route('admin.attendance.teacher')}}">Teacher Attendance</a></div><h1>Attendance Details: {{$teacher}}</h1><div class="card"><table><tr><th>Session No</th><th>Meeting Link</th><th>Submitted</th></tr>@foreach($items as $i)<tr><td>{{$i->session_no}}</td><td>{{Str::limit($i->meeting_link,70)}}</td><td>{{$i->submitted_at}}</td></tr>@endforeach</table>{{$items->links()}}</div></div>
@endsection
