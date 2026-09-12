<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use App\Models\InstagramAccount;
use App\Jobs\ProcessInstagramActionJob;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    public function dispatch(Request $request)
    {
        $request->validate([
            'target_username' => 'required|string',
            'action_type' => 'required|string',
        ]);

        $account = InstagramAccount::where('status', 'active')->latest()->first();

        if (!$account) {
            return redirect()->back()->with('error', 'No active Instagram account found.');
        }

        $actionLog = ActionLog::create([
            'instagram_account_id' => $account->id,
            'target_username' => $request->target_username,
            'action_type' => $request->action_type,
            'status' => 'pending',
            'response_payload' => null,
        ]);

        ProcessInstagramActionJob::dispatch($actionLog);

        return redirect()->back()->with('success', 'Action dispatched to queue!');
    }
}