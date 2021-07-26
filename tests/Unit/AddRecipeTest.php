<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Recipe;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Requests\AddRecipeRequest;
use Illuminate\Support\Facades\Validator;

class AddRecipeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use RefreshDatabase;


    public function setup(): void
    {
        parent::setUp();
        $this->seed('UsersTableSeeder');
        $this->seed('ProductsTableSeeder');
    }

    /**
     * カスタムリクエストのバリデーションテスト
     *
     * @param array 項目名の配列
     * @param array 値の配列
     * @param boolean 期待値(true:バリデーションOK、false:バリデーションNG)
     * @dataProvider dataRecipeAdd
     */
    public function testRecipeAdd(array $keys, array $values, bool $expect)
    {
        // dd($keys);
        $dataList = array_combine($keys, $values);

        $request = new AddRecipeRequest();
        $rules = $request->rules();
        $validator = Validator::make($dataList, $rules);
        $result = $validator->passes();
        $this->assertEquals($expect, $result);
    }

    public function dataRecipeAdd()
    {
        return [
            'OK' => [
                ['recipe_name', 'iCloud_link', 'comment'],
                ['testaaaaaaaaaaaa', 'http:test.com', 'test1'],
                true
            ],
            'false' => [
                ['recipe_name', 'iCloud_link', 'comment'],
                ['testaaaaaaaaaaaaaaaaaaa', 'http:test.com', 'test1'],
                false
            ]
        ];
    }
}
