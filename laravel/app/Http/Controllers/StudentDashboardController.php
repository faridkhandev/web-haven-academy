<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentDashboardController extends Controller
{
    public function index(Request $request)
    {
        $studentId = $request->session()->get('student_id');
        abort_unless($studentId, 401);

        $student = Student::query()
            ->leftJoin('bh_user as u', 'bh_student.link_user_id', '=', 'u.user_id')
            ->leftJoin('bh_user_extra as ue', 'u.user_id', '=', 'ue.user_id')
            ->leftJoin('bh_user as tl', 'tl.user_id', '=', 'ue.link_user_id')
            ->where('bh_student.id', $studentId)
            ->select('bh_student.*', 'ue.user_no', 'u.firstname', 'u.lastname',
                'tl.firstname as tl_firstname', 'tl.lastname as tl_lastname')
            ->firstOrFail();

        $activationPoint = DB::table('bh_setting')
            ->where('code', 'config_id_activation_point')
            ->value('value');

        $whatsappPending = DB::table('bh_student_to_counsellor')
            ->where('student_id', $studentId)
            ->where('whatsapp_status', 0)
            ->count();

        return view('student.dashboard', [
            'student' => $student,
            'activation_point' => $activationPoint,
            'total_whatsapp_status' => $whatsappPending,
        ]);
    }
}
