<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function showList() {
        $model = new Product();
        $products = $model->getList();

        return view('item_all', ['products' => $products]);
    }

    public function productNew() {
        $companies = DB::table('companies')->get();
        return view('product_new', ['companies' => $companies]);
    }

    public function registSubmit(ProductRequest $request) {
        \Log::info('フォーム送信内容', $request->all());
        if($request->hasFile('img_path')){
            $image = $request->file('img_path');
            $file_name = $image->getClientOriginalName();
            $image->storeAs('public/images', $file_name);
            $image_path = 'storage/images/' . $file_name;
        } else {
            $image_path = null;
        }

        DB::beginTransaction();

        try {
            $model = new Product();
            $model->registProduct($request, $image_path);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }

        return redirect(route('product_new'));
    }
}
