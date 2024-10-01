<?php

namespace App\Service;

use App\Mail\NotificationMail;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class ReportGenerator{
    public function __invoke()
    {
        $now = Carbon::now()->format('Y-m-d');

        $expiredPayments = Payment::whereDate('expired_date', $now)->get();
        foreach ($expiredPayments as $payment) {
            // Ubah status pada enrollment menjadi 'confirmed'
            $enrollment = $payment->enrollment;
            if ($enrollment) {
                $enrollment->status = 'Confirmed';
                $enrollment->pesan = 'Jadwal telah Expired, Silahkan untuk melakukan pembayaran lagi agar status pada jadwal berubah menjadi Active lagi!';
                $enrollment->save();

                $data = [
                    'subject' => 'Jadwal Expired',
                    'title' => 'Hallo '.$enrollment->student->name,
                    'body' => 'Hallo, Mohon maaf jadwal yang telah didaftarkan saat ini sudah melebihi Expired Date. Maka dari itu status berubah menjadi Confirmed. Agar jadwal tersebut aktif kembali silahkan untuk melakukan pembayaran les privat lagi. Terimakasih atas perhatiannya'
                ];
            
                Mail::to($enrollment->student->email)->send(new NotificationMail($data));
            }

            // Hapus data payment
            $payment->delete();
        }
    }
}