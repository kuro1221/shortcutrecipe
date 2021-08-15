<?php

namespace App\Recipe\UseCase;

use Illuminate\Support\Facades\Log;

use App\Recipe;
use App\User;
use App\RecipesRelationApplication;
use App\RecipesRelationSituation;
use App\RecipesRelationProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

final class EditRecipeUseCase
{
    public function handle($recipe, $request)
    {
        DB::transaction(function () use ($recipe, $request) {
            $recipe->fill($request->all());
            $recipe->user_id = Auth::id();
            $recipe->save();
            $recipe->applications()->sync($request->select_application);
            $recipe->products()->sync($request->select_product);
        });
    }
}
