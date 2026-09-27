@extends('layouts.admin')

@section('title', 'withdrawal process')

@section('content')
<h1>Process Withdrawal #{{$withdrawal->id}}</h1><p>{{$withdrawal->student_no}} - {{$withdrawal->student_name}} | {{$withdrawal->withdrawal_point}} points</p><form method="POST" action="{{route('admin.finance.withdrawal.process.submit',$withdrawal->id)}}">@csrf<select name="status"><option value="Paid">Paid</option><option value="Cancel">Cancel</option></select><input name="amount" placeholder="Amount"><input name="point_value" placeholder="Point value"><select name="payment_medium_id">@foreach($mediums as $m)<option value="{{$m->id}}">{{$m->medium_name}} - {{$m->medium_code}}</option>@endforeach</select><input name="transaction_id" placeholder="Transaction ID"><input name="screenshot_image" placeholder="Screenshot path (optional)"><textarea name="comment" placeholder="Comment"></textarea><button>Process</button></form><a href="{{route('admin.finance.withdrawals')}}">Back</a>
@endsection
