<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ManagementActions;
use App\Mail\ManagementActionDraftReminder;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendDraftReminders extends Command
{
 
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:drafts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders for draft management actions older than 3 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
          $drafts = ManagementActions::where('status', 'draft')
            ->where('created_at', '<=', Carbon::now()->subDays(5))
            ->whereNull('reminder_sent_at')   // only send if no reminder sent yet
            ->get();

        foreach ($drafts as $draft) {
            if ($draft->user && $draft->user->email) {
                Mail::to($draft->user->email)->send(new ManagementActionDraftReminder($draft));
                // mark reminder as sent so it won't be re-sent
                $draft->update(['reminder_sent_at' => now()]);
            }
        }

        $this->info('Draft reminders processed: ' . $drafts->count());
    }
}
