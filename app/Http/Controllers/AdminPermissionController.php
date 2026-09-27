<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPermissionController extends Controller {
 private function guard(Request $r):void{abort_unless($r->session()->has('admin_user_id')&&(int)$r->session()->get('admin_user_group_id')===1,403);}
 private function groups(){return DB::table('bh_user_group')->orderBy('name')->get();}
 public function index(Request $r){
  $this->guard($r);
  $groups=$this->groups();
  $selected=(int)$r->input('group_id', $groups->first()->user_group_id ?? 1);
  $group=DB::table('bh_user_group')->where('user_group_id',$selected)->first();
  abort_unless($group,404);
  $permission=$this->decode($group->permission ?? '');
  return view('admin.permissions.index',compact('groups','group','permission'));
 }
 public function update(Request $r){
  $this->guard($r);
  $data=$r->validate(['group_id'=>['required','integer','exists:bh_user_group,user_group_id'],'access'=>['nullable','array'],'modify'=>['nullable','array']]);
  $group=DB::table('bh_user_group')->where('user_group_id',$data['group_id'])->first();
  abort_unless($group,404);
  $permission=['access'=>array_values(array_unique(array_map('strval',$data['access']??[]))),'modify'=>array_values(array_unique(array_map('strval',$data['modify']??[])))];
  DB::table('bh_user_group')->where('user_group_id',$data['group_id'])->update(['permission'=>serialize($permission)]);
  return redirect()->route('admin.permissions.index',['group_id'=>$data['group_id']])->with('success','Permissions updated successfully.');
 }
 private function decode($value){
  if(!$value)return ['access'=>[],'modify'=>[]];
  $p=@unserialize($value);
  if(!is_array($p)) $p=json_decode($value,true);
  return is_array($p)
   ? ['access'=>array_values(array_map('strval',$p['access']??[])),'modify'=>array_values(array_map('strval',$p['modify']??[]))]
   : ['access'=>[],'modify'=>[]];
 }
}
