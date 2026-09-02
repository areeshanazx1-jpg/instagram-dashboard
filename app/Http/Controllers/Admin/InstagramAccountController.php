<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstagramAccountRequest;
use App\Models\InstagramAccount;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InstagramAccountController extends Controller
{
    // 1. Index function - already hai
    public function index(): View
    {
        $accounts = InstagramAccount::latest()->paginate(10);
        return view('admin.accounts.index', compact('accounts'));
    }

    // 2. Store function - YEH ADD KARNA HAI (NAYA FUNCTION)
    public function store(StoreInstagramAccountRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        InstagramAccount::create($validated);
        
        return redirect()->route('admin.accounts.index')
            ->with('success', 'Account created successfully.');
    }

    // 3. Toggle Status - already hai
    public function toggleStatus(Request $request, InstagramAccount $account): RedirectResponse
    {
        $newStatus = $account->status === 'active' ? 'inactive' : 'active';
        $account->update(['status' => $newStatus]);
        
        return redirect()->back()->with('success', "Account status updated to {$newStatus}");
    }

    // 4. Destroy - already hai
    public function destroy(InstagramAccount $account): RedirectResponse
    {
        $account->delete();
        return redirect()->route('admin.accounts.index')
            ->with('success', 'Account deleted successfully.');
    }
}