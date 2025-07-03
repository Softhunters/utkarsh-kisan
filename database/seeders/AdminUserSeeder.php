<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'utkarshkisan@admin.com'],
            [
                'name' => 'Admin',
                'email' => 'utkarshkisan@admin.com',
                'phone' => '9999999999',
                'password' => Hash::make('admin@123'),
                'profile' => '',
                'utype' => 'ADM',
                'status' => 1,
                'is_active' => 1,
                'device_token' => null,
                'referral_code' => Str::random(6),
                'referral_by' => null,
                'otp' => null,
            ]
        );
    }
}
