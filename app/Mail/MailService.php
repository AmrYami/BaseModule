<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MailService extends Mailable
{
    use Queueable, SerializesModels;

    private string|null $attach;
    private string|null $attach_name;
    private string|null $title;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($from = null, $to = null, $view = null, $subject = null, $title = null,
                                $data = null, $attach = null, $attach_name = null,
                                $cc = null, $bcc = null)
    {
        $this->from = $from;
        $this->to = $to;
        $this->view = $view;
        $this->subject = $subject;
        $this->title = $title;
        $this->viewData = $data;
        $this->attach = $attach;
        $this->attach_name = $attach_name;
        $this->cc = $cc;
        $this->bcc = $bcc;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->view);
    }

    public function send($mailer = '')
    {

        Mail::send($this->view, ['data' => $this->viewData], function ($message) {
            $message->from($this->from, 'Yami');

            $message->to($this->to);

            //Attach file $pathToFile
            if ($this->attach)
                $message->attach($this->attach);

            //Add a subject
            $message->subject($this->subject);

            if ($this->cc)
                $message->cc($this->cc);
            if ($this->bcc)
                $message->bcc($this->bcc);

        });

        return response()->json(['message' => 'Request completed']);
    }
}
