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

    public function productDetail($id) {
        $product = DB::table('products')
            ->join('companies', 'products.company_id', '=', 'companies.id')
            ->select('products.*', 'companies.company_name as company_name')
            ->where('products.id', $id)
            ->first();

        return view('product_detail', ['product' => $product]);
    }

    public function productEdit($id) {
        $product = DB::table('products')
            ->where('id', $id)
            ->first();
        
        $companies = DB::table('companies')->get();

        return view('product_edit', [
            'product' => $product,
            'companies' => $companies
        ]);
    }

    public function productUpdate(ProductRequest $request, $id) {
        if($request->hasFile('img_path')) {
            $image = $request->file('img_path');
            $file_name = $image->getClientOriginalName();
            $image->storeAs('public/images', $file_name);
            $image_path = 'storage/images/' . $file_name;
        } else {
            $image_path = $request->existing_img_path;
        }

        DB::table('products')
            ->where('id', $id)
            ->update([
                'product_name' => $request->product_name,
                'company_id' => $request->company_id,
                'price' => $request->price,
                'stock' => $request->stock,
                'comment' => $request->comment,
                'img_path' => $image_path,
                'updated_at' => now(),
            ]);
        
        return redirect()->route('product_detail', ['id' => $id]);
    }
}
