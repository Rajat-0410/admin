<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactUsEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $_data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($_data)
    {
        $this->_data = $_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // print("<pre>"); print_r($this->_data); exit('mail');
        $subject = $this->_data['subject'];
        return $this->view('email-templates.contact-us')
                    ->subject($subject)
                    ->with(['data' => $this->_data]);        
    }
}