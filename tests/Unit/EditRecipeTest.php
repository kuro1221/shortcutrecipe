<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use App\Recipe;
use App\User;
use App\Product;
use App\Application;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Recipe\UseCase\EditRecipeUseCase;
use Illuminate\Http\Request;

class EditRecipeTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();
        $this->seed('UsersTableSeeder');
        $this->seed('ApplicationsTableSeeder');
        $this->seed('ProductsTableSeeder');
        $this->seed('RecipesTableSeeder');
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testEditRecipeName()
    {
        $recipe = Recipe::query()->first();
        $recipe->recipe_name = str_repeat('a', 20);
        $recipe->save();
        $this->assertDatabaseHas('recipes', [
            'recipe_name' => str_repeat('a', 20)
        ]);
    }

    public function testEditRecipeUseCase()
    {
        $user = User::query()->first();
        $application = Application::query()->first();
        $product = Product::query()->first();
        $response = $this->actingAs($user);
        $recipe = Recipe::query()->first();
        $request = new Request();
        $request->user_id = $user->id;
        $request->select_application = $application->id;
        $request->select_product = $product->id;
        $editRecipeUseCase = new EditRecipeUseCase();
        $editRecipeUseCase->handle($recipe, $request);
        $this->assertDatabaseHas('recipes_relation_products', [
            'recipe_id' => $recipe->id,
            'product_id' => $product->id
        ]);
    }
}
