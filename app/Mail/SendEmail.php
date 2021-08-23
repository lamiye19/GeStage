<?php

namespace App\Mail;

use App\Models\Stage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;


    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct(Array $dataSent)
    {
        $this->data = $dataSent;
    } 

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('omolola0119@gmail.com')
        ->subject($this->data['subject'])
        ->view('mail.mailling');
    }
}
