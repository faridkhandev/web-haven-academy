<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StudentCourseController extends Controller
{
    private function student(Request $request): Student
    {
        $id = $request->session()->get('student_id');
        abort_unless($id, 401);
        $student = Student::findOrFail($id);
        abort_unless((int) $student->student_status === 1, 403);
        return $student;
    }

    public function index(Request $request)
    {
        $this->student($request);

        $courses = DB::table('bh_course')
            ->where('course_delete_status', 0)->where('parent_id', 0)
            ->where('course_status', 1)->where('type_id', 1)
            ->orderBy('sort_order')->get();

        $betacourses = DB::table('bh_course')
            ->where('course_delete_status', 0)->where('course_status', 1)
            ->where('type_id', 2)->orderBy('sort_order')->get();

        return view('student.courses', compact('courses', 'betacourses'));
    }

    public function view(Request $request)
    {
        $student = $this->student($request);
        $courseId = (int) $request->query('id');
        abort_unless($courseId > 0, 404);

        $course = DB::table('bh_course')->where('course_id', $courseId)->firstOrFail();
        $childcourses = DB::table('bh_course')->where('parent_id', $courseId)->orderBy('sort_order')->get();

        $completedSessions = DB::table('bh_course_to_session as cs')
            ->whereIn('cs.session_id', DB::table('bh_student_to_course_session')
                ->where('course_id', $courseId)->where('student_id', $student->id)->pluck('session_id'))
            ->count();

        $complete = (int) $course->no_of_classes <= $completedSessions;

        return view('student.coursedetails', compact('course', 'childcourses', 'complete'));
    }

    public function sessionView(Request $request)
    {
        $student = $this->student($request);
        $courseId = (int) $request->query('id');
        $sessionNo = (int) $request->query('session_no');
        abort_unless($courseId > 0 && $sessionNo > 0, 404);

        $course = DB::table('bh_course')->where('course_id', $courseId)->firstOrFail();

        $session = DB::table('bh_course_to_session as cs')
            ->join('bh_course as c', 'cs.course_id', '=', 'c.course_id')
            ->join('bh_user as u', 'cs.session_teacher_id', '=', 'u.user_id')
            ->join('bh_user_extra as ue', 'ue.user_id', '=', 'u.user_id')
            ->where('cs.delete_status', 0)
            ->where('cs.course_id', $courseId)
            ->where('cs.session_no', $sessionNo)
            ->where('ue.language', $student->student_language)
            ->orderByDesc('cs.session_id')
            ->select('cs.*', 'c.course_name', 'u.firstname', 'u.lastname')
            ->first();

        $studentStatus = $session
            ? DB::table('bh_student_to_course_session')->where([
                'course_id' => $courseId, 'session_id' => $session->session_id, 'student_id' => $student->id
            ])->first()
            : null;

        $submitStatus = $session
            ? DB::table('bh_student_to_course_session')
                ->where('course_id', $courseId)->where('student_id', $student->id)
                ->whereIn('session_id', DB::table('bh_course_to_session')->where('session_no', $sessionNo)->pluck('session_id'))
                ->where('work_status', 1)->first()
            : null;

        return view('student.sessiondetails', compact('course', 'session', 'studentStatus', 'submitStatus', 'student'));
    }

    public function addRequest(Request $request)
    {
        $student = $this->student($request);

        $data = $request->validate([
            'link' => ['required', 'string', 'max:2000'],
            'course_id' => ['required', 'integer'],
            'session_id' => ['required', 'integer'],
        ]);

        if (DB::table('bh_student_to_course_session')->where('student_id', $student->id)->whereDate('date_added', now()->toDateString())->exists()) {
            return response()->json(['error' => 'You already submitted one task for today, you can not submit more. Submit tomorrow.'], 422);
        }

        DB::table('bh_student_to_course_session')
            ->where('student_id', $student->id)->where('session_id', $data['session_id'])->where('course_id', $data['course_id'])->delete();

        DB::table('bh_student_to_course_session')->insert([
            'student_id' => $student->id, 'session_id' => $data['session_id'], 'course_id' => $data['course_id'],
            'work_link' => trim($data['link']), 'point_status' => 2, 'date_added' => now(),
        ]);

        return response()->json(['success' => 'Your request successfully send to admin.']);
    }

    public function uploadRequest(Request $request)
    {
        $student = $this->student($request);

        $data = $request->validate([
            'screenshot' => ['required', 'image', 'mimes:jpg,jpeg,png,gif', 'max:5120'],
            'course_id' => ['required', 'integer'],
            'session_id' => ['required', 'integer'],
        ]);

        if (DB::table('bh_student_to_course_session')->where([
            'student_id' => $student->id, 'course_id' => $data['course_id'], 'session_id' => $data['session_id']
        ])->exists()) {
            return response()->json(['error' => 'You already submitted task for this course and session.'], 422);
        }

        if (DB::table('bh_student_to_course_session')->where('student_id', $student->id)->whereDate('date_added', now()->toDateString())->exists()) {
            return response()->json(['error' => 'You already submitted one task for today, you can not submit more. Submit tomorrow.'], 422);
        }

        $name = Str::uuid()->toString().'.'.$request->file('screenshot')->getClientOriginalExtension();
        $request->file('screenshot')->move(public_path('uploads'), $name);

        DB::table('bh_student_to_course_session')->insert([
            'student_id' => $student->id, 'session_id' => $data['session_id'], 'course_id' => $data['course_id'],
            'work_link' => asset('uploads/'.$name), 'point_status' => 2, 'date_added' => now(),
        ]);

        return response()->json(['success' => 'Your request successfully send to admin.']);
    }
}
