<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;


class StudentController extends Controller
{
    public function index(){
        return view('layouts.admin.siswa');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'umur' => 'required|max:255',
            'jenis_kelamin' => 'required|max:255',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|max:255',
            'kelas' => 'required|max:255',
            'alamat' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        
        Student::create($validatedData);
        dd('berhasil');
        // return redirect('/')->with('success', 'Berhasil Input Data Siswa');
    }
}
