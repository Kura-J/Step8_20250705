<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function showList() {
        $model = new Product();
        $products = $model->getList();

        return view('item_all', ['products' => $products]);
    }

    public function productNew() {
        return view('product_new');
    }
}
