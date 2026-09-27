<?php

namespace App\\Http\\Controllers;

use App\\Models\\Student;
use Illuminate\\Http\\Request;
use Illuminate\\Support\\Facades\\Hash;

class StudentLoginController extends Controller
{
    public function show()
    {
        return view('student.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'country' => ['required', 'string', 'max:8'],
            'email' => ['required', 'string', 'max:150'],
            'password' => ['required', 'string'],
        ]);

        $token = $validated['country'] . $validated['email'];

        $student = Student::query()
            ->where(function ($query) use ($token) {
                $query->where('student_email', $token)
                    ->orWhere('student_phone', $token)
                    ->orWhere('student_whatsapp', $token)
                    ->orWhere('student_telegram', $token);
            })
            ->first();

        if (!$student) {
            return back()->withInput($request->except('password'))
                ->withErrors(['email' => 'Your account credentials do not match.']);
        }

        if ((int) $student->student_delete_status !== 0) {
            return back()->withInput($request->except('password'))
                ->withErrors(['email' => 'Your account is deleted, please contact administrator.']);
        }

        $passwordValid = Hash::check($validated['password'], (string) $student->student_password)
            || hash_equals((string) $student->student_password, md5($validated['password']));

        if (!$passwordValid) {
            return back()->withInput($request->except('password'))
                ->withErrors(['email' => 'Your account credentials do not match.']);
        }

        if ((int) $student->student_status === 2) {
            return redirect()->route('student.block', ['student_id' => $student->id]);
        }

        if (strtolower((string) $student->student_password) === md5($validated['password'])) {
            $student->student_password = Hash::make($validated['password']);
        }

        $student->last_login = now();
        $student->save();

        $request->session()->regenerate();
        $request->session()->put('student', $student->toArray());
        $request->session()->put('student_id', $student->id);

        return redirect()->route('student.welcome');
    }
}
