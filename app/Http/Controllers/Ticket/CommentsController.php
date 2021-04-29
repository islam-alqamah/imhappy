<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Mail\SendTicket;
use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function postComment(Request $request, SendTicket $mailer)
    {
        /**

         * @post('/account/comment')
         * @name('ticket.comment')
         * @middlewares(web, auth:sanctum, verified)
         */
        $this->validate($request, [
            'comment' => 'required',
        ]);

        $ticket = Ticket::find(request('ticket_id'));

        $ticket->touch();

        if ($ticket->status == 'Closed') {
            $ticket->status = 'Open';
            $ticket->save();

            $comment = Comment::create([
                'ticket_id' => $request->input('ticket_id'),
                'user_id' => Auth::user()->id,
                'comment' => 'Ticket Re-Opened',
            ]);
        }

        $comment = Comment::create([
            'ticket_id' => $request->input('ticket_id'),
            'user_id' => Auth::user()->id,
            'comment' => $request->input('comment'),
        ]);

        // send mail if the user commenting is not the ticket owner
        if ($comment->ticket->user->id !== Auth::user()->id) {
            $mailer->sendTicketComments($comment->ticket->user, Auth::user(), $comment->ticket, $comment);
        }

        return redirect()->back()->with('status', 'Your comment has be submitted.');
    }
}
