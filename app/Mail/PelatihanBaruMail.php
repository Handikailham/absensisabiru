<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PelatihanBaruMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $pelatihan;

    public function __construct($pelatihan)
    {
        $this->pelatihan = $pelatihan;
    }

    public function build()
    {
        return $this->subject('Pelatihan Baru!')
                    ->view('emails.pelatihan_baru');
    }
}
