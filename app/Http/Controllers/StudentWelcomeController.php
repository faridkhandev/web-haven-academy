<?php

namespace App\\Http\\Controllers;

use App\\Models\\Student;
use Illuminate\\Http\\Request;
use Illuminate\\Support\\Facades\\DB;

class StudentWelcomeController extends Controller
{
    private function setting(string $key, $default = null)
    {
        $row = DB::table('bh_setting')->where('key', $key)->first();
        if (!$row) return $default;
        return !empty($row->serialized) ? @unserialize($row->value) : $row->value;
    }

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
            'mytrainer' => null,
            'mytl' => null,
            'mystl' => null,
            'week_student' => null,
            'week_trainer' => null,
            'week_teamleader' => null,
            'daily' => collect(),
        ];

        $video = $this->setting('video_module', []);
        foreach (($video['items'] ?? []) as $item) {
            if (!empty($item['image'])) $data['photos'][] = 'https://webhavenmedia.com/weblogin/image/'.$item['image'];
        }

        if ((int) $student->student_status === 1) {
            foreach (['helpline_module'=>'helpline_link','townhall_module'=>'townhall_link','motivational_module'=>'motivational_link'] as $key=>$field) {
                $module = $this->setting($key, []);
                $data[$field] = $module['items'][1]['link'] ?? '';
            }

            $data['notifications'] = DB::table('bh_notification')->where('status',1)->latest('created_at')->get();
            $data['weekly_activity'] = DB::table('weekly_activity')->where('status',1)->latest('created_at')->get();

            if ($student->link_user_id) {
                $data['mytrainer'] = DB::table('bh_user as u')->join('bh_user_extra as ue','u.user_id','=','ue.user_id')
                    ->where('u.user_id',$student->link_user_id)->select('u.firstname','u.lastname','ue.whatsapp')->first();
                $trainer = DB::table('bh_user_extra')->where('user_id',$student->link_user_id)->first();
                if ($trainer?->link_user_id) {
                    $data['mytl'] = DB::table('bh_user as u')->join('bh_user_extra as ue','u.user_id','=','ue.user_id')
                        ->where('u.user_id',$trainer->link_user_id)->select('u.firstname','u.lastname','ue.whatsapp')->first();
                    $stl = DB::table('bh_user_extra')->where('user_id',$trainer->link_user_id)->first();
                    if ($stl?->link_user_id) {
                        $data['mystl'] = DB::table('bh_user as u')->join('bh_user_extra as ue','u.user_id','=','ue.user_id')
                            ->where('u.user_id',$stl->link_user_id)->select('u.firstname','u.lastname','ue.whatsapp')->first();
                    }
                }
            }

            $data['week_student'] = DB::table('bh_bestperformer')->where('type','student')->first();
            $data['week_trainer'] = DB::table('bh_bestperformer')->where('type','trainer')->first();
            $data['week_teamleader'] = DB::table('bh_bestperformer')->where('type','teamleader')->first();
            $data['daily'] = DB::table('bh_dailyperformer')->get();
        }

        return view('student.welcome', $data);
    }
}
