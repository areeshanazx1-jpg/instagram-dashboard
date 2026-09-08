<?php

namespace App\Console\Commands;

use App\Models\InstagramAccount;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CheckTokenExpiry extends Command
{
    protected $signature = 'tokens:check';
    protected $description = 'Check Instagram/Facebook access token expiry';

    public function handle()
    {
        $accounts = InstagramAccount::where('status', 'active')->get();

        if ($accounts->isEmpty()) {
            $this->info('No active accounts found.');
            return 0;
        }

        foreach ($accounts as $account) {
            $response = Http::get('https://graph.facebook.com/v20.0/me', [
                'access_token' => $account->access_token,
            ]);

            if ($response->failed()) {
                $account->update(['status' => 'inactive']);
                $this->warn("Token expired for: " . $account->username);
            } else {
                $account->update(['last_sync_at' => now()]);
                $this->info("Token valid for: " . $account->username);
            }
        }

        $this->info('Token check completed.');
        return 0;
    }
}