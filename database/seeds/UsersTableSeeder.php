<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = [
            [
                'name' => 'TestUser',
                'email' => 'tdest2@teest.com',
                'password' => bcrypt('tttttttt'),
                'delete_flg' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'ゲストユーザー',
                'email' => env('GUEST_EMAIL'),
                'password' => bcrypt(env('GUEST_PASSWORD')),
                'delete_flg' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }
    }
}
