<?php

namespace App\Mail\report;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Concerns\FromView;

class ReportEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $report;
    public $attachements;
    public $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($report, $attachments, $subject)
    {
        $this->report = $report;
        $this->attachements = $attachments;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $email = $this->subject($this->subject)
                    ->from('dpwsnetwork@bfclimited.com')
                    ->view('emails.report.report-email');

                    if($this->attachements){
                        foreach ($this->attachements as  $attachment) {
                            $email->attach(public_path('storage/'.$attachment['path'],[
                                'as' => $attachment['name'],
                                'mime'=> 'file-mime-type',
                            ]));
                        }
                    }
    }

}
