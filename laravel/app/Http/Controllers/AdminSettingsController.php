<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminSettingsController extends Controller {
 private function guard(Request $r):void{abort_unless($r->session()->has('admin_user_id')&&(int)$r->session()->get('admin_user_group_id')===1,403);}
 private array $fields=[
  'config_name','config_tagline','config_description','config_address','config_trn_no','config_email','config_telephone','config_fax',
  'config_money_conversion','config_subadmin_money_conversion','config_team_leader_no','config_class_join_point','config_cashback_point',
  'config_video_point','config_photo_point','config_refer_activated_point','config_refer_point','config_student_pending_point',
  'config_student_minimum_withdrawal_point','config_subadmin_minimum_withdrawal_point','config_id_activation_point',
  'config_student_minimum_withdrawal_point','config_limit_admin','config_disable_registration','config_maintenance'
 ];
 public function index(Request $r){
  $this->guard($r); $settings=$this->load(); return view('admin.settings.index',compact('settings'));
 }
 public function update(Request $r){
  $this->guard($r);
  $rules=[];
  foreach($this->fields as $key){
   $rules[$key]=str_contains($key,'email')?['nullable','email','max:190']:(str_contains($key,'description')||str_contains($key,'address')?['nullable','string','max:5000']:['nullable','string','max:255']);
  }
  $data=$r->validate($rules);
  foreach($this->fields as $key){
   if(!array_key_exists($key,$data))continue;
   DB::table('bh_setting')->where('key',$key)->delete();
   DB::table('bh_setting')->insert(['code'=>'config','key'=>$key,'value'=>$data[$key]??'','serialized'=>0]);
  }
  return back()->with('success','Settings updated successfully.');
 }
 private function load():array{
  $rows=DB::table('bh_setting')->where('code','config')->get();
  $out=[]; foreach($rows as $row)$out[$row->key]=$row->value; return $out;
 }
}
