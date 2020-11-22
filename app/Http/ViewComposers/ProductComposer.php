<?php

namespace App\Http\ViewComposers;

use App\Product;
use Illuminate\Contracts\View\View;

class ProductComposer
{
    public function  __construct()
    {
        // $Product_list = Product::where('delete_flg', false)->get();
    }

    public function compose(View $view)
    {
        $product_list = Product::where('delete_flg', false)->get();
        $view->with('product_list', $product_list);
    }
}
