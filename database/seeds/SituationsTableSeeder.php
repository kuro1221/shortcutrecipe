<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SituationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $situations = [
            [
                'situation_name' => '仕事',
                'delete_flg' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'situation_name' => '移動',
                'delete_flg' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'situation_name' => '運動',
                'delete_flg' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'situation_name' => '勉強',
                'delete_flg' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        foreach ($situations as $situation) {
            DB::table('situations')->insert($situation);
        }
    }
}
