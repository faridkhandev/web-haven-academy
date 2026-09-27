<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class CoursesController extends Controller
{
    public function index()
    {
        $courses = DB::table('bh_course')
            ->where('course_delete_status', 0)
            ->where('parent_id', 0)
            ->where('type_id', 1)
            ->where('course_status', 1)
            ->orderBy('sort_order')
            ->get();

        $courses2 = DB::table('bh_course')
            ->where('course_delete_status', 0)
            ->where('type_id', 2)
            ->where('course_status', 1)
            ->orderBy('sort_order')
            ->get();

        return view('front.courses', compact('courses', 'courses2'));
    }
}
