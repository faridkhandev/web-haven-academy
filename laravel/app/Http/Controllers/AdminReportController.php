<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AdminReportController extends Controller {
 private function guard(Request $r):void{abort_unless($r->session()->has('admin_user_id')&&(int)$r->session()->get('admin_user_group_id')===1,403);}
 public function students(Request $r){
  $this->guard($r);
  $from=$r->input('from',now()->startOfMonth()->toDateString()); $to=$r->input('to',now()->endOfMonth()->toDateString());
  $role=$r->input('role'); $userId=$r->input('user_id');
  $q=DB::table('bh_student_active_history as h')
   ->leftJoin('bh_student as s','s.id','=','h.student_id')
   ->leftJoin('bh_student as ref','ref.id','=','h.refer_student_id')
   ->whereBetween(DB::raw('DATE(h.added_on)'),[$from,$to]);
  if($role==='counsellor'&&$userId)$q->where('h.counsellor_id',$userId);
  if($role==='trainer'&&$userId)$q->where('h.refer_student_trainer_id',$userId);
  if($role==='teamleader'&&$userId)$q->where('h.refer_student_teamleader_id',$userId);
  if($role==='stl'&&$userId)$q->where('h.refer_student_seniorteamleader_id',$userId);
  if($r->filled('search'))$q->where(function($x)use($r){$x->where('s.student_name','like','%'.$r->search.'%')->orWhere('s.student_no','like','%'.$r->search.'%')->orWhere('ref.student_no','like','%'.$r->search.'%');});
  $items=$q->select('h.id','h.added_on','s.student_name','s.student_no','ref.student_name as refer_student_name','ref.student_no as refer_student_no')->orderByDesc('h.added_on')->paginate(30)->withQueryString();
  $users=DB::table('bh_user')->whereIn('user_group_id',[11,12,13,15])->where('status',1)->orderBy('firstname')->get();
  return view('admin.reports.students',compact('items','users','from','to','role','userId'));
 }
}