<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SaleRequest;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function purchase(SaleRequest $request){
        DB::beginTransaction();

        try {
            $model = new Sale();
            $model->purchaseProduct($request->input('product_id'));
            DB::commit();

            return response()->json(['message' => '購入が完了しました'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
