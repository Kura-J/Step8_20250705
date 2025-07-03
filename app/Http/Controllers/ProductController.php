<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function showList(Request $request) {
        $model = new Product();
        $keyword = $request->input('keyword');
        $makerId = $request->input('maker');

        $products = $model->getFilteredProducts($keyword, $makerId)->appends($request->all());
        $companies = $model->getAllCompanies();

        return view('product_list', [
            'products' => $products,
            'companies' => $companies,
        ]);
    }

    public function productNew() {
        $model = new Product();
        $companies = $model->getAllCompanies();
        return view('product_new', ['companies' => $companies]);
    }

    public function registSubmit(ProductRequest $request) {
        if ($request->hasFile('img_path')) {
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
        $model = new Product();
        $product = $model->getProductDetail($id);

        return view('product_detail', ['product' => $product]);
    }

    public function productEdit($id) {
        $model = new Product();
        $product = $model->getProductById($id);
        $companies = $model->getAllCompanies();

        return view('product_edit', [
            'product' => $product,
            'companies' => $companies
        ]);
    }

    public function productUpdate(ProductRequest $request, $id) {

        DB::beginTransaction();

        try {
            if ($request->hasFile('img_path')) {
                $image = $request->file('img_path');
                $file_name = $image->getClientOriginalName();
                $image->storeAs('public/images', $file_name);
                $image_path = 'storage/images/' . $file_name;
            } else {
                $image_path = $request->existing_img_path;
            }

            $model = new Product();
            $model->updateProduct($id, $request, $image_path);

            DB::commit();
            return redirect()->route('product_edit', ['id' => $id]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back();
        }
    }

    public function productDelete($id) {
        DB::beginTransaction();

        try {
            $model = new Product();
            $model->deleteProduct($id);

            DB::commit();
            return redirect()->route('home');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back();
        }
    }
}
