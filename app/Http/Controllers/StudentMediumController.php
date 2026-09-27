<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentMediumController extends Controller
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
        $mediums=DB::table('bh_student_payment_medium')->where('student_id',$student->id)->get();
        $payment=match($student->student_country){
            'India'=>['Gpay','Phone Pay','Paytm','Binance'],
            'Bangladesh'=>['Bkash','Nagad','Rocket','Binance'],
            'Nepal'=>['eSewa','Binance'],
            default=>['Binance'],
        };
        return view('student.medium',compact('student','mediums','payment'));
    }

    public function update(Request $request)
    {
        $student=$this->student($request);
        $payment=match($student->student_country){
            'India'=>['Gpay','Phone Pay','Paytm','Binance'],
            'Bangladesh'=>['Bkash','Nagad','Rocket','Binance'],
            'Nepal'=>['eSewa','Binance'],
            default=>['Binance'],
        };

        $data=$request->validate([
            'payment_medium'=>'required|array|min:1',
            'payment_medium.*.medium_name'=>'required|string',
            'payment_medium.*.medium_code'=>'required|string|max:100',
        ]);

        foreach($data['payment_medium'] as $item){
            abort_unless(in_array($item['medium_name'],$payment,true),422);
            $len=strlen($item['medium_code']);
            if(in_array($item['medium_name'],['Bkash','Nagad'],true) && $len!==11) return back()->withErrors(['payment_medium'=>'Bkash/Nagad number must be 11 digit.'])->withInput();
            if($item['medium_name']==='Rocket' && $len!==12) return back()->withErrors(['payment_medium'=>'Rocket number must be 12 digit.'])->withInput();
            if(in_array($item['medium_name'],['Gpay','Phone Pay','Paytm'],true) && $len!==10) return back()->withErrors(['payment_medium'=>'This number must be 10 digit.'])->withInput();
        }

        DB::transaction(function() use($student,$data){
            DB::table('bh_student_payment_medium')->where('student_id',$student->id)->delete();
            foreach($data['payment_medium'] as $item){
                DB::table('bh_student_payment_medium')->insert([
                    'student_id'=>$student->id,'medium_name'=>$item['medium_name'],
                    'medium_code'=>$item['medium_code'],'medium_status'=>1
                ]);
            }
        });

        return redirect()->route('student.medium')->with('success','Withdrawal Medium Successfully Updated.');
    }
}
