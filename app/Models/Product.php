<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\carbon;

class Product extends Model
{
    public function getFilteredProducts($keyword, $makerId)
    {
        $query = DB::table('products')
            ->join('companies', 'products.company_id', '=', 'companies.id')
            ->select('products.*', 'companies.company_name as company_name');
        
        if (! empty($keyword)) {
            $query->where('products.product_name', 'like', '%' . $keyword . '%');
        }

        if (! empty($makerId)) {
            $query->where('products.company_id', $makerId);
        }

        if (! empty(request('price-min'))) {
            $query->where('products.price', '>=', request('price-min'));
        }

        if (!empty(request('price-max'))) {
            $query->where('products.price', '<=', request('price-max'));
        }

        if (!empty(request('stock-min'))) {
            $query->where('products.stock', '>=', request('stock-min'));
        }

        if (!empty(request('stock-max'))) {
            $query->where('products.stock', '<=', request('stock-max'));
        }

        return $query->paginate(5);
    }

    public function getAllCompanies()
    {
        return DB::table('companies')->get();
    }

    public function registProduct($data, $image_path) {
        DB::table('products')->insert([
            'product_name' => $data->product_name,
            'company_id' => $data->company_id,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $image_path,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

    public function getProductDetail($id)
    {
        return DB::table('products')
            ->join('companies', 'products.company_id', '=', 'companies.id')
            ->select('products.*', 'companies.company_name as company_name')
            ->where('products.id', $id)
            ->first();
    }

    public function getProductById($id)
    {
        return DB::table('products')->where('id', $id)->first();        
    }

    public function updateProduct($id, $data, $image_path)
    {
        DB::table('products')->where('id', $id)->update([
            'product_name' => $data->product_name,
            'company_id' => $data->company_id,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $image_path,
            'updated_at' => now(),
        ]);
    }

    public function deleteProduct($id)
    {
        DB::table('products')->where('id', $id)->delete();
    }

    public function reduceStock($productId, $newStock)
    {
        DB::table('products')
            ->where('id', $productId)
            ->update(['stock' => $newStock]);
    }

    public function getProduct($productId)
    {
        return DB::table('products')
            ->where('id', $productId)
            ->lockForUpdate()
            ->first();
    }
}
