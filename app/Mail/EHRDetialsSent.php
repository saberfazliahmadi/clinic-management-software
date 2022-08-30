<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EHRDetialsSent extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $detail ;
    public $message ;
    public function __construct($detail , $message)
    {
        $this->detail = $detail ;
        $this->message = $message ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.EHR.Sent' , [ 'detail' => $this->detail , 'message' => $this->message ]);
    }
}
