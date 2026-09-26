<?php
namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class StudentPasswordController extends Controller {
 public function edit(Request $r){$s=Student::findOrFail($r->session()->get('student_id'));abort_unless((int)$s->student_status===1,403);return view('student.password');}
 public function update(Request $r){$s=Student::findOrFail($r->session()->get('student_id'));abort_unless((int)$s->student_status===1,403);$d=$r->validate(['student_password'=>'required','student_new_password'=>'required|string|min:8','student_confirm_password'=>'required|same:student_new_password']);$valid=Hash::check($d['student_password'],$s->student_password)||hash('md5',$d['student_password'])===$s->student_password;if(!$valid)return back()->withInput()->with('error','Your old password is not correct, try again.');$s->student_password=Hash::make($d['student_new_password']);$s->save();return back()->with('success','Your password information successfully updated.');}
}