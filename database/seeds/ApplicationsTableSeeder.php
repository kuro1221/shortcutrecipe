<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ApplicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $applications = [
            [
                'application_name' => 'メモ',
                'delete_flg' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'application_name' => 'applemusic',
                'delete_flg' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'application_name' => 'リマインダー',
                'delete_flg' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'application_name' => 'メール',
                'delete_flg' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'application_name' => '時計',
                'delete_flg' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'application_name' => '天気',
                'delete_flg' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ];
        foreach ($applications as $application) {
            DB::table('applications')->insert($application);
        }
    }
}
