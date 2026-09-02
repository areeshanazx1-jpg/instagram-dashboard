<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InstagramAccount;
use App\Models\ActionLog;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalAccounts = InstagramAccount::count();
        $activeAccounts = InstagramAccount::where('status', 'active')->count();
        $inactiveAccounts = InstagramAccount::where('status', 'inactive')->count();
        $recentAccounts = InstagramAccount::latest()->take(5)->get();
        $recentLogs = ActionLog::with('instagramAccount')->latest()->take(5)->get();
        
        return view('admin.dashboard', compact(
            'totalAccounts',
            'activeAccounts',
            'inactiveAccounts',
            'recentAccounts',
            'recentLogs'
        ));
    }
}