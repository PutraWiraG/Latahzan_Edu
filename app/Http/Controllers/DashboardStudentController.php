<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layouts.admin.student.siswa', [
            // 'students' => Student::all(),
            'count_students' => Student::all()->count(),
            'male_count' => Student::where('jenis_kelamin', 'L')->count(),
            'female_count' => Student::where('jenis_kelamin', 'P')->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.admin.student.createStudent', [
            'count_students' => Student::all()->count(),
            'male_count' => Student::where('jenis_kelamin', 'L')->count(),
            'female_count' => Student::where('jenis_kelamin', 'P')->count(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->file('image')->store('profile-image');
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'image' => 'image|file|max:1024',
            'umur' => 'required|max:255',
            'jenis_kelamin' => 'required|max:255',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|max:255',
            'kelas' => 'required|max:255',
            'alamat' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('profile-image');
        }

        $validatedData['password'] = bcrypt($validatedData['password']);
        
        Student::create($validatedData);

        return redirect('/dashboard/siswa')->with('success', "Berhasil Tambah Data Siswa");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('layouts.admin.student.showStudent', [
            'student' => Student::find($id),
            'count_students' => Student::all()->count(),
            'male_count' => Student::where('jenis_kelamin', 'L')->count(),
            'female_count' => Student::where('jenis_kelamin', 'P')->count(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('layouts.admin.student.editStudent', [
            'student' => Student::find($id),
            'count_students' => Student::all()->count(),
            'male_count' => Student::where('jenis_kelamin', 'L')->count(),
            'female_count' => Student::where('jenis_kelamin', 'P')->count(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'image|file|max:1024',
            'umur' => 'required|max:255',
            'jenis_kelamin' => 'required|max:255',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|max:255',
            'kelas' => 'required|max:255',
            'alamat' => 'required|max:255',
            'email' => 'required|email:dns',
            'password' => 'nullable|min:5|max:255'
        ]);
        $student = Student::findOrfail($id);
        
       
        // $request['password'] = bcrypt($request['password']);
        
        if($request->file('image')){
            if($request->oldImg){
                Storage::delete($request->oldImg);
            }
            $student->image = $request->file('image')->store('profile-image');
        }

        if ($request->filled('password')) {
            $student->password = Hash::make($request->password);
        }

        $student->name = $request->name;
        $student->umur = $request->umur;
        $student->jenis_kelamin = $request->jenis_kelamin;
        $student->tempat_lahir = $request->tempat_lahir;
        $student->tanggal_lahir = $request->tanggal_lahir;
        $student->kelas = $request->kelas;
        $student->alamat = $request->alamat;
        $student->email = $request->email;

        $student->save();

        return redirect('/dashboard/siswa')->with('success', "Berhasil Edit Data Siswa");
    }

    /**
     * Remove the specified resource from .
     */
    public function destroy($id)
    {
        $student = Student::findOrfail($id);
        if($student->image){
            Storage::delete($student->image);
        }
        $student->delete();
        return redirect('/dashboard/siswa')->with('success', "Berhasil Hapus Data Siswa");
    }
}
