<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GuestUserTest extends TestCase
{

    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();
        $this->seed('UsersTableSeeder');
        $this->seed('ProductsTableSeeder');
    }

    /**
     *
     * @return void
     */
    public function testNotAccessProfileEdit()
    {
        $guestUser = User::where('email', env('GUEST_EMAIL'))->first();
        Log::debug($guestUser);
        Auth::loginUsingId($guestUser->id);
        $response = $this
            ->get('/profileEdit');
        $response->assertRedirect('/recipeList');
    }

    /**
     *
     * @return void
     */
    public function testNotAccessWithdrawal()
    {
        $guestUser = User::where('email', env('GUEST_EMAIL'))->first();
        Log::debug($guestUser);
        Auth::loginUsingId($guestUser->id);
        $response = $this
            ->get('/withdrawalShow');
        $response->assertRedirect('/recipeList');
    }

    /**
     *
     * @return void
     */
    public function testNotAccessPasswordEdit()
    {
        $guestUser = User::where('email', env('GUEST_EMAIL'))->first();
        Log::debug($guestUser);
        Auth::loginUsingId($guestUser->id);
        $response = $this
            ->get('/passwordEdit');
        $response->assertRedirect('/recipeList');
    }
}
