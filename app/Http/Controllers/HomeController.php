<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('home', [
            'teachers' => Teacher::orderBy('created_at', 'desc')->paginate(3)
        ]);
    }

    public function show($id)
    {
        return view('detailTeacher', [
            'teacher' => Teacher::with(['jadwal' => function ($query) {
                $query->orderBy('waktu', 'asc');
            }])->findOrFail($id)
        ]);
    }
}
