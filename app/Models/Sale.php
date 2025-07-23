<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class Sale extends Model
{
    public function purchaseProduct($productId){
        $product = DB::table('products')->where('id', $productId)->lockForUpdate()->first();

        if (!$product || $product->stock < 1) {
            throw new \Exception('在庫がありません');
        }

        $newStock = $product->stock - 1;

        $productModel = new Product();
        $productModel->reduceStock($productId, $newStock);

        DB::table('sales')->insert([
            'product_id' => $productId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
