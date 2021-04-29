<?php

namespace App\Mail\Subscription;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Snowfire\Beautymail\Beautymail;

class CardUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $beautymail = app()->make(Beautymail::class);

        return $this->subject(__('Card Updated'))
            ->from(config('mail.from.address'))
            ->to($this->user->email)
            ->view('emails.subscription.card', $beautymail->getData());
    }
}
