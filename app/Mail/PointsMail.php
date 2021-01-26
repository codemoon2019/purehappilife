<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PointsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $points_data;

    /**
    * Create a new message instance.
    *
    * @return void
    */
    public function __construct($points_data)
    {
        $this->points_data = $points_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@purehappilife.com')->markdown('emails.points')->with(['email_data' => $this->points_data]);
    }
}
