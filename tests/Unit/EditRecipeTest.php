<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Recipe;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Requests\EditRecipeRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditRecipeTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();
        $this->seed('UsersTableSeeder');
        $this->seed('ProductsTableSeeder');
        $this->seed('RecipesTableSeeder');
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $recipe = Recipe::query()->first();
        $recipe->recipe_name = str_repeat('a', 20);
        // dd($recipe);
        $recipe->save();
        $this->assertDatabaseHas('recipes', [
            'recipe_name' => str_repeat('a', 20)
        ]);
    }

    // public function testRecipeEdit(array $keys, array $values, bool $expect)
    // {
    // }
}
