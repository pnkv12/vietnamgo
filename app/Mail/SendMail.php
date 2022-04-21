<?php

namespace App\Mail;

use App\Models\TicketTable;
use App\Models\ToursTable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;
    // public $tourInfo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->subject = "Tour Confirmation Email";
        $this->data = $data;
        // $this->tourInfo = $tourInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        $data = $request->all();

        return $this->subject($this->subject)->replyTo('pnkv12@gmail.com', 'Vy Pham')
            ->view('mails.mailing', ['data' => $data]);
    }
}
