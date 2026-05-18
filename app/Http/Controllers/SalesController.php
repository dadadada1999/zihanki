<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Sale;
use Exception;

class SalesController extends Controller
{
    /**
     * 購入処理API
     */
    public function purchase(Request $request)
    {
        try {
            DB::beginTransaction();

            $product_id = $request->input('product_id');

            $result = Product::buyProduct($product_id);

            if (!$result) {
                DB::rollBack();

                return response()->json([
                    'result' => false,
                    'message' => '購入できません。',
                ], 400);
            }

            Sale::createSale($product_id);

            DB::commit();

            return response()->json([
                'result' => true,
                'message' => '購入が完了しました。',
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'result' => false,
                'message' => '購入処理に失敗しました。',
            ], 500);
        }
    }
}