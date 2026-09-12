<?php

namespace App\Jobs;

use App\Models\ActionLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class ProcessInstagramActionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    public $tries = 3;
    public $backoff = [5, 10, 30];

    protected $actionLog;

    public function __construct(ActionLog $actionLog)
    {
        $this->actionLog = $actionLog;
    }

    public function handle(): void
    {
        $account = $this->actionLog->instagramAccount;

        try {
            // Instagram Graph API call
            $response = Http::get('https://graph.instagram.com/v20.0/me', [
                'fields' => 'id,username',
                'access_token' => $account->access_token,
            ]);

            if ($response->successful()) {
                $this->actionLog->update([
                    'status' => 'success',
                    'response_payload' => [
                        'http_code' => $response->status(),
                        'message' => 'Action processed successfully',
                        'data' => $response->json(),
                    ],
                ]);
            } else {
                $this->actionLog->update([
                    'status' => 'failed',
                    'response_payload' => [
                        'http_code' => $response->status(),
                        'error' => $response->json(),
                    ],
                ]);
            }
        } catch (\Exception $e) {
            $this->actionLog->update([
                'status' => 'failed',
                'response_payload' => [
                    'error' => $e->getMessage(),
                ],
            ]);
        }
    }
}