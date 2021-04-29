<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Mail\SendTicket;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TicketsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**

         * @get('/admin/tickets')
         * @name('admin.tickets')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        $tickets = Ticket::orderBy('updated_at', 'desc')->paginate(10);

        return view('admin.tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /**

         * @get('/account/new-ticket')
         * @name('ticket.create')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        $categories = Category::all();

        return view('tickets.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SendTicket $mailer)
    {
        /**

         * @post('/account/new-ticket')
         * @name('ticket.')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'priority' => 'required',
            // 'domain' => 'required',
            'message' => 'required',
        ]);
        // $plan = currentTeam()->subscribed() ? currentTeam()->subscriptions()->first()->stripe_plan : 'Not subscribed';
        $ticket = new Ticket([
            'title' => $request->input('title'),
            'user_id' => Auth::user()->id,
            'ticket_id' => strtoupper(Str::random(10)),
            'category_id' => $request->input('category'),
            'priority' => $request->input('priority'),
            // 'domain' => $request->input('domain'),
            // 'email' => $request->input('email'),
            // 'subscription' => $plan,
            'message' => $request->input('message'),
            'status' => 'Open',
            'team_id' => currentTeam()->id,
        ]);

        $ticket->save();

        $mailer->sendTicketInformation(Auth::user(), $ticket);

        return redirect(route('ticket.show', ['ticket_id' => $ticket->ticket_id]))->with('status', "A ticket with ID: #$ticket->ticket_id has been opened.");
    }

    public function userTickets()
    {
        /**

         * @get('/account/my_tickets')
         * @name('ticket.index')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        $categories = Category::paginate(10);
        $tickets = Ticket::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->paginate(6);

        return view('tickets.user_tickets', compact('tickets', 'categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ticket_id)
    {
        /**

         * @get('/account/tickets/{ticket_id}')
         * @name('ticket.show')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        $ticket = Ticket::where('ticket_id', $ticket_id)->where('user_id', Auth::user()->id)->firstOrFail();

        return view('tickets.show', compact('ticket'));
    }

    // Show single ticket on admin panel
    public function adminshow($ticket_id)
    {
        /**

         * @get('/admin/tickets/{ticket_id}')
         * @name('admin.')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

        return view('admin.tickets.show', compact('ticket'));
    }

    public function close($ticket_id, SendTicket $mailer)
    {
        /**

         * @post('/admin/close_ticket/{ticket_id}')
         * @name('admin.')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

        $ticket->status = 'Closed';

        $ticket->save();

        $comment = Comment::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::user()->id,
            'comment' => 'Ticket Closed',
        ]);

        $ticketOwner = $ticket->user;

        $mailer->sendTicketStatusNotification($ticketOwner, $ticket);

        return redirect()->back()->with('status', 'The ticket has been closed.');
    }

    public function close_by_user(SendTicket $mailer)
    {
        /**

         * @post('/account/close_ticket')
         * @name('ticket.close_by_user')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        $ticket = Ticket::where('ticket_id', request('ticket_id'))->where('user_id', Auth::user()->id)->firstOrFail();

        $ticket->status = 'Closed';

        $ticket->save();

        $comment = Comment::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::user()->id,
            'comment' => 'Ticket Closed',
        ]);

        $ticketOwner = $ticket->user;

        $mailer->sendTicketStatusNotification($ticketOwner, $ticket);

        return redirect()->back()->with('status', 'The ticket has been closed.');
    }
}
