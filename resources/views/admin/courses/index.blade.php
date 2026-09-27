@extends('layouts.admin')

@section('title', 'index')

@section('content')
<h1>Courses</h1><a href="{{route('admin.dashboard')}}">Dashboard</a> <a href="{{route('admin.courses.create')}}">Add Course</a>@if(session('success'))<p>{{session('success')}}</p>@endif<form><input name="name" placeholder="Course name" value="{{request('name')}}"><select name="status"><option value="">All</option><option value="1" @selected(request('status')==='1')>Active</option><option value="0" @selected(request('status')==='0')>Inactive</option></select><button>Filter</button></form><table border="1" cellpadding="8"><tr><th>Name</th><th>Classes</th><th>Priority</th><th>Point</th><th>Status</th><th>Action</th></tr>@forelse($courses as $c)<tr><td>{{$c->course_name}}</td><td>{{$c->no_of_classes}}</td><td>{{$c->priority}}</td><td>{{$c->per_session_point}}</td><td>{{$c->course_status?'Active':'Inactive'}}</td><td><a href="{{route('admin.courses.edit',$c->course_id)}}">Edit</a></td></tr>@empty<tr><td colspan="6">No courses found.</td></tr>@endforelse</table>{{$courses->links()}}
@endsection
