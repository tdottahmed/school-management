<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\SMSSetting;

class SMSSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('s_m_s_settings')->delete();

        SMSSetting::create([
            'nexmo_key'         => env('NEXMO_KEY', 'dummy_nexmo_key'),
            'nexmo_secret'      => env('NEXMO_SECRET', 'dummy_nexmo_secret'),
            'nexmo_sender_name' => 'ABC',
            'twilio_sid'        => env('TWILIO_SID', 'ACxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'),
            'twilio_auth_token' => env('TWILIO_AUTH_TOKEN', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxx'),
            'twilio_number'     => env('TWILIO_NUMBER', '+10000000000'),
            'status'            => 1,
        ]);
    }
}
