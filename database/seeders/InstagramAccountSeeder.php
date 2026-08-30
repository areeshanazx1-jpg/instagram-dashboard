<?php

namespace Database\Seeders;

use App\Models\InstagramAccount;
use Illuminate\Database\Seeder;

class InstagramAccountSeeder extends Seeder
{
    public function run(): void
    {
        InstagramAccount::create([
            'account_label' => 'My Business Page',
            'username' => 'my_business_insta',
            'access_token' => 'dummy_token_12345',
            'status' => 'active',
            'last_sync_at' => now(),
        ]);

        InstagramAccount::create([
            'account_label' => 'Test Account',
            'username' => 'test_user_456',
            'access_token' => 'dummy_token_67890',
            'status' => 'inactive',
            'last_sync_at' => null,
        ]);
    }
}