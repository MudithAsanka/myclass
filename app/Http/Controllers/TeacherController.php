<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkRole:teacher');
        $this->middleware('auth');
    }

    public function dashboard()
    {
        return view('teacher.dashboard');
    }

    public function students()
    {
        return view('teacher.students');
    }

    public function teachers()
    {
        return view('teacher.teachers');
    }

    public function messages()
    {
        return view('teacher.messages');
    }

}
