<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{

    public function index(Request $request)
    {

        $query = AdminUser::query()
            ->leftJoin('bh_user_group as ug', 'ug.user_group_id', '=', 'bh_user.user_group_id')
            ->select('bh_user.*', 'ug.name as group_name');

        if ($request->filled('username')) $query->where('bh_user.username', 'like', '%'.$request->username.'%');
        if ($request->filled('group_id')) $query->where('bh_user.user_group_id', $request->group_id);
        if ($request->filled('status')) $query->where('bh_user.status', $request->status);

        return view('admin.users.index', [
            'users' => $query->orderByDesc('bh_user.user_id')->paginate(20)->withQueryString(),
            'groups' => DB::table('bh_user_group')->orderBy('name')->get(),
        ]);
    }

    public function create(Request $request)
    {

        return view('admin.users.form', ['user' => null, 'groups' => DB::table('bh_user_group')->orderBy('name')->get()]);
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'username' => ['required','string','min:3','max:20','unique:bh_user,username'],
            'user_group_id' => ['required','integer','exists:bh_user_group,user_group_id'],
            'firstname' => ['required','string','max:32'],
            'lastname' => ['required','string','max:32'],
            'email' => ['nullable','email','max:96'],
            'password' => ['required','string','min:8','confirmed'],
            'status' => ['required','boolean'],
        ]);
        $data['password'] = Hash::make($data['password']);
        $data['date_added'] = now();
        $data['salt'] = '';
        $data['code'] = '';
        $data['delete_status'] = 0;
        AdminUser::create($data);
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(Request $request, int $user)
    {

        abort_if($user === 1, 404);
        return view('admin.users.form', [
            'user' => AdminUser::findOrFail($user),
            'groups' => DB::table('bh_user_group')->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, int $user)
    {

        abort_if($user === 1, 403);
        $admin = AdminUser::findOrFail($user);
        $data = $request->validate([
            'username' => ['required','string','min:3','max:20',Rule::unique('bh_user','username')->ignore($admin->user_id,'user_id')],
            'user_group_id' => ['required','integer','exists:bh_user_group,user_group_id'],
            'firstname' => ['required','string','max:32'],
            'lastname' => ['required','string','max:32'],
            'email' => ['nullable','email','max:96'],
            'password' => ['nullable','string','min:8','confirmed'],
            'status' => ['required','boolean'],
        ]);
        if (!empty($data['password'])) $data['password'] = Hash::make($data['password']);
        else unset($data['password']);
        $admin->update($data);
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(Request $request, int $user)
    {

        abort_if($user === 1 || $user === (int)$request->session()->get('admin_user_id'), 403);
        AdminUser::where('user_id', $user)->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
