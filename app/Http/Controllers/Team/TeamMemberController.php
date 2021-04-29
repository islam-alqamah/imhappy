<?php

namespace App\Http\Controllers\Team;

use App\Models\Team;
use App\Models\TeamInvite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Mpociot\Teamwork\Facades\Teamwork;

class TeamMemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the members of the given team.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = Team::findOrFail($id);

        return view('teamwork.members.list')->withTeam($team);
    }

    /**
     * Accept the given invite.
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function acceptInvite($token)
    {
        $invite = $this->getInviteFromAcceptToken($token);
        if (! $invite) {
            abort(404);
        }

        if (auth()->check()) {
            Teamwork::acceptInvite($invite);

            return redirect()->route('teams.index');
        } else {
            session(['invite_token' => $token]);

            return redirect()->to('login');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $team_id
     * @param int $user_id
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy($team_id, $user_id)
    {
        $teamModel = config('teamwork.team_model');
        $team = $teamModel::findOrFail($team_id);
        if (! auth()->user()->isOwnerOfTeam($team)) {
            abort(403);
        }

        $user = User::findOrFail($user_id);
        if ($user->getKey() === auth()->user()->getKey()) {
            abort(403);
        }

        $user->detachTeam($team);

        return redirect(route('teams.index'));
    }

    /**
     * @param Request $request
     * @param int $team_id
     * @return $this
     */
    public function invite(Request $request, $team_id)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $team = Team::findOrFail($team_id);

        if (! Teamwork::hasPendingInvite($request->email, $team)) {
            $this->inviteToTeam($request->email, $team, function ($invite) {
                Mail::send('teamwork.emails.invite', ['team' => $invite->team, 'invite' => $invite], function ($m) use ($invite) {
                    $m->to($invite->email)->subject('Invitation to join team '.$invite->team->name);
                });
                // Send email to user
            });
        } else {
            return redirect()->back()->withErrors([
                'email' => 'The email address is already invited to the team.',
            ]);
        }

        return redirect(route('teams.members.show', $team->id));
    }

    /**
     * Resend an invitation mail.
     *
     * @param $invite_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function resendInvite($invite_id)
    {
        $invite = TeamInvite::findOrFail($invite_id);
        Mail::send('teamwork.emails.invite', ['team' => $invite->team, 'invite' => $invite], function ($m) use ($invite) {
            $m->to($invite->email)->subject('Invitation to join team '.$invite->team->name);
        });

        return redirect(route('teams.members.show', $invite->team));
    }

    /**
     * Invite an email adress to a team.
     * Either provide a email address or an object with an email property.
     *
     * If no team is given, the current_team_id will be used instead.
     *
     * @param string|User $user
     * @param null|Team $team
     * @param callable $success
     * @return TeamInvite
     * @throws \Exception
     */
    public function inviteToTeam($user, $team = null, callable $success = null)
    {
        if (is_null($team)) {
            $team = $this->user()->current_team_id;
        } elseif (is_object($team)) {
            $team = $team->getKey();
        } elseif (is_array($team)) {
            $team = $team['id'];
        }

        if (is_object($user) && isset($user->email)) {
            $email = $user->email;
        } elseif (is_string($user)) {
            $email = $user;
        } else {
            throw new \Exception('The provided object has no "email" attribute and is not a string.');
        }

        $invite = $this->app->make(TeamInvite::class);
        $invite->user_id = $this->user()->getKey();
        $invite->team_id = $team;
        $invite->type = 'invite';
        $invite->email = $email;
        $invite->accept_token = md5(uniqid(microtime()));
        $invite->deny_token = md5(uniqid(microtime()));
        $invite->save();

        if (! is_null($success)) {
            // Send the Invitation mail
            // event(new UserInvitedToTeam($invite));
            $success($invite);
        }

        return $invite;
    }

    /**
     * Checks if the given email address has a pending invite for the
     * provided Team.
     * @param $email
     * @param Team|array|int $team
     * @return bool
     */
    public function hasPendingInvite($email, $team)
    {
        if (is_object($team)) {
            $team = $team->getKey();
        }
        if (is_array($team)) {
            $team = $team['id'];
        }

        return $this->app->make(TeamInvite::class)->where('email', '=', $email)->where('team_id', '=', $team)->first() ? true : false;
    }

    /**
     * @param $token
     * @return mixed
     */
    public function getInviteFromAcceptToken($token)
    {
        return TeamInvite::where('accept_token', '=', $token)->first();
    }
}
