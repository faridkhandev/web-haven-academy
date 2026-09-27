<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AdminFinanceController extends Controller {

 public function passbook(Request $r){$this->guard($r);$q=DB::table('bh_student_passbook as p')->join('bh_student as s','s.id','=','p.student_id')->select('p.*','s.student_no','s.student_name')->where('s.student_delete_status',0);if($r->filled('student_no'))$q->where('s.student_no',$r->student_no);if($r->filled('type'))$q->where('p.type',$r->type);if($r->filled('reason'))$q->where('p.reason','like','%'.$r->reason.'%');if($r->filled('from'))$q->whereDate('p.created_at','>=',$r->from);if($r->filled('to'))$q->whereDate('p.created_at','<=',$r->to);return view('admin.finance.passbook',['items'=>$q->orderByDesc('p.id')->paginate(30)->withQueryString()]);}
 public function payments(Request $r){$this->guard($r);$q=DB::table('bh_student_payment_history as p')->join('bh_student as s','s.id','=','p.student_id')->join('bh_student_withdrawal_request as w','w.id','=','p.withdrawal_request_id')->leftJoin('bh_student_payment_medium as m','m.id','=','p.payment_medium_id')->where('s.student_delete_status',0)->select('p.*','s.student_no','s.student_name','w.withdrawal_point','m.medium_name','m.medium_code');if($r->filled('student_no'))$q->where('s.student_no',$r->student_no);if($r->filled('transaction'))$q->where('p.transaction_id','like','%'.$r->transaction.'%');if($r->filled('from'))$q->whereDate('p.payment_date','>=',$r->from);if($r->filled('to'))$q->whereDate('p.payment_date','<=',$r->to);return view('admin.finance.payments',['items'=>$q->orderByDesc('p.id')->paginate(30)->withQueryString()]);}
 public function processForm(Request $r,int $withdrawal){$this->guard($r);$w=DB::table('bh_student_withdrawal_request as w')->join('bh_student as s','s.id','=','w.student_id')->where('w.id',$withdrawal)->select('w.*','s.student_no','s.student_name')->first();abort_unless($w,404);abort_if($w->approve_status!=='Pending',422);$mediums=DB::table('bh_student_payment_medium')->where('student_id',$w->student_id)->where('medium_status',1)->get();return view('admin.finance.withdrawal_process',compact('withdrawal','mediums'))->with('withdrawal',$w);}
 public function processWithdrawal(Request $r,int $withdrawal)
 {

  $data=$r->validate([
   'status'=>['required','in:Paid,Cancel'],'comment'=>['nullable','string','max:1000'],
   'amount'=>['required_if:status,Paid','numeric','min:0'],'point_value'=>['required_if:status,Paid','numeric','min:0'],
   'payment_medium_id'=>['required_if:status,Paid','integer'],'transaction_id'=>['required_if:status,Paid','string','max:255'],
   'screenshot_image'=>['nullable','string','max:500'],
  ]);
  DB::transaction(function() use($r,$withdrawal,$data){
   $w=DB::table('bh_student_withdrawal_request')->where('id',$withdrawal)->lockForUpdate()->first();
   abort_unless($w,404); abort_if($w->approve_status!=='Pending',422,'This withdrawal has already been processed.');
   if($data['status']==='Cancel'){DB::table('bh_student_withdrawal_request')->where('id',$withdrawal)->update(['approve_status'=>'Cancel','admin_message'=>$data['comment']??'','cancelled_at'=>now(),'approve_at'=>'','action_user_id'=>(int)$r->session()->get('admin_user_id')]);return;}
   $medium=DB::table('bh_student_payment_medium')->where('id',$data['payment_medium_id'])->where('student_id',$w->student_id)->first();
   abort_unless($medium,422,'Invalid payment medium.');
   abort_if(DB::table('bh_student_payment_history')->where('withdrawal_request_id',$withdrawal)->exists(),422,'Payment already recorded.');
   DB::table('bh_student_payment_history')->insert(['student_id'=>$w->student_id,'amount'=>$data['amount'],'withdrawal_request_id'=>$withdrawal,'conversion_rate'=>$data['point_value'],'payment_medium_id'=>$data['payment_medium_id'],'transaction_id'=>$data['transaction_id'],'comment'=>$data['comment']??'','screenshot_image'=>$data['screenshot_image']??'','payment_date'=>now(),'created_by'=>(int)$r->session()->get('admin_user_id')]);
   $last=DB::table('bh_student_passbook')->where('student_id',$w->student_id)->orderByDesc('id')->lockForUpdate()->first(); $balance=(float)($last->balance_point??0);
   abort_if($balance < (float)$w->withdrawal_point,422,'Insufficient student point balance.');
   DB::table('bh_student_passbook')->insert(['student_id'=>$w->student_id,'reason'=>'Amount transfer aganist '.$w->withdrawal_point,'description'=>$data['comment']??'','credit_point'=>0,'debit_point'=>$w->withdrawal_point,'balance_point'=>$balance-(float)$w->withdrawal_point,'type'=>'Debit','created_at'=>now()]);
   DB::table('bh_student_withdrawal_request')->where('id',$withdrawal)->update(['approve_status'=>'Paid','admin_message'=>$data['comment']??'','approve_at'=>now(),'cancelled_at'=>'','action_user_id'=>(int)$r->session()->get('admin_user_id')]);
  });
  return back()->with('success','Withdrawal request successfully processed.');
 }

 public function withdrawals(Request $r){$this->guard($r);$q=DB::table('bh_student_withdrawal_request as w')->join('bh_student as s','s.id','=','w.student_id')->where('s.student_delete_status',0)->select('w.*','s.student_no','s.student_name','s.student_whatsapp');if($r->filled('student_no'))$q->where('s.student_no',$r->student_no);if($r->filled('status'))$q->where('w.approve_status',$r->status);if($r->filled('from'))$q->whereDate('w.requested_at','>=',$r->from);if($r->filled('to'))$q->whereDate('w.requested_at','<=',$r->to);return view('admin.finance.withdrawals',['items'=>$q->orderByDesc('w.id')->paginate(30)->withQueryString()]);}

 private function guard(Request $request): bool
 {
     return $request->session()->has('admin_user_id');
 }

}