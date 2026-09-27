<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        abort_unless($request->session()->has('admin_user_id'), 403);

        $userId = (int) $request->session()->get('admin_user_id');
        $groupId = (int) $request->session()->get('admin_user_group_id');

        $totalCredit = (float) DB::table('bh_user_passbook')
            ->where('user_id', $userId)->where('type', 'Credit')->sum('credit_point');

        $data = [
            'groupId' => $groupId,
            'totalCredit' => $totalCredit,
            'totalStudents' => DB::table('bh_student')->count(),
            'activeStudents' => DB::table('bh_student')->where('student_status', 1)->where('delete_status', 0)->count(),
            'todayLeads' => DB::table('bh_student')->whereDate('created_at', now()->toDateString())->count(),
        ];

        if ($groupId === 17) {
            $data['buyBalance'] = $this->walletBalance('point_buy', $userId);
            $data['sellBalance'] = $this->walletBalance('point_sell', $userId);
        }

        return view('admin.dashboard', $data);
    }

    private function walletBalance(string $table, int $userId): float
    {
        return (float) (DB::table($table)->where('user_id', $userId)
            ->selectRaw("COALESCE(SUM(CASE WHEN type = '1' THEN point ELSE 0 END),0) - COALESCE(SUM(CASE WHEN type = '2' THEN point ELSE 0 END),0) AS balance")
            ->value('balance') ?? 0);
    }
}
