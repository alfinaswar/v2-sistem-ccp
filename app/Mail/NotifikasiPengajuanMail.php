<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class NotifikasiPengajuanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pengajuan;
    public $hta;
    public $parameter;
    public $penilai;
    public function __construct($pengajuan, $hta, $parameter, $penilai)
    {
        $this->pengajuan = $pengajuan;
        $this->hta = $hta;
        $this->parameter = $parameter;
        $this->penilai = $penilai;
    }
    public function build()
    {
        // dd($this->penilai);
        $pdf = Pdf::loadView('hta-gpa.cetak-hta-gpa', [
            'data' => $this->pengajuan,
            'hta' => $this->hta,
            'parameter' => $this->parameter,
            'penilai' => $this->penilai,
        ]);

        return $this->subject('Persetujuan Penilaian HTA / GPA')
            ->view('emails.notifikasi-pengajuan-hta')
            ->with([
                'penilai' => $this->penilai,

            ])
            ->attachData($pdf->output(), 'HTA_GPA.pdf');
    }
}

