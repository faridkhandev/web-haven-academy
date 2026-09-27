<?php
namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
class StudentJoinPointController extends Controller {
 public function index(Request $r){$id=$r->session()->get('student_id');abort_unless($id,401);$student=Student::findOrFail($id);abort_unless((int)$student->student_status===1,403);return view('student.joinpoint',compact('student'));}
}