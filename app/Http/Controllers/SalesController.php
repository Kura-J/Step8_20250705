<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SaleRequest;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function purchase(SaleRequest $request){
        DB::beginTransaction();

        try {
            $productId = $request->input('product_id');

            $productModel = new Product();
            $product = $productModel->getProduct($productId);

            if (!$product || $product->stock < 1) {
                throw new \Exception('在庫がありません');
            }

            $newStock = $product->stock - 1;
            $productModel->reduceStock($productId, $newStock);

            $saleModel = new Sale();
            $saleModel->purchaseProduct($productId);
            DB::commit();

            return response()->json(['message' => '購入が完了しました'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
