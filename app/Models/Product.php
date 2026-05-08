<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Product extends Model
{
    use HasFactory;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * 商品一覧取得
     */
    public static function getProductList()
    {
        return self::all();
    }

    /**
     * 商品検索
     */
    public static function searchProducts($product_name, $company_id)
    {
        $query = self::query();

        if (!empty($product_name)) {
            $query->where(
                'product_name',
                'LIKE',
                '%' . $product_name . '%'
            );
        }

        if (!empty($company_id)) {
            $query->where(
                'company_id',
                $company_id
            );
        }

        return $query->get();
    }

    /**
     * 商品登録
     */
    public static function createProduct(
        $product_name,
        $company_id,
        $price,
        $stock,
        $comment,
        $img_path
    ) {
        $product = new self();

        $product->product_name = $product_name;
        $product->company_id = $company_id;
        $product->price = $price;
        $product->stock = $stock;
        $product->comment = $comment;
        $product->img_path = $img_path;

        $product->save();
    }

    /**
     * 商品削除
     */
    public static function deleteProduct($id)
    {
        $product = self::find($id);

        if ($product) {
            $product->delete();
        }
    }

    /**
     * 商品詳細取得
     */
    public static function getProductDetail($id)
    {
        return self::find($id);
    }

    /**
     * 商品更新
     */
    public static function updateProduct($request, $id, $img_path)
    {
        $product = self::find($id);

        $product->product_name = $request->product_name;
        $product->company_id = $request->company_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->comment = $request->comment;
        $product->img_path = $img_path;

        $product->save();
    }
}