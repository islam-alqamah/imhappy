<?php

namespace App\Console\Commands;

use App\Models\Team;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EmailTeamsWithExpiringTrials extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:teams-with-expiring-trials';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email teams with expiring trials.';

    protected $mailsSent = 0;

    protected $mailFailures = 0;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Sending trial expiring soon mails...');

        Team::all()
            ->filter->onSoonExpiringTrial()
            ->each(function (Team $team) {
                $this->sendTrialEndingSoonMail($team);
            });

        $this->info("{$this->mailsSent} trial expiring mails sent!");

        if ($this->mailFailures > 0) {
            $this->error("Failed to send {$this->mailFailures} trial expiring mails!");
        }
    }

    protected function sendTrialEndingSoonMail(Team $team)
    {
        try {
            if ($team->wasAlreadySentTrialExpiringSoonMail()) {
                return;
            }

            $this->comment("Mailing {$team->owner->email} (team {$team->name})");
            // Mail::to($team->owner->email)->send(new TrialExpiringSoon($team));

            $beautymail = app()->make(Snowfire\Beautymail\Beautymail::class);
            $beautymail->send('emails.trial_expiring', ['team' => $team], function ($message) use ($team) {
                $message
                    ->from(config('mail.from.address'))
                    ->to($team->owner->email, $team->owner->name)
                    ->subject(config('app.name').__('trial account will expire soon'));
            });

            $this->mailsSent++;

            $team->rememberHasBeenSentTrialExpiringSoonMail();
        } catch (Exception $exception) {
            $this->error("exception when sending mail to team {$team->id}", $exception);
            report($exception);
            $this->mailFailures++;
        }
    }
}
