<?php

namespace App\Http\Controllers;

use App\Models\InstagramAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MetaAuthController extends Controller
{
    public function redirectToMeta()
    {
        $appId = env('META_INSTAGRAM_APP_ID');
        $redirectUri = env('META_REDIRECT_URI');
        
        $url = "https://www.instagram.com/oauth/authorize?" . http_build_query([
            'client_id' => $appId,
            'redirect_uri' => $redirectUri,
            'response_type' => 'code',
            'scope' => 'instagram_business_basic,instagram_business_manage_messages',
        ]);
        
        return redirect($url);
    }

    public function handleMetaCallback(Request $request)
    {
        $code = $request->query('code');
        
        if (!$code) {
            return redirect('/admin/dashboard')->with('error', 'Authorization failed.');
        }

        // Exchange code for short-lived token
        $response = Http::asForm()->post('https://api.instagram.com/oauth/access_token', [
            'client_id' => env('META_INSTAGRAM_APP_ID'),
            'client_secret' => env('META_INSTAGRAM_APP_SECRET'),
            'grant_type' => 'authorization_code',
            'redirect_uri' => env('META_REDIRECT_URI'),
            'code' => $code,
        ]);

        if ($response->failed()) {
            return redirect('/admin/dashboard')->with('error', 'Token exchange failed.');
        }

        $data = $response->json();
        $shortLivedToken = $data['access_token'];
        $userId = $data['user_id'];
        
        // Exchange for long-lived token
        $longLivedResponse = Http::get('https://graph.instagram.com/access_token', [
            'grant_type' => 'ig_exchange_token',
            'client_secret' => env('META_INSTAGRAM_APP_SECRET'),
            'access_token' => $shortLivedToken,
        ]);

        if ($longLivedResponse->failed()) {
            return redirect('/admin/dashboard')->with('error', 'Long-lived token exchange failed.');
        }

        $longLivedData = $longLivedResponse->json();
        $longLivedToken = $longLivedData['access_token'];

        // Get user info
        $userResponse = Http::get('https://graph.instagram.com/me', [
            'access_token' => $longLivedToken,
            'fields' => 'id,username',
        ]);

        $userData = $userResponse->json();
        $username = $userData['username'] ?? 'instagram_user';

        InstagramAccount::create([
            'account_label' => 'My Instagram Account',
            'username' => $username,
            'access_token' => $longLivedToken,
            'status' => 'active',
            'last_sync_at' => now(),
        ]);

        return redirect('/admin/dashboard')->with('success', 'Instagram account connected successfully!');
    }
}