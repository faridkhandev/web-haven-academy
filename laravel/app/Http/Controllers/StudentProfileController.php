<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StudentProfileController extends Controller
{
    public function index(Request $request)
    {
        $studentId = $request->session()->get('student_id');
        abort_unless($studentId, 401);

        $student = Student::query()->findOrFail($studentId);

        $whatsappPending = DB::table('bh_student_to_counsellor')
            ->where('student_id', $studentId)
            ->where('whatsapp_status', 0)
            ->count();

        return view('student.profile', [
            'student' => $student,
            'total_whatsapp_status' => $whatsappPending,
        ]);
    }

    public function update(Request $request)
    {
        $studentId = $request->session()->get('student_id');
        abort_unless($studentId, 401);

        $validator = Validator::make($request->all(), [
            'student_city' => ['required', 'string', 'max:255'],
            'student_fb_link' => ['nullable', 'url', 'max:1000'],
            'student_youtube_link' => ['nullable', 'url', 'max:1000'],
            'student_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $validator->validate();

        $student = Student::query()->findOrFail($studentId);
        $whatsappPending = DB::table('bh_student_to_counsellor')
            ->where('student_id', $studentId)
            ->where('whatsapp_status', 0)
            ->count();

        $data = [
            'student_city' => $request->string('student_city')->toString(),
            'student_fb_link' => $request->input('student_fb_link'),
            'student_youtube_link' => $request->input('student_youtube_link'),
        ];

        if ($request->hasFile('student_image')) {
            $file = $request->file('student_image');
            $name = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $name);
            $data['student_image'] = 'uploads/' . $name;
        }

        if ($whatsappPending > 0 && $request->filled('student_whatsapp')) {
            $data['student_whatsapp'] = $request->string('student_whatsapp')->toString();

            DB::table('bh_student_to_counsellor')
                ->where('student_id', $studentId)
                ->update(['whatsapp_status' => 1]);
        }

        $student->update($data);

        return redirect()->route('student.profile')
            ->with('success', 'Your account information successfully updated.');
    }
}
