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
    public function active(Request $request)
    {
        $studentId = $request->session()->get('student_id');
        abort_unless($studentId, 401);

        return DB::transaction(function () use ($studentId) {
            $student = Student::query()->lockForUpdate()->findOrFail($studentId);
            if ((int) $student->student_status === 1) {
                return response('Your account is already activated.');
            }

            $setting = fn(string $key, $default = 0) => DB::table('bh_setting')->where('key', $key)->value('value') ?? $default;

            $referId = (int) ($student->refer_id ?? 0);
            $referStudentTrainerId = $referStudentTeamLeaderId = $referStudentSeniorTeamLeaderId = 0;

            if ($referId > 0) {
                $referStudent = Student::query()->find($referId);
                $referStudentTrainerId = (int) ($referStudent->link_user_id ?? 0);
                if ($referStudentTrainerId > 0) {
                    $referStudentTeamLeaderId = (int) (DB::table('bh_user_extra')->where('user_id', $referStudentTrainerId)->value('link_user_id') ?? 0);
                }
                if ($referStudentTeamLeaderId > 0) {
                    $referStudentSeniorTeamLeaderId = (int) (DB::table('bh_user_extra')->where('user_id', $referStudentTeamLeaderId)->value('link_user_id') ?? 0);
                }

                $this->managePoint($referId, 'Refer Student Activated', 'Point earn for activated refer ID '.$student->student_no.' Name '.$student->student_name, (float) $setting('config_refer_activated_point'), 0, 'Credit');
            }

            $activationPoint = (float) $setting('config_id_activation_point');
            $cashbackPoint = (float) $setting('config_cashback_point');

            $this->managePoint($studentId, 'Student Activation Point', 'Student Activation Point Remove', 0, $activationPoint, 'Debit');
            $this->managePoint($studentId, 'Student Cashback Point', 'Cashback Point From Admin', $cashbackPoint, 0, 'Credit');

            $teamLeaderNo = $setting('config_team_leader_no');
            $teamLeaderId = (int) (DB::table('bh_user')->where('username', $teamLeaderNo)->value('user_id') ?? 151);
            $now = now();

            $student->update([
                'link_user_id' => 0,
                'activated_at' => $now,
                'link_user_at' => $now,
                'student_status' => 1,
                'activated_by' => 0,
            ]);

            DB::table('bh_student_active_history')->insert([
                'student_id' => $studentId,
                'refer_student_id' => $referId,
                'refer_student_trainer_id' => $referStudentTrainerId,
                'refer_student_teamleader_id' => $referStudentTeamLeaderId,
                'refer_student_seniorteamleader_id' => $referStudentSeniorTeamLeaderId,
                'user_id' => 0,
                'team_leader_id' => $teamLeaderId,
                'counsellor_id' => (int) (DB::table('bh_student_to_counsellor')->where('student_id', $studentId)->value('user_id') ?? 0),
                'added_on' => $now,
            ]);

            return response('Your account successfully activated.');
        });
    }

    private function managePoint(int $studentId, string $reason, string $description, float $credit, float $debit, string $type): void
    {
        $balance = (float) (DB::table('bh_student_passbook')->where('student_id', $studentId)->orderByDesc('id')->value('balance_point') ?? 0);
        $balance = $type === 'Credit' ? $balance + $credit : $balance - $debit;

        DB::table('bh_student_passbook')->insert([
            'student_id' => $studentId,
            'reason' => $reason,
            'description' => $description,
            'credit_point' => $credit,
            'debit_point' => $debit,
            'type' => $type,
            'balance_point' => $balance,
            'created_at' => now(),
        ]);
        Student::query()->whereKey($studentId)->update(['student_point' => $balance]);
    }

}
