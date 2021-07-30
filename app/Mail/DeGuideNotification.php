<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class DeGuideNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $userDetails;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userDetails)
    {
        $this->userDetails = $userDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->from('from-mail','enter name')
        ->subject('subject')
        ->markdown('transactions.guide-mail') // where the mail template view resides 
        ->with([
            'customerName' => $this->userDetails['firstname'],
        ]);

        // attached value (digital product)
        $attach = public_path('path/to/product');
        $mail->attach($attach);

        return $mail;
    }
}
