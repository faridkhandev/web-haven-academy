@extends('layouts.student')

@section('title', "Withdrawal")

@push('head')
<style>
body{font-family:Arial;background:#0f2027;color:#fff;margin:0;padding:30px}.wrap{max-width:1100px;margin:auto}.grid{display:grid;grid-template-columns:repeat(4,1fr);gap:14px}.card{background:#ffffff18;padding:18px;border-radius:16px;margin-bottom:16px}.label{color:#ffc107;font-size:12px;font-weight:bold}.value{font-size:28px;margin-top:8px}.row{display:flex;gap:10px;flex-wrap:wrap}.row>*{padding:10px;border-radius:10px}.btn{background:#ffc107;border:0;font-weight:bold}.danger{color:#ffb3b3}.success{color:#9cffb5}table{width:100%;border-collapse:collapse}th,td{padding:10px;border-bottom:1px solid #ffffff22;text-align:left}@media(max-width:800px){.grid{grid-template-columns:1fr 1fr}}@media(max-width:500px){.grid{grid-template-columns:1fr}}
</style>
@endpush

@section('content')
<div class="wrap"><h1>Withdrawal</h1><div class="grid"><div class="card"><div class="label">Minimum Withdrawal</div><div class="value">{{$minimum_withdrawal_point}}</div></div><div class="card"><div class="label">Balance</div><div class="value">{{$balance_point}}</div></div><div class="card"><div class="label">Total Requested</div><div class="value">{{$total_withdrawal_request_point}}</div></div><div class="card"><div class="label">After Request</div><div class="value">{{$balance_point-$total_withdrawal_request_point}}</div></div></div><div class="card"><p>1 Point = <b>{{$money_conversion}}</b> Rs.</p>@if($status===0)<p class="danger">Pending withdrawal point: <b>{{$student_pending_point}}</b></p>@endif<form id="add" class="row">@csrf<input type="number" step="0.01" name="withdrawal_point" placeholder="Point" required><select name="payment_medium" required><option value="">Payment medium</option>@foreach($payment_medium as $m)<option value="{{$m->medium_name}} - {{$m->medium_code}}">{{$m->medium_name}} - {{$m->medium_code}}</option>@endforeach</select><input name="withdrawal_message" placeholder="Message (optional)"><button class="btn">Send Request</button></form><div id="msg"></div></div><div class="card"><form id="f" class="row">@csrf<input type="date" name="filter_start_date" value="{{$filter_start_date}}"><input type="date" name="filter_end_date" value="{{$filter_end_date}}"><select name="filter_approve_status"><option value="">All</option><option>Paid</option><option>Pending</option><option>Cancel</option></select><button class="btn">Filter</button></form></div><div class="card"><table><thead><tr><th>Point</th><th>Requested</th><th>Status</th><th>Approved</th><th>Cancelled</th><th>Comment</th></tr></thead><tbody id="rows"></tbody></table></div></div>
@endsection

@push('scripts')
<script>
const token=document.querySelector('[name=_token]').value;async function load(){let p=new URLSearchParams(new FormData(f));p.set('length',1000);let r=await fetch('{{route('student.withdrawal.list')}}',{method:'POST',headers:{'X-CSRF-TOKEN':token},body:p}),j=await r.json();rows.innerHTML=j.data.map(x=>'<tr><td>'+x.withdrawal_point+'</td><td>'+x.requested_at+'</td><td>'+x.approve_status+'</td><td>'+x.approve_at+'</td><td>'+x.cancelled_at+'</td><td>'+x.comment+'</td></tr>').join('')}f.onsubmit=e=>{e.preventDefault();load()};add.onsubmit=async e=>{e.preventDefault();let r=await fetch('{{route('student.withdrawal.add')}}',{method:'POST',headers:{'X-CSRF-TOKEN':token,'Accept':'application/json'},body:new FormData(add)}),j=await r.json();msg.innerHTML='<p class="'+(j.success?'success':'danger')+'">'+(j.success||j.error||'Request failed')+'</p>';if(j.success){add.reset();load()}};load();
</script>
@endpush
