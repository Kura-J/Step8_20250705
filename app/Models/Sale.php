<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    public function purchaseProduct($productId){
        $product = DB::table('products')->where('id', $productId)->lockForUpdate()->first();

        if (!$product || $product->stock < 1) {
            throw new \Exception('在庫がありません');
        }

        $newStock = $product->stock - 1;

        DB::table('products')
            ->where('id', $productId)
            ->update([
                'stock' => $newStock]);

        DB::table('sales')->insert([
            'product_id' => $productId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
