<?php

namespace App\Mail\Subscription;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Snowfire\Beautymail\Beautymail;

class SubscriptionCancelled extends Mailable
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

        return $this->subject(__('Subscription Cancelled'))
            ->from(config('mail.from.address'))
            ->view('emails.subscription.cancelled', $beautymail->getData());
    }
}
