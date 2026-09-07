<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class DeleteUnverifiedUsers extends Command
{
    protected $signature = 'users:delete-unverified';
    protected $description = 'Delete users who haven\'t verified their email within the expiration time';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get the users who are unverified and whose verification code has expired
        $expiredUsers = User::whereNull('email_verified_at')
                            ->where('expires_at', '<', now())
                            ->get();

        if ($expiredUsers->isEmpty()) {
            $this->info('No expired users found.');
        } else {
            $count = $expiredUsers->count();
            $this->info("Found {$count} expired users.");

            // Log the emails or ids of users being deleted for debugging
            foreach ($expiredUsers as $user) {
                $this->info("Deleting user: {$user->email}");
            }

            // Delete the expired users
            User::whereNull('email_verified_at')
                ->where('expires_at', '<', now())
                ->delete();

            $this->info('Deleted unverified users.');
        }
    }
}
