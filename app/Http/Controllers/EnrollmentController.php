<?php

namespace App\Http\Controllers;

use App\Mail\NotificationMail;
use App\Models\Enrollment;
use App\Models\Jadwal;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrollments = Student::findOrFail(Auth::id())->enrollments;
        return view('statusPendaftaran', [
            'enrollments' => $enrollments,
        ]);
    }

    public function show_dashboard(){
        $enrollments =Enrollment::with(['student', 'jadwal.teacher'])->paginate(5);
        return view('layouts.admin.transkasi.enrollment', [
            'enrollments' => $enrollments,
            'pending_count' => Enrollment::where('status', 'Pending')->count(),
            'confirmed_count' => Enrollment::where('status', 'Confirmed')->count(),
            'active_count' => Enrollment::where('status', 'Active')->count(),
            'ajuanCancelled_count' => Enrollment::where('status', 'Ajuan Cancelled')->count(),
            'cancelled_count' => Enrollment::where('status', 'Cancelled')->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $id_student = Auth::id();
        $jadwal = Jadwal::find($id);
        $teacher = $jadwal->teacher;
        return view('createEnrollment', [
            'student' => Student::find($id_student),
            'jadwal' => $jadwal,
            'teacher' => $teacher,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_siswa' => 'required',
            'id_jadwal' => 'required',
            'pesan' => 'required',
        ]);
        $validatedData['enrollment_date'] = Carbon::now();

        // $jadwal = Jadwal::findOrfail($request->id_jadwal);
        $jadwal = Jadwal::with('teacher')->findOrfail($request->id_jadwal);
        $jadwal->status = 'Booking';
        $jadwal->save();

        Enrollment::create($validatedData);
        // notify()->success('Pengajuan Berhasil, Cek Berkala Status Pengajuan');
        $data = [
            'subject' => 'Pengajuan Pendaftaran Les Privat',
            'title' => 'Hallo '.$jadwal->teacher->name,
            'body' => 'Selamat! Anda mendapatkan pendaftaran les privat baru dari seorang siswa. Segera tinjau dan berikan respon atas pengajuan ini untuk memulai perjalanan belajar bersama. Waktu Anda sangat berharga, jadi pastikan untuk merespon dalam waktu secepatnya agar siswa dapat segera memulai les. Jadilah bagian dari perkembangan siswa dan jangan lewatkan kesempatan ini!'
        ];
    
        Mail::to($jadwal->teacher->email)->send(new NotificationMail($data));
    
        return redirect('/enrollments/status/Pending');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function showStatus($status)
    {
        if($status == 'Ajuan_Cancelled'){
            $status = 'Ajuan Cancelled';
        }
        $enrollments = Enrollment::where('id_siswa', Auth::id())
                                ->where('status', $status)
                                ->get();

        return view('statusPendaftaran', compact('enrollments'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $enrollment = Enrollment::find($id);
        $jadwal = Jadwal::find($enrollment->id_jadwal); 
        $teacher = Teacher::find($jadwal->id_guru); 
        $student = Student::find($enrollment->id_siswa); 
        $currentMonth = Carbon::now()->month;
        
        if(Auth::guard('teacher')->check() || Auth::guard('user')->check()){
            return view('layouts.admin.guru.editStatusEnrollment', [
                'enrollment' => $enrollment,
                'jadwal' => $jadwal,
                'student' => $student,
                'teacher' => $teacher,
                'currentMonth' => $currentMonth,
                'count_teacher' => Teacher::all()->count(),
                'male_count' => Teacher::where('jenis_kelamin', 'L')->count(),
                'female_count' => Teacher::where('jenis_kelamin', 'P')->count(),
            ]);
        }else if(Auth::guard('student')->check()){
            
            if($enrollment->status == 'Confirmed'){
                return view('paymentStudent', [
                    'enrollment' => $enrollment,
                    'jadwal' => $jadwal,
                    'student' => $student,
                    'teacher' => $teacher,
                    'currentMonth' => $currentMonth,
                ]);
            }else{
                return view('editStatusEnrollment', [
                    'enrollment' => $enrollment,
                    'jadwal' => $jadwal,
                    'student' => $student,
                    'teacher' => $teacher,
                    'currentMonth' => $currentMonth,
                ]);
            }

        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $enrollment = Enrollment::with('student')->findOrfail($id);
        $jadwal = Jadwal::with('teacher')->findOrfail($enrollment->id_jadwal); 
        $data = [
            'subject' => '',
            'title' => '',
            'body' => '',
        ];
        $data_guru = [
            'subject' => '',
            'title' => '',
            'body' => '',
        ];

        if($enrollment->status == 'Active' || $enrollment->status == 'Ajuan Cancelled'){
            if (Auth::guard('student')->check()) {
                if($enrollment->cancel_teacher == true){
                    $enrollment->status = 'Cancelled';
                }else{
                    $enrollment->status = $request->status;
                }
                $enrollment->pesan = $request->pesan;
                $enrollment->cancel_siswa = true;
                $enrollment->save();
                if($enrollment->cancel_teacher == true){
                    $data = [
                        'subject' => 'Ajuan Cencelled Les Privat',
                        'title' => 'Hallo '.$enrollment->student->name,
                        'body' => 'Ajuan pembatalan telah disetujui oleh kedua pihak dan telah diproses. Terima kasih atas respon cepat Anda dalam menangani permintaan tersebut. Jika ada hal lain yang perlu diatur atau diperbarui, silakan hubungi kami. Kami menghargai kerjasama Anda dalam memastikan kelancaran proses ini.',
                    ];
                    $data_guru = [
                        'subject' => 'Pengajuan Cencelled Les Privat',
                        'title' => 'Hallo '.$jadwal->teacher->name,
                        'body' => 'Ajuan pembatalan telah disetujui oleh kedua pihak dan telah diproses. Terima kasih atas respon cepat Anda dalam menangani permintaan tersebut. Jika ada hal lain yang perlu diatur atau diperbarui, silakan hubungi kami. Kami menghargai kerjasama Anda dalam memastikan kelancaran proses ini.',
                    ];
                    $jadwal->status = "Kosong";
                    $jadwal->save();
                    $payment = Payment::findOrfail($enrollment->id);
                    $payment->delete();
                }else{
                    $data = [
                        'subject' => 'Pengajuan Cencelled Les Privat',
                        'title' => 'Hallo '.$enrollment->student->name,
                        'body' => 'Ajuan pembatalan yang Anda ajukan telah diterima oleh guru dan saat ini sedang diproses. Guru akan segera merespon ajuan pembatalan Anda. Terima kasih atas kesabarannya, dan kami akan memberitahukan Anda segera setelah ada pembaruan lebih lanjut.',
                    ];
                    $data_guru = [
                        'subject' => 'Ajuan Cencelled Les Privat',
                        'title' => 'Hallo '.$jadwal->teacher->name,
                        'body' => 'Anda memiliki ajuan pembatalan dari siswa yang perlu segera ditindaklanjuti. Mohon untuk memberikan respon secepatnya agar proses pembatalan dapat diselesaikan dengan lancar. Terima kasih atas perhatian dan kerjasama Anda dalam menjaga kelancaran proses ini!',
                    ];
                }
                Mail::to($enrollment->student->email)->send(new NotificationMail($data));
                Mail::to($jadwal->teacher->email)->send(new NotificationMail($data_guru));
            
            } elseif (Auth::guard('teacher')->check() || Auth::guard('user')->check()) {
                if($enrollment->cancel_siswa == true){
                    $enrollment->status = 'Cancelled';
                }else{
                    $enrollment->status = $request->status;
                }
                $enrollment->pesan = $request->pesan;
                $enrollment->cancel_teacher = true;
                $enrollment->save();
                if($enrollment->cancel_siswa == true){
                    $data = [
                        'subject' => 'Pengajuan Cencelled Les Privat',
                        'title' => 'Hallo '.$enrollment->student->name,
                        'body' => 'Ajuan pembatalan telah disetujui oleh kedua pihak dan telah diproses. Terima kasih atas respon cepat Anda dalam menangani permintaan tersebut. Jika ada hal lain yang perlu diatur atau diperbarui, silakan hubungi kami. Kami menghargai kerjasama Anda dalam memastikan kelancaran proses ini.',
                    ];
                    $data_guru = [
                        'subject' => 'Ajuan Cencelled Les Privat',
                        'title' => 'Hallo '.$jadwal->teacher->name,
                        'body' => 'Ajuan pembatalan telah disetujui oleh kedua pihak dan telah diproses. Terima kasih atas respon cepat Anda dalam menangani permintaan tersebut. Jika ada hal lain yang perlu diatur atau diperbarui, silakan hubungi kami. Kami menghargai kerjasama Anda dalam memastikan kelancaran proses ini.',
                    ];
                    $jadwal->status = "Kosong";
                    $jadwal->save();
                    $payment = Payment::findOrfail($enrollment->id);
                    $payment->delete();
                }else{
                    $data = [
                        'subject' => 'Ajuan Cencelled Les Privat',
                        'title' => 'Hallo '.$enrollment->student->name,
                        'body' => 'Anda memiliki ajuan pembatalan dari guru yang perlu segera ditindaklanjuti. Mohon untuk memberikan respon secepatnya agar proses pembatalan dapat diselesaikan dengan lancar. Terima kasih atas perhatian dan kerjasama Anda dalam menjaga kelancaran proses ini!',
                    ];
                    $data_guru = [
                        'subject' => 'Pengajuan Cencelled Les Privat',
                        'title' => 'Hallo '.$jadwal->teacher->name,
                        'body' => 'Ajuan pembatalan yang Anda ajukan telah diterima oleh siswa dan saat ini sedang diproses. Siswa akan segera merespon ajuan pembatalan Anda. Terima kasih atas kesabarannya, dan kami akan memberitahukan Anda segera setelah ada pembaruan lebih lanjut.',
                    ];
                }
                Mail::to($enrollment->student->email)->send(new NotificationMail($data));
                Mail::to($jadwal->teacher->email)->send(new NotificationMail($data_guru));
            }
        }else{
            
            $enrollment->status = $request->status;
            $enrollment->pesan = $request->pesan;
            $enrollment->save();

            if($request->status != 'Pending'){

                $data = [
                    'subject' => ($request->status == "Confirmed") ? 'Ajuan Pendaftaran Disetujui' : 'Ajuan Pendaftaran DiTolak',
                    'title' => 'Hallo '.$enrollment->student->name,
                    'body' => ($request->status == "Confirmed") ? 'Selamat! Pendaftaran les privat Anda telah disetujui! Segera lakukan pembayaran agar sesi les dapat dimulai sesuai jadwal. Pastikan untuk menyelesaikan pembayaran tepat waktu agar proses belajar tidak tertunda. Kami menantikan kemajuan Anda bersama guru yang telah dipilih!' : 'Pengajuan pendaftaran les privat Anda tidak dapat disetujui pada saat ini. Mohon maaf atas ketidaknyamanan ini. Anda dapat memilih jadwal atau guru lain yang tersedia, atau hubungi kami untuk bantuan lebih lanjut. Terima kasih atas pengertian Anda.',
                ];
            
                Mail::to($enrollment->student->email)->send(new NotificationMail($data));
            
            }
        }
        
        if($request->status == 'Cancelled'){
            $jadwal->status = "Kosong";
            $jadwal->save();
        }
        
        if(Auth::guard('student')->check()){
            return redirect('/enrollments/status/Pending');
        }else{
            $link = '/dashboard/guru/'. $jadwal['id_guru'] . '/Pending';
            return redirect($link)->with('success', "Respon diKirimkan");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
