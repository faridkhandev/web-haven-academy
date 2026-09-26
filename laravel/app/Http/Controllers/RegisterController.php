<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(Request $request)
    {
        $referCode = (string) $request->query('refer_id', '');
        $referrer = null;

        if ($referCode !== '') {
            $referrer = Student::where('student_status', 1)
                ->where('student_delete_status', 0)
                ->where('student_no', $this->decodeStudentNo($referCode))
                ->first();
        }

        return view('front.register', compact('referCode', 'referrer'));
    }

    public function store(Request $request)
    {
        $country = (string) $request->input('country');
        $lengths = ['+88'=>11, '+91'=>10, '+966'=>9, '+971'=>9];

        $phoneLength = $lengths[$country] ?? 10;

        $request->validate([
            'student_name' => ['required','string','min:3','max:30'],
            'student_password' => ['required','string','min:8','regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&#]).{8,}$/'],
            'student_confirm_password' => ['required','same:student_password'],
            'student_gender' => ['required','in:Male,Female'],
            'country' => ['required','in:+88,+91,+966,+971'],
            'student_language' => ['required','in:Bengali'],
            'student_phone' => ['required','regex:/^\d{'.$lengths[$country].'}$/'],
            'student_whatsapp' => ['required','regex:/^\d{'.$lengths[$country].'}$/'],
        ]);

        $phone = $country.$request->input('student_phone');
        $whatsapp = $country.$request->input('student_whatsapp');

        if (Student::where('student_phone',$phone)->orWhere('student_whatsapp',$whatsapp)->exists()) {
            return back()->withInput()->with('error','Phone Number or Whatsapp No already exist. Try another no.');
        }

        $referCode = (string) $request->input('refferal_code', '');
        $referrer = null;
        if ($referCode !== '') {
            $studentNo = $this->decodeStudentNo($referCode);
            $referrer = Student::where('student_status',1)->where('student_delete_status',0)
                ->where('student_no',$studentNo)->first();
            if (!$referrer) {
                return back()->withInput()->with('error','Your refer ID is inactive, You can not join by this refer ID.');
            }
        } else {
            return back()->withInput()->with('error','Registration is disable without active student refer code. Please contact your trainer or team leader.');
        }

        $countryName = ['+91'=>'India','+88'=>'Bangladesh','+966'=>'Saudi Arabia','+971'=>'United Arab Emirates'][$country];

        $student = DB::transaction(function () use ($request,$country,$countryName,$phone,$whatsapp,$referrer) {
            $student = new Student();
            $student->student_name = $request->input('student_name');
            $student->student_phone = $phone;
            $student->student_whatsapp = $whatsapp;
            $student->student_telegram = '';
            $student->student_gender = $request->input('student_gender');
            $student->student_city = '';
            $student->student_language = $request->input('student_language');
            $student->student_email = '';
            $student->student_password = Hash::make($request->input('student_password'));
            $student->student_country = $countryName;
            $student->student_point = 0;
            $student->link_user_id = 0;
            $student->refer_id = $referrer?->id ?? 0;
            $student->refer_link = '';
            $student->student_status = 0;
            $student->student_delete_status = 0;
            $student->created_by = 0;
            $student->updated_by = 0;
            $student->created_at = now();
            $student->updated_at = now();
            $student->save();

            $student->student_no = 1000000 + $student->id;
            $student->refer_link = url('/register').'?refer_id='.md5($student->student_no);
            $student->save();

            if ($referrer) {
                $point = (int) DB::table('bh_setting')->where('setting_key','config_refer_point')->value('setting_value');
                if ($point !== 0) {
                    $last = DB::table('bh_student_passbook')->where('student_id',$referrer->id)->latest('id')->first();
                    $balance = (int)($last->balance_point ?? 0) + $point;
                    DB::table('bh_student_passbook')->insert([
                        'student_id'=>$referrer->id,'reason'=>'Student Refer',
                        'description'=>'Point earn for refer '.$student->student_name,
                        'credit_point'=>$point,'balance_point'=>$balance,'debit_point'=>0,
                        'type'=>'Credit','created_at'=>now()
                    ]);
                    DB::table('bh_student')->where('id',$referrer->id)->update([
                        'student_point'=>$balance,'updated_at'=>now()
                    ]);
                }
            }
            return $student;
        });

        return redirect()->route('student.login')->with('success',
            'আপনার অ্যাকাউন্ট সফলভাবে তৈরি হয়েছে। স্টুডেন্ট আইডি: '.$student->student_no.' লগইন করার জন্য আপনার মোবাইল নম্বর এবং পাসওয়ার্ড ব্যবহার করুন।');
    }

    private function decodeStudentNo(string $code): ?int
    {
        $student = Student::where('student_status', 1)
            ->where('student_delete_status', 0)
            ->whereRaw('MD5(student_no) = ?', [$code])
            ->first(['student_no']);

        return $student ? (int) $student->student_no : null;
    }
}
