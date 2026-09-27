@extends('layouts.admin')

@section('title', 'student')

@push('head')
<style>body{font-family:Arial;background:#f5f7fb;margin:0;color:#1f2937}.wrap{max-width:1100px;margin:auto;padding:25px}.card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:18px;margin-top:18px}input,select{padding:9px;border:1px solid #d0d5dd;border-radius:7px}button,.btn{padding:9px 12px;border:0;border-radius:7px;background:#2563eb;color:#fff;text-decoration:none}table{width:100%;border-collapse:collapse;margin-top:15px}th,td{padding:10px;border-bottom:1px solid #eee;text-align:left}.nav a{margin-right:12px}</style>
@endpush

@section('content')
<div class="wrap"><div class="nav"><a href="{{route('admin.dashboard')}}">Dashboard</a> <a href="{{route('admin.attendance.student')}}">Student Attendance</a> <a href="{{route('admin.attendance.all')}}">All Attendance</a> <a href="{{route('admin.attendance.teacher')}}">Teacher Attendance</a></div><h1>Student Attendance</h1><div class="card"><form><input type="date" name="from" value="{{$from}}"> <input type="date" name="to" value="{{$to}}"> <select name="teacher_id"><option value="">All Teachers</option>@foreach($teachers as $t)<option value="{{$t->user_id}}" @selected(request('teacher_id')==$t->user_id)>{{$t->firstname}} {{$t->lastname}}</option>@endforeach</select> <button>Filter</button></form><table><tr><th>Teacher</th><th>Total Classes</th></tr>@foreach($items as $i)<tr><td>{{$i->teacher_name}}</td><td>{{$i->total_class}}</td></tr>@endforeach</table>{{$items->links()}}</div></div>
@endsection
