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
                ['recipe_name', 'iCloud_link', 'comment', 'reference_title', 'reference_url'],
                [str_repeat('a', 20), 'http://example.com/' . str_repeat('a', 131), str_repeat('a', 200), str_repeat('a', 20), 'http://example.com/' . str_repeat('a', 131)],
                true
            ],
            'recipi_name空エラー' => [
                ['recipe_name', 'iCloud_link', 'comment'],
                ['', 'http://example.com', 'test1'],
                false
            ],

            'recipi_name最大文字数エラー' => [
                ['recipe_name', 'iCloud_link', 'comment'],
                [str_repeat('a', 21), 'http://example.com', 'test1'],
                false
            ],
            'iCloud_link最大文字数エラー' => [
                ['recipe_name', 'iCloud_link', 'comment'],
                [str_repeat('a', 20), '', 'test1'],
                false
            ],
            'iCloud_link最大文字数エラー' => [
                ['recipe_name', 'iCloud_link', 'comment'],
                [str_repeat('a', 20), 'http://example.com' . str_repeat('a', 133), 'test1'],
                false
            ],
            'comment空OK' => [
                ['recipe_name', 'iCloud_link', 'comment'],
                [str_repeat('a', 20), 'http://example.com', ''],
                true
            ],
            'comment最大文字数エラー' => [
                ['recipe_name', 'iCloud_link', 'comment'],
                [str_repeat('a', 20), 'http://example.com', str_repeat('a', 251)],
                false
            ],
        ];
    }
}
