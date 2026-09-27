@extends('layouts.student')

@section('title', "coursedetails.blade.php")

@push('head')
<style>
body{font-family:Arial;background:#f5f7fb;margin:0}.wrap{max-width:1100px;margin:auto;padding:30px 20px}.hero,.panel{border-radius:18px;padding:25px;margin-bottom:20px;background:#fff;box-shadow:0 12px 35px rgba(0,0,0,.08)}.hero{background:#1154b4;color:#fff}.hero img{width:100px;height:70px;object-fit:cover;border-radius:10px}.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:15px}.session{padding:18px;border-radius:14px;background:#fff;border:1px solid #e5e7eb;text-decoration:none;color:#111;display:block}.btn{display:inline-block;padding:9px 14px;border-radius:10px;background:#1154b4;color:#fff;text-decoration:none}.search{padding:10px;border-radius:10px;border:1px solid #ddd;width:100%;box-sizing:border-box}
</style>
@endpush

@section('content')
<div class="wrap">
<div class="hero"><a class="btn" href="{{ route('student.course') }}">← Back</a><h1>{{ $course->course_name }}</h1><p>{{ $course->no_of_classes }} Sessions @if($complete) • Course Completed @endif</p></div>
@if($childcourses->isNotEmpty())<div class="panel"><h2>Activity Hub Courses</h2><div class="grid">@foreach($childcourses as $child)<a class="session" href="{{ route('student.course.view',['id'=>$child->course_id]) }}"><strong>{{ $child->course_name }}</strong></a>@endforeach</div></div>
@else<div class="panel"><h2>Course Description</h2><div>{!! strip_tags(html_entity_decode($course->course_description ?? '', ENT_QUOTES, 'UTF-8'), '<p><br><b><strong><ul><li>') !!}</div><h2>Course Sessions</h2><input class="search" id="search" placeholder="Search session"><div class="grid" id="sessions">@for($i=1;$i<=(int)$course->no_of_classes;$i++)<a class="session" data-session="{{ $i }}" href="{{ route('student.course.session',['id'=>$course->course_id,'session_no'=>$i]) }}"><strong>SESSION #{{ $i }}</strong><br><small>Notes • Videos • Practice</small></a>@endfor</div></div>@endif
</div>
@endsection

@push('scripts')
<script>
const s=document.getElementById('search');if(s)s.oninput=()=>document.querySelectorAll('[data-session]').forEach(x=>x.style.display=(('session '+x.dataset.session).includes(s.value.toLowerCase())?'block':'none'));
</script>
@endpush
