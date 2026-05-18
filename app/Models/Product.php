<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Product extends Model
{
    use HasFactory;

    /**
     * メーカーリレーション
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * 商品一覧取得
     */
    public static function getProductList()
    {
        return self::with('company')->get();
    }

    /**
     * 商品検索
     */
    public static function searchProducts(
        $product_name,
        $company_id,
        $price_min,
        $price_max,
        $stock_min,
        $stock_max,
        $sort_column,
        $sort_direction
    ) {
        $query = self::with('company');

        if (!empty($product_name)) {
            $query->where(
                'product_name',
                'LIKE',
                '%' . $product_name . '%'
            );
        }

        if (!empty($company_id)) {
            $query->where('company_id', $company_id);
        }

        if (!empty($price_min)) {
            $query->where('price', '>=', $price_min);
        }

        if (!empty($price_max)) {
            $query->where('price', '<=', $price_max);
        }

        if (!empty($stock_min)) {
            $query->where('stock', '>=', $stock_min);
        }

        if (!empty($stock_max)) {
            $query->where('stock', '<=', $stock_max);
        }

        $sort_columns = [
            'id',
            'product_name',
            'price',
            'stock',
            'company_id',
        ];

        if (!in_array($sort_column, $sort_columns, true)) {
            $sort_column = 'id';
        }

        if (!in_array($sort_direction, ['asc', 'desc'], true)) {
            $sort_direction = 'desc';
        }

        $query->orderBy($sort_column, $sort_direction);

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
        return self::with('company')->find($id);
    }

    /**
     * 商品更新
     */
    public static function updateProduct(
        $id,
        $product_name,
        $company_id,
        $price,
        $stock,
        $comment,
        $img_path
    ) {
        $product = self::find($id);

        $product->product_name = $product_name;
        $product->company_id = $company_id;
        $product->price = $price;
        $product->stock = $stock;
        $product->comment = $comment;
        $product->img_path = $img_path;

        $product->save();
    }

    /**
     * 商品購入
     */
    public static function buyProduct($product_id)
    {
        $product = self::find($product_id);

        if (empty($product)) {
            return false;
        }

        if ($product->stock <= 0) {
            return false;
        }

        $product->stock = $product->stock - 1;
        $product->save();

        return true;
    }
}