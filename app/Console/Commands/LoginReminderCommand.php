<?php

namespace App\Console\Commands;

use App\Models\Client;
use App\Models\User;
use App\Notifications\LoginReminderNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class LoginReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:login';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind Client to that haven\'t logged in for a year.';

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
        Client::all()->filter(function ($client){
            $now = Carbon::now();
            return $client->last_login && $now->diffInYears($client->last_login)>1 && ($client->last_notified || $now->diffInYears($client->last_notified)>1);
        })->each("notifyClient");
        return 0;
    }

    private function notifyClient($client){
        $client->user->notify(new LoginReminderNotification($client->user));
        $client->last_notified = Carbon::now();
        $client->save();
    }
}
