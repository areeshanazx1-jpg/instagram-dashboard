<?php

namespace App\Http\Controllers;

use App\Models\InstagramAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;

class MetaAuthController extends Controller
{
    public function redirectToMeta()
    {
        $appId = env('META_CLIENT_ID');
        $redirectUri = env('META_REDIRECT_URI');
        
        $url = "https://www.facebook.com/v20.0/dialog/oauth?" . http_build_query([
            'client_id' => $appId,
            'redirect_uri' => $redirectUri,
            'scope' => 'public_profile',
            'response_type' => 'code',
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
        $response = Http::post('https://graph.facebook.com/v20.0/oauth/access_token', [
            'client_id' => env('META_CLIENT_ID'),
            'client_secret' => env('META_CLIENT_SECRET'),
            'redirect_uri' => env('META_REDIRECT_URI'),
            'code' => $code,
        ]);

        if ($response->failed()) {
            return redirect('/admin/dashboard')->with('error', 'Token exchange failed.');
        }

        $data = $response->json();
        $shortLivedToken = $data['access_token'];
        
        // Exchange for long-lived token
        $longLivedResponse = Http::get('https://graph.facebook.com/v20.0/oauth/access_token', [
            'grant_type' => 'fb_exchange_token',
            'client_id' => env('META_CLIENT_ID'),
            'client_secret' => env('META_CLIENT_SECRET'),
            'fb_exchange_token' => $shortLivedToken,
        ]);

        if ($longLivedResponse->failed()) {
            return redirect('/admin/dashboard')->with('error', 'Long-lived token exchange failed.');
        }

        $longLivedData = $longLivedResponse->json();
        $longLivedToken = $longLivedData['access_token'];

        // Get user info from Facebook
        $userResponse = Http::get('https://graph.facebook.com/v20.0/me', [
            'access_token' => $longLivedToken,
            'fields' => 'id,name',
        ]);

        $userData = $userResponse->json();
        $username = $userData['name'] ?? 'facebook_user';
        $facebookId = $userData['id'] ?? 'unknown';

        // Save to database (auto-encrypted by model mutator)
        InstagramAccount::create([
            'account_label' => 'My Facebook Account',
            'username' => $username,
            'access_token' => $longLivedToken,
            'status' => 'active',
            'last_sync_at' => now(),
        ]);

        return redirect('/admin/dashboard')->with('success', 'Facebook account connected successfully!');
    }
}