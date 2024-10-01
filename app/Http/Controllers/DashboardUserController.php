<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\historyPayment;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::first();
        return view('layouts.admin.user_admin.admin', [
            'user' => $users,
        ]);
    }

    public function dashboard(){
        $students = Student::all();
        $teachers = Teacher::all();
        $students_active = Enrollment::select('id_siswa')
                            ->distinct()
                            ->count('id_siswa');
        $teachers_active = Enrollment::join('jadwals', 'enrollments.id_jadwal', '=', 'jadwals.id')
                            ->select('jadwals.id_guru')
                            ->distinct()
                            ->count('jadwals.id_guru');

        $allMonths = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May',
            6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September',
            10 => 'October', 11 => 'November', 12 => 'December'
        ];
        $data = Student::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->groupBy('month')
                ->pluck('count', 'month');

        // Ubah data ke format yang bisa digunakan di Chart.js
        $months = [];
        $counts = [];

        foreach ($allMonths as $num => $name) {
            $months[] = $name; // Nama bulan
            $counts[] = $data->get($num, 0); // Jumlah siswa, atau 0 jika tidak ada
        }

        $educationData = Student::selectRaw('kelas, COUNT(*) as count')
            ->groupBy('kelas')
            ->pluck('count', 'kelas');

        // Pisahkan data untuk chart
        $levels = $educationData->keys(); // Jenjang pendidikan (misalnya SD, SMP, SMA)
        $counts_levels = $educationData->values(); // Jumlah siswa per jenjang pendidikan

        
        $payments = historyPayment::with(['enrollment', 'enrollment.student', 'enrollment.jadwal.teacher'])->paginate(5);

        $data_payment = historyPayment::selectRaw('MONTH(created_at) as month, SUM(amount) as sum')
                ->groupBy('month')
                ->pluck('sum', 'month');

        // Ubah data ke format yang bisa digunakan di Chart.js
        $months_payments = [];
        $sum = [];

        foreach ($allMonths as $num => $name) {
            $months_payments[] = $name; // Nama bulan
            $sum[] = $data_payment->get($num, 0); // Jumlah siswa, atau 0 jika tidak ada
        }

        return view('layouts.admin.dashboard', [
            'count_students' => $students->count(),
            'count_teachers' => $teachers->count(),
            'students_active' => $students_active,
            'teachers_active' => $teachers_active,
            'chart' => compact('months', 'counts'),
            'educations_levels' => compact('levels', 'counts_levels'),
            'chart_payments' => compact('months_payments', 'sum'),
            'payments' => $payments,
            'sum_payment' => historyPayment::sum('amount'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('layouts.admin.user_admin.editAdmin', [
            'user' => User::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns',
            'password' => 'nullable|min:5|max:255'
        ]);
        $user = User::findOrfail($id);
        
       
        // $request['password'] = bcrypt($request['password']);
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return redirect('/dashboard/admin')->with('success', "Berhasil Edit Data Admin");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
