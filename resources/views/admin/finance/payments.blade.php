@extends('layouts.admin')

@section('title', 'payments')

@push('head')
<style>body{font-family:Arial;background:#f5f7fb;margin:0}.wrap{max-width:1250px;margin:auto;padding:25px}.card{background:#fff;padding:18px;border:1px solid #e5e7eb;border-radius:12px;margin-top:18px}input,button{padding:8px;border:1px solid #ddd;border-radius:6px}table{width:100%;border-collapse:collapse;margin-top:15px}th,td{padding:8px;border-bottom:1px solid #eee;text-align:left}</style>
@endpush

@section('content')
<div class="wrap"><h1>Student Payments</h1><a href="{{route('admin.dashboard')}}">Dashboard</a><div class="card"><form><input name="student_no" placeholder="Student ID" value="{{request('student_no')}}"><input name="transaction" placeholder="Transaction ID" value="{{request('transaction')}}"><input type="date" name="from" value="{{request('from')}}"><input type="date" name="to" value="{{request('to')}}"><button>Filter</button></form><table><tr><th>Date</th><th>Student</th><th>Amount</th><th>Points</th><th>Rate</th><th>Medium</th><th>Transaction</th></tr>@foreach($items as $i)<tr><td>{{$i->payment_date}}</td><td>{{$i->student_no}} - {{$i->student_name}}</td><td>{{$i->amount}}</td><td>{{$i->withdrawal_point}}</td><td>{{$i->conversion_rate}}</td><td>{{$i->medium_name}} {{$i->medium_code ? '('.$i->medium_code.')':''}}</td><td>{{$i->transaction_id}}</td></tr>@endforeach</table>{{$items->links()}}</div></div>
@endsection
