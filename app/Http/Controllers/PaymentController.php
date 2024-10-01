<?php

namespace App\Http\Controllers;

use App\Mail\NotificationMail;
use App\Models\Enrollment;
use App\Models\historyPayment;
use App\Models\Jadwal;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Midtrans\Config;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $enrollment = Enrollment::find($request->id_enrollment);
        $jadwal = Jadwal::find($enrollment->id_jadwal); 
        $teacher = Teacher::find($jadwal->id_guru); 
        $student = Student::find($enrollment->id_siswa);

        $monthsToAdd = intval($request->input('totalPilihan'));
        
        $payment = Payment::create([
            'enrollment_id' => $enrollment->id,
            'amount' => $request->totalHarga,
            'status' => 'pending',
            'payment_date' => Carbon::now(),
            'expired_date' => Carbon::now()->addMonths($monthsToAdd),
        ]);

        $history_payment = historyPayment::create([
            'enrollment_id' => $enrollment->id,
            'amount' => $request->totalHarga,
            'status' => 'pending',
            'payment_date' => Carbon::now(),
            'expired_date' => Carbon::now()->addMonths($monthsToAdd),
        ]);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        
        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => $request->totalHarga, // Harga per bulan
            ],
            'customer_details' => [
                'first_name' => $enrollment->student->name,
                'email' => $enrollment->student->email,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $payment->snap_token = $snapToken;
        $payment->save();
        $history_payment->snap_token = $snapToken;
        $history_payment->save();

        $payments = Payment::find($payment->id);

        return view('checkout', [
            'enrollment' => $enrollment,
            'jadwal' => $jadwal,
            'student' => $student,
            'teacher' => $teacher,
            'payment' => $payments,
        ]);

    }

    public function success($id){
        $history_payment = historyPayment::find($id);
        $payment = Payment::find($id);
        $enrollment = Enrollment::with('student')->findOrfail($payment->enrollment_id);
        $jadwal = Jadwal::with('teacher')->findOrfail($enrollment->id_jadwal);

        $payment->status = 'paid';
        $payment->save();

        $history_payment->status = 'paid';
        $history_payment->save();

        $enrollment->status ='Active';
        $enrollment->pesan ='Pembayaran Berhasil!! Selamat Belajar!!';
        $enrollment->save();

        $jadwal->status ='Full';
        $jadwal->save();

        $data = [
            'subject' => 'Pembayaran Sukses',
            'title' => 'Hallo '.$enrollment->student->name,
            'body' => 'Pembayaran Anda telah berhasil diproses! Kami dengan senang hati menginformasikan bahwa status pendaftaran les privat Anda sekarang sudah aktif. Terima kasih atas pembayaran yang telah dilakukan. Kami siap menyambut Anda untuk memulai sesi les privat sesuai jadwal. Jangan ragu untuk menghubungi kami jika ada pertanyaan lebih lanjut.',
        ];
        $data_guru = [
            'subject' => 'Les Privat diMulai',
            'title' => 'Hallo '.$jadwal->teacher->name,
            'body' => 'Siswa Anda telah berhasil melakukan pembayaran les privat, dan status pendaftaran mereka sekarang sudah aktif. Harap pastikan untuk menjalankan hak dan kewajiban Anda sebagai pengajar sesuai dengan jadwal yang telah disepakati. Terima kasih atas kerjasamanya, dan selamat memulai sesi les privat dengan siswa!',
        ];
    
        Mail::to($enrollment->student->email)->send(new NotificationMail($data));
        Mail::to($jadwal->teacher->email)->send(new NotificationMail($data_guru));

        return redirect('/enrollments/status/Active');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
