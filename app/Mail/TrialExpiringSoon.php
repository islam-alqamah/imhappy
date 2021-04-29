<?php

namespace App\Mail;

use App\Models\Team;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TrialExpiringSoon extends Mailable
{
    use Queueable, SerializesModels;

    /** @var \App\Team */
    public $team;

    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    public function build()
    {
        return $this
            ->subject(config('app.name').__('trial account will expire soon'))
            ->markdown('mail.trialExpiringSoon', [
                'team' => $this->team,
            ]);
    }
}
