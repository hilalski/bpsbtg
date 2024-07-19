<?php

namespace App\Mail;

use App\Models\Rapat;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RapatNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $rapat;
    private $isChangeEmail;

    public function __construct(Rapat $rapat, $isChangeEmail = false)
    {
        $this->rapat = $rapat;
        $this->isChangeEmail = $isChangeEmail;
    }

    public function build()
    {
        if ($this->isChangeEmail) {
            return $this->view('emails.email-perubahan-rapat', ['rapat' => $this->rapat]);
        } else {
            return $this->view('emails.email-undangan-rapat', ['rapat' => $this->rapat]);
        }
    }
}
