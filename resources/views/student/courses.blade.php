@extends('layouts.student')

@section('title', 'Courses')

@section('content')
<a href="{{ route('student.welcome') }}">← Student Home</a><h1>Course List</h1>
<div class="panel"><h2>Ignite Program</h2><div class="grid">@forelse($courses as $course)<div class="card">@if($course->course_image)<img src="{{ asset('images/courses/'.$course->course_image) }}" alt="" style="width:100%;height:185px;object-fit:cover;border-radius:8px">@endif<h3>{{ $course->course_name }}</h3><a class="btn" href="{{ route('student.course.view',['id'=>$course->course_id]) }}">View Course</a></div>@empty<p>No courses available.</p>@endforelse</div></div>
<div class="panel"><h2>Elevate Program</h2><div class="grid">@forelse($betacourses as $course)<div class="card">@if($course->course_image)<img src="{{ asset('images/courses/'.$course->course_image) }}" alt="" style="width:100%;height:185px;object-fit:cover;border-radius:8px">@endif<h3>{{ $course->course_name }}</h3><span class="muted">Coming Soon</span></div>@empty<p>No courses available.</p>@endforelse</div></div>
@endsection
