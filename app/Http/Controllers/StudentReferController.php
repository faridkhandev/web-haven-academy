<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentReferController extends Controller
{
    private function student(Request $request): Student
    {
        $id=$request->session()->get('student_id');
        abort_unless($id,401);
        $student=Student::query()->findOrFail($id);
        abort_unless((int)$student->student_status===1,403);
        return $student;
    }

    public function index(Request $request)
    {
        $student=$this->student($request);
        return view('student.refer',['student'=>$student,'filter_start_date'=>now()->startOfMonth()->toDateString(),'filter_end_date'=>now()->endOfMonth()->toDateString()]);
    }

    public function list(Request $request)
    {
        $student=$this->student($request);
        $start=$request->input('filter_start_date',now()->startOfMonth()->toDateString());
        $end=$request->input('filter_end_date',now()->endOfMonth()->toDateString());
        $length=max(1,min((int)$request->input('length',20),100));
        $offset=max(0,(int)$request->input('start',0));

        $base=DB::table('bh_student as s')
            ->leftJoin('bh_student_to_counsellor as sc','s.id','=','sc.student_id')
            ->where('s.student_delete_status',0)->where('s.refer_id',$student->id)->where('s.student_status',0)
            ->whereDate('s.created_at','>=',$start)->whereDate('s.created_at','<=',$end);

        $total=(clone $base)->count();
        $rows=$base->select('s.id','s.student_no','s.student_name','s.student_phone','s.student_whatsapp','s.student_gender','s.created_at','s.student_status','sc.whatsapp_status')
            ->orderByDesc('s.created_at')->offset($offset)->limit($length)->get();

        return response()->json([
            'draw'=>(int)$request->input('draw',0),'recordsTotal'=>$total,'recordsFiltered'=>$total,
            'data'=>$rows->map(fn($r)=>[
                'id'=>$r->id,'student_no'=>$r->student_no,'student_name'=>$r->student_name,'student_phone'=>$r->student_phone,
                'student_whatsapp'=>$r->student_whatsapp,'student_gender'=>$r->student_gender,'created_at'=>date('Y-m-d g:i A',strtotime($r->created_at)),
                'student_status'=>(int)$r->student_status,'whatsapp_status'=>(int)($r->whatsapp_status??0)
            ])
        ]);
    }

    public function updateWhatsapp(Request $request)
    {
        $this->student($request);
        $data=$request->validate(['student_id'=>['required','integer'],'student_whatsapp'=>['required','string','max:50']]);
        $updated=DB::table('bh_student')->where('id',$data['student_id'])->where('refer_id',$request->session()->get('student_id'))->update(['student_whatsapp'=>$data['student_whatsapp']]);
        return response()->json($updated?['success'=>'Whatsapp no updated successfully']:['error'=>'Student not found.']);
    }
}
