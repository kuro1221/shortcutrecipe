<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\User;

class RecipesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //
        $recipes = [
            [
                'user_id' => User::query()->first()->id,
                'recipe_name' => 'Testr',
                'comment' => 'tdest1@teest.com',
                'iCloud_link' => 'htt://tdest1@teest.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];
        foreach ($recipes as $recipe) {
            DB::table('recipes')->insert($recipe);
        }
    }
}
