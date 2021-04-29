<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Snowfire\Beautymail\Beautymail;

class SendTicket extends Mailable
{
    use Queueable, SerializesModels;

    public $mailer;
    // public $fromName = 'Support Ticket';
    public $to;
    public $name;
    public $subject;
    public $view;
    protected $data = [];

    /**
     * SendTicket constructor.
     * @param $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendTicketInformation($user, Ticket $ticket)
    {
        $this->to = $user->email;

        $this->subject = "[Ticket ID: $ticket->ticket_id] $ticket->title";

        $this->view = 'emails.ticket.ticket_info';

        $beautymail = app()->make(Beautymail::class);
        $beautymail->send($this->view, ['user' => $user, 'ticket' => $ticket], function ($message) use ($user) {
            $message
                    ->from(config('mail.from.address'))
                    ->to($user->email, $user->name)
                    ->subject($this->subject);
        });
    }

    public function sendTicketComments($ticketOwner, $user, Ticket $ticket, $comment)
    {
        $this->to = $ticketOwner->email;

        $this->subject = "RE: $ticket->title (Ticket ID: $ticket->ticket_id)";

        $this->view = 'emails.ticket.ticket_comments';

        $this->data = ['user' => $user, 'ticketOwner' => $ticketOwner, 'ticket' => $ticket, 'comment' => $comment];

        $this->deliver();

    }

    public function sendTicketStatusNotification($ticketOwner, Ticket $ticket)
    {
        $this->to = $ticketOwner->email;
        $this->subject = "RE: $ticket->title (Ticket ID: $ticket->ticket_id)";
        $this->view = 'emails.ticket.ticket_status';

        $beautymail = app()->make(Beautymail::class);
        $beautymail->send($this->view, ['ticket' => $ticket, 'ticketOwner' => $ticketOwner], function ($message) {
            $message
                    ->from(config('mail.from.address'))
                    ->to($this->to)
                    ->subject($this->subject);
        });
    }

    public function deliver()
    {
        // $this->mailer->send($this->view, $this->data, function($message){

        //     $message->from(config('mail.from.address'), config('mail.from.address'))
        //             ->to($this->to)->subject($this->subject);

        // });
        $beautymail = app()->make(Beautymail::class);
        $beautymail->send($this->view, $this->data, function ($message) {
            $message
                    ->from(config('mail.from.address'), config('mail.from.name'))
                    ->to($this->to, $this->name)
                    ->subject($this->subject);
        });
    }
}
