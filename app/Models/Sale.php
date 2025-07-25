<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class Sale extends Model
{
    public function purchaseProduct($productId){
        DB::table('sales')->insert([
            'product_id' => $productId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
