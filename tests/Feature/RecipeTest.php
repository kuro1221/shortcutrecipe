<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Recipe;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

class RecipeTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();
        $this->seed('UsersTableSeeder');
        $this->seed('ProductsTableSeeder');
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_recipe_controller()
    {
        // Auth::loginUsingId(1);
        $testUser = User::query()->first();
        Auth::loginUsingId($testUser->id);
        $this->store();
    }

    private function store()
    {
        $recipe = new Recipe;
        $recipe->recipe_name = "test";
        $recipe->iCloud_link = "testLink";
        $recipe->user_id = Auth::id();
        $recipe->comment = "aa";
        $recipe->save();
    }

    public function addRecipeFailed()
    {
        $testUser = User::query()->first();
        Auth::loginUsingId($testUser->id);
        $recipe = new Recipe;
        $recipe->recipe_name = "aaaaaaaaaaaaaaaaaaaaa"; //20文字以上のため失敗
        $recipe->iCloud_link = "testLink";
        $recipe->user_id = Auth::id();
        $recipe->comment = "aa";
        $recipe->save();
    }

    public function testSaveCorrectData()
    {
        $this->test_recipe_controller();
        $this->assertDatabaseHas('recipes', [
            'recipe_name' => "test",
            'iCloud_link' => 'testLink',
            'user_id' => Auth::id(),
            'comment' => "aa"
        ]);
    }
}
