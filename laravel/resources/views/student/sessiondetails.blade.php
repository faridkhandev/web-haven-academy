<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Session {{ request('session_no') }}</title><style>body{font-family:Arial;background:#f5f7fb;margin:0}.wrap{max-width:900px;margin:auto;padding:30px 20px}.card{background:#fff;border-radius:16px;padding:24px;box-shadow:0 10px 30px rgba(0,0,0,.08)}.btn{display:inline-block;padding:10px 15px;border:0;border-radius:9px;background:#1154b4;color:#fff;text-decoration:none;cursor:pointer}.success{background:#d4edda;color:#155724;padding:12px;border-radius:9px}.error{background:#f8d7da;color:#721c24;padding:12px;border-radius:9px}input{width:100%;box-sizing:border-box;padding:11px;border:1px solid #ddd;border-radius:9px;margin:8px 0 12px}</style></head><body><div class="wrap"><div class="card"><a href="{{ route('student.course.view',['id'=>$course->course_id]) }}">← Back to Course</a><h1>{{ $course->course_name }}</h1><h2>SESSION {{ request('session_no') }}</h2>
@if(!$session)<div class="error">This session is not available in your language.</div>@else
<p>Teacher: {{ $session->firstname }} {{ $session->lastname }}</p><p>Session Date: {{ $session->session_date }}</p><p>Session Time: {{ $session->session_time }}</p>
@if($studentStatus)<div class="success">Great, you already submitted task for this session.</div>
@elseif($submitStatus)<div class="success">Great, you already completed this session.</div>
@else
@if(in_array((int)$course->course_id,[2,4]))<button class="btn" onclick="document.getElementById('linkForm').style.display='block'">Submit Work Link</button>
@elseif((int)$course->course_id===3)<button class="btn" onclick="document.getElementById('uploadForm').style.display='block'">Upload Screenshot</button>@endif
@endif
@if($session->meeting_link)<p><a class="btn" target="_blank" href="{{ str_starts_with($session->meeting_link,'http') ? $session->meeting_link : 'https://'.$session->meeting_link }}">Join Meeting</a></p>@endif
@endif
<div id="message"></div>
<form id="linkForm" style="display:none" onsubmit="return submitLink(event)"><label>Work Link</label><input name="link" required><button class="btn">Send</button></form>
<form id="uploadForm" style="display:none" enctype="multipart/form-data" onsubmit="return submitUpload(event)"><label>Screenshot</label><input type="file" name="screenshot" accept=".jpg,.jpeg,.png,.gif" required><button class="btn">Send</button></form>
</div></div>
<script>
function show(m,ok=false){document.getElementById('message').innerHTML='<div class="'+(ok?'success':'error')+'">'+m+'</div>'}
async function submitLink(e){e.preventDefault();const f=new FormData(e.target);f.append('course_id','{{ $course->course_id }}');f.append('session_id','{{ $session->session_id ?? 0 }}');const r=await fetch('{{ route('student.course.addrequest') }}',{method:'POST',headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}','Accept':'application/json'},body:f});const j=await r.json();show(j.success||j.error||'Request failed',!!j.success);if(j.success)setTimeout(()=>location.reload(),800);return false}
async function submitUpload(e){e.preventDefault();const f=new FormData(e.target);f.append('course_id','{{ $course->course_id }}');f.append('session_id','{{ $session->session_id ?? 0 }}');const r=await fetch('{{ route('student.course.uploadrequest') }}',{method:'POST',headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}','Accept':'application/json'},body:f});const j=await r.json();show(j.success||j.error||'Request failed',!!j.success);if(j.success)setTimeout(()=>location.reload(),800);return false}
</script></body></html>