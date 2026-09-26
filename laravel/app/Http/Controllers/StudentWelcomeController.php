<?php

namespace App\\Http\\Controllers;

use App\\Models\\Student;
use Illuminate\\Http\\Request;
use Illuminate\\Support\\Facades\\DB;

class StudentWelcomeController extends Controller
{
    public function index(Request $request)
    {
        $studentId = $request->session()->get('student_id');

        abort_unless($studentId, 401);

        $student = Student::query()->findOrFail($studentId);

        $data = [
            'student' => $student,
            'helpline_link' => '',
            'townhall_link' => '',
            'motivational_link' => '',
            'photos' => [],
            'notifications' => collect(),
            'weekly_activity' => collect(),
            'mytrainer' => [],
            'trainer' => [],
            'mytl' => [],
            'stl' => [],
            'mystl' => [],
            'week_student' => null,
            'week_trainer' => null,
            'week_teamleader' => null,
            'daily' => collect(),
        ];

        if ((int) $student->student_status === 1) {
            $data['notifications'] = DB::table('bh_notification')
                ->where('status', 1)->latest('created_at')->get();

            $data['weekly_activity'] = DB::table('weekly_activity')
                ->where('status', 1)->latest('created_at')->get();

            $trainerId = $student->link_user_id;
            if ($trainerId) {
                $data['mytrainer'] = DB::table('bh_user as u')
                    ->join('bh_user_extra as ue', 'u.user_id', '=', 'ue.user_id')
                    ->where('u.user_id', $trainerId)
                    ->select('u.firstname', 'u.lastname', 'ue.whatsapp')
                    ->first();

                $data['trainer'] = DB::table('bh_user_extra')->where('user_id', $trainerId)->first();
            }

            $teamLeaderId = $data['trainer']->link_user_id ?? null;
            if ($teamLeaderId) {
                $data['mytl'] = DB::table('bh_user as u')
                    ->join('bh_user_extra as ue', 'u.user_id', '=', 'ue.user_id')
                    ->where('u.user_id', $teamLeaderId)
                    ->select('u.firstname', 'u.lastname', 'ue.whatsapp')
                    ->first();

                $data['stl'] = DB::table('bh_user_extra')->where('user_id', $teamLeaderId)->first();
            }

            $stlId = $data['stl']->link_user_id ?? null;
            if ($stlId) {
                $data['mystl'] = DB::table('bh_user as u')
                    ->join('bh_user_extra as ue', 'u.user_id', '=', 'ue.user_id')
                    ->where('u.user_id', $stlId)
                    ->select('u.firstname', 'u.lastname', 'ue.whatsapp')
                    ->first();
            }

            $data['week_student'] = DB::table('bh_bestperformer')->where('type', 'student')->first();
            $data['week_trainer'] = DB::table('bh_bestperformer')->where('type', 'trainer')->first();
            $data['week_teamleader'] = DB::table('bh_bestperformer')->where('type', 'teamleader')->first();
            $data['daily'] = DB::table('bh_dailyperformer')->get();
        }

        return view('student.welcome', $data);
    }
}
