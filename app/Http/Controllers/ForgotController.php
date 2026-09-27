<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotController extends Controller
{
    public function index()
    {
        return view('front.forgot');
    }

    public function send(Request $request)
    {
        $request->validate(['email' => ['required','email']]);

        $student = Student::where('student_email', $request->input('email'))->first();

        if (!$student) {
            return back()->with('error', "We can't find your email address.");
        }
        if ((int) $student->student_status !== 1) {
            return back()->with('error', 'Your account is not in approved status.');
        }
        if ((int) $student->student_delete_status === 1) {
            return back()->with('error', 'Your account is already deleted. You can not use this.');
        }

        $token = bin2hex(random_bytes(15));
        DB::table('bh_tokens')->insert([
            'token' => $token,
            'student_id' => $student->id,
            'created' => now()->toDateString(),
        ]);

        $url = route('forgot.reset', ['token' => rtrim(strtr(base64_encode($token.$student->id), '+/', '-_'), '=')]);

        try {
            Mail::raw("A password reset has been requested for this email account.\n\nPlease click: {$url}", function ($message) use ($student) {
                $message->to($student->student_email)->subject('KOS Digital: Forgot Password Link');
            });
        } catch (\Throwable $e) {
            return back()->with('error', 'Some error occurred while sending email. Please try again.');
        }

        return back()->with('success', 'Please check your email for reset password.');
    }

    public function resetForm(string $token)
    {
        $student = $this->validStudentFromToken($token);
        if (!$student) {
            return redirect()->route('forgot')->with('error', 'Token is invalid or expired.');
        }

        return view('front.resetpassword', ['token' => $token]);
    }

    public function reset(Request $request, string $token)
    {
        $request->validate([
            'password' => ['required','string','min:8','same:passconf'],
            'passconf' => ['required'],
        ]);

        $student = $this->validStudentFromToken($token);
        if (!$student) {
            return redirect()->route('forgot')->with('error', 'Token is invalid or expired.');
        }

        $student->student_password = Hash::make($request->input('password'));
        $student->save();

        $parts = $this->decodeToken($token);
        if ($parts) {
            DB::table('bh_tokens')->where('token', $parts[0])->where('student_id', $parts[1])->delete();
        }

        return redirect()->route('student.login')->with('success', 'Your password has been updated. You may now login.');
    }

    private function validStudentFromToken(string $encoded): ?Student
    {
        $parts = $this->decodeToken($encoded);
        if (!$parts) return null;

        [$rawToken, $studentId] = $parts;
        $row = DB::table('bh_tokens')
            ->where('token', $rawToken)
            ->where('student_id', $studentId)
            ->whereDate('created', now()->toDateString())
            ->first();

        if (!$row) return null;

        return Student::find($studentId);
    }

    private function decodeToken(string $encoded): ?array
    {
        $decoded = base64_decode(strtr($encoded, '-_', '+/'), true);
        if ($decoded === false || strlen($decoded) <= 30) return null;

        $rawToken = substr($decoded, 0, 30);
        $studentId = substr($decoded, 30);

        return ctype_digit($studentId) ? [$rawToken, (int) $studentId] : null;
    }
}
