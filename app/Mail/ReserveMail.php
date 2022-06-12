<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReserveMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $reserve;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reserve)
    {
        $this->reserve= $reserve;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->view('emails.reserve', ['reserve' => $this->reserve])
        ->subject('予約日となりました。');
    }
}
