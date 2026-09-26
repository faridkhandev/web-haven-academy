<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function show(Request $request)
    {
        if ($request->session()->has('admin_user_id')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => ['required','string','max:190'],
            'password' => ['required','string'],
        ]);

        $user = AdminUser::query()
            ->where('status', 1)
            ->where('user_group_id', 1)
            ->where(function ($q) use ($data) {
                $q->where('username', $data['username'])
                  ->orWhere('email', $data['username'])
                  ->orWhereIn('user_id', function ($sub) use ($data) {
                      $sub->select('user_id')->from('bh_user_extra')->where('user_no', $data['username']);
                  });
            })
            ->first();

        $valid = false;
        if ($user) {
            $stored = (string) $user->password;

            if (Hash::check($data['password'], $stored)) {
                $valid = true;
            } elseif ($stored === md5($data['password'])) {
                $valid = true;
            } elseif (!empty($user->salt)) {
                $legacy = sha1($user->salt . sha1($user->salt . sha1($data['password'])));
                $valid = hash_equals($stored, $legacy);
            }
        }

        if (!$valid) {
            return back()->withInput($request->only('username'))
                ->withErrors(['username' => 'Invalid username or password.']);
        }

        $request->session()->regenerate();
        $request->session()->put([
            'admin_user_id' => $user->user_id,
            'admin_user_group_id' => $user->user_group_id,
            'admin_username' => $user->username,
        ]);

        // Upgrade legacy password storage after a successful login.
        if ($user->password === md5($data['password']) || (!empty($user->salt) && hash_equals((string) $user->password, sha1($user->salt . sha1($user->salt . sha1($data['password])))))) {
            $user->password = Hash::make($data['password']);
            $user->salt = '';
            $user->save();
        }

        return redirect()->intended(route('admin.dashboard'));
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['admin_user_id','admin_user_group_id','admin_username']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
