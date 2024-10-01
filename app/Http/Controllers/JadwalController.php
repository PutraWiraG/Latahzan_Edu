<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Teacher;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layouts.admin.jadwal.jadwal', [
            'teachers' => Teacher::orderBy('created_at', 'desc')->paginate(3),
            'count_teacher' => Teacher::all()->count(),
            'male_count' => Teacher::where('jenis_kelamin', 'L')->count(),
            'female_count' => Teacher::where('jenis_kelamin', 'P')->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        return view('layouts.admin.jadwal.createJadwal', [
            'teacher' => Teacher::find($id),
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
            'id_guru' => 'required',
            'hari' => 'required',
            'waktu' => 'required',
            'status' => 'required',
        ]);
        $count_hari = Jadwal::where('id_guru', $validatedData['id_guru'])
                            ->where('hari', $validatedData['hari'])
                            ->count();

        if($count_hari >= 4){
            $link = '/dashboard/jadwal/create/'. $validatedData['id_guru'];
            return redirect($link)->with('success', "Jadwal Hari Tersebut Sudah Maksimal");
        }else{
            Jadwal::create($validatedData);
            $link = '/dashboard/jadwal/'. $validatedData['id_guru'];
            return redirect($link)->with('success', "Berhasil Tambah Jadwal");
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('layouts.admin.jadwal.detailJadwal', [
            'teacher' => Teacher::with(['jadwal' => function ($query) {
                $query->orderBy('waktu', 'asc');
            }])->findOrFail($id),
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
        $jadwal = Jadwal::find($id);
        return view('layouts.admin.jadwal.editStatus', [
            'jadwal' => $jadwal,
            'teacher' => Teacher::find($jadwal->id_guru),
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
        $validatedData = $request->validate([
            'id_guru' => 'required',
            'hari' => 'required',
            'waktu' => 'required',
            'status' => 'required',
        ]);
        $jadwal = Jadwal::findOrfail($id);

        $jadwal->id_guru = $request->id_guru;
        $jadwal->hari = $request->hari;
        $jadwal->waktu = $request->waktu;
        $jadwal->status = $request->status;
        
        $jadwal->save();
        $link = '/dashboard/jadwal/'. $validatedData['id_guru'];
        return redirect($link)->with('success', "Berhasil Merubah Status Jadwal");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        //
    }
}
