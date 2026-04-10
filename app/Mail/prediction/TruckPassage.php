<?php

namespace App\Mail\prediction;

use App\Models\Prediction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TruckPassage extends Mailable
{
    use Queueable, SerializesModels;

    public $prediction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Prediction $prediction)
    {
        $this->prediction = $prediction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('PASSAGE DE VOTRE CAMION')
                    ->from('dpwsnetwork@bfclimited.com')
                    ->view('emails.prediction.predictionEmail');
    }
}
