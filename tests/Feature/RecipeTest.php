<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Recipe;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

class RecipeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function testExample()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    public function test_recipe_controller()
    {
        Auth::loginUsingId(1);
        $this->store();
    }

    private function store()
    {
        $recipe = new Recipe;
        $recipe->recipe_name = "test";
        $recipe->iCloud_link = "rese";
        $recipe->user_id = Auth::id();
        $recipe->comment = "aa";
        $recipe->save();
    }
}
