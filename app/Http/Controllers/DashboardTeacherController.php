<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        return view('layouts.admin.guru.guru', [
            'teachers' => Teacher::orderBy('created_at', 'desc')->paginate(3),
            'count_teacher' => Teacher::all()->count(),
            'male_count' => Teacher::where('jenis_kelamin', 'L')->count(),
            'female_count' => Teacher::where('jenis_kelamin', 'P')->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.admin.guru.createGuru', [
            'count_teacher' => Teacher::all()->count(),
            'male_count' => Teacher::where('jenis_kelamin', 'L')->count(),
            'female_count' => Teacher::where('jenis_kelamin', 'P')->count(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'image' => 'image|file|max:1024',
            'umur' => 'required|max:255',
            'jenis_kelamin' => 'required|max:255',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|max:255',
            'lulusan' => 'required|max:255',
            'alamat' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('profile-image');
        }

        $validatedData['password'] = bcrypt($validatedData['password']);
        
        Teacher::create($validatedData);

        return redirect('/dashboard/guru')->with('success', "Berhasil Tambah Data Guru");
    }

    /**
     * Display the specified resource.
     */
    public function show($id, $status)
    {
        if($status == 'Ajuan_Cancelled'){
            $status = 'Ajuan Cancelled';
        }
        $enrollments = Enrollment::with(['jadwal', 'student'])
                                ->whereHas('jadwal', function($query) use ($id) {
                                    $query->where('id_guru', $id);
                                })
                                ->where('status', $status)
                                ->get();

        return view('layouts.admin.guru.showGuru', [
            'teacher' => Teacher::find($id),
            'enrollments' => $enrollments,
            'count_teacher' => Teacher::all()->count(),
            'male_count' => Teacher::where('jenis_kelamin', 'L')->count(),
            'female_count' => Teacher::where('jenis_kelamin', 'P')->count(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('layouts.admin.guru.editGuru', [
            'teacher' => Teacher::find($id),
            'count_teacher' => Teacher::all()->count(),
            'male_count' => Teacher::where('jenis_kelamin', 'L')->count(),
            'female_count' => Teacher::where('jenis_kelamin', 'P')->count(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'umur' => 'required|max:255',
            'jenis_kelamin' => 'required|max:255',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|max:255',
            'lulusan' => 'required|max:255',
            'alamat' => 'required|max:255',
            'email' => 'required|email:dns',
            'password' => 'nullable|min:5|max:255'
        ]);
        $teacher = Teacher::findOrfail($id);
        
       
        // $request['password'] = bcrypt($request['password']);
        if($request->file('image')){
            if($request->oldImg){
                Storage::delete($request->oldImg);
            }
            $teacher->image = $request->file('image')->store('profile-image');
        }
        
        if ($request->filled('password')) {
            $teacher->password = Hash::make($request->password);
        }

        $teacher->name = $request->name;
        $teacher->umur = $request->umur;
        $teacher->jenis_kelamin = $request->jenis_kelamin;
        $teacher->tempat_lahir = $request->tempat_lahir;
        $teacher->tanggal_lahir = $request->tanggal_lahir;
        $teacher->lulusan = $request->lulusan;
        $teacher->alamat = $request->alamat;
        $teacher->email = $request->email;

        $teacher->save();

        return redirect('/dashboard/guru')->with('success', "Berhasil Edit Data Guru");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $teacher = Teacher::findOrfail($id);
        if($teacher->image){
            Storage::delete($teacher->image);
        }
        $teacher->delete();
        return redirect('/dashboard/guru')->with('success', "Berhasil Hapus Data Guru");
    }
}
