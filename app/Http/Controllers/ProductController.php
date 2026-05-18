<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Exception;

class ProductController extends Controller
{
    /**
     * 商品一覧画面
     */
    public function index(Request $request)
{
    $product_name = $request->input('product_name');
    $company_id = $request->input('company_id');
    $price_min = $request->input('price_min');
    $price_max = $request->input('price_max');
    $stock_min = $request->input('stock_min');
    $stock_max = $request->input('stock_max');
    $sort_column = $request->input('sort_column', 'id');
    $sort_direction = $request->input('sort_direction', 'asc');

    $products = Product::searchProducts(
        $product_name,
        $company_id,
        $price_min,
        $price_max,
        $stock_min,
        $stock_max,
        $sort_column,
        $sort_direction
    );

    if ($request->ajax()) {
        return response()->json([
            'products' => $products,
        ]);
    }

    $companies = Company::getCompanyList();

    return view('product_index', [
        'products' => $products,
        'product_name' => $product_name,
        'company_id' => $company_id,
        'price_min' => $price_min,
        'price_max' => $price_max,
        'stock_min' => $stock_min,
        'stock_max' => $stock_max,
        'companies' => $companies,
        'sort_column' => $sort_column,
        'sort_direction' => $sort_direction,
    ]);
}

    /**
     * 商品登録画面
     */
    public function create()
    {
        $companies = Company::getCompanyList();

        return view('product_create', [
            'companies' => $companies,
        ]);
    }

    /**
     * 商品登録処理
     */
    public function store(ProductStoreRequest $request)
    {
        try {
            $img_path = null;

            if ($request->hasFile('img_path')) {
                $img_path = $request->file('img_path')
                                    ->store('images', 'public');
            }

            Product::createProduct(
                $request->input('product_name'),
                $request->input('company_id'),
                $request->input('price'),
                $request->input('stock'),
                $request->input('comment'),
                $img_path
            );

            return redirect()->route('product.create');
        } catch (Exception $e) {
            return redirect()
                ->route('product.create')
                ->withInput()
                ->with('error', '商品の登録に失敗しました。');
        }
    }

    /**
     * 商品削除
     */
    public function destroy(Request $request, $id)
{
    try {
        Product::deleteProduct($id);

        if ($request->ajax()) {
            return response()->json([
                'result' => true,
            ]);
        }

        return redirect()->route('product.index');
    } catch (Exception $e) {
        if ($request->ajax()) {
            return response()->json([
                'result' => false,
            ]);
        }

        return redirect()
            ->route('product.index')
            ->with('error', '商品の削除に失敗しました。');
    }
}

    /**
     * 商品詳細画面
     */
    public function show($id)
    {
        $product = Product::getProductDetail($id);

        return view('product_detail', [
            'product' => $product,
        ]);
    }

    /**
     * 商品編集画面
     */
    public function edit($id)
    {
        try {
            $product = Product::getProductDetail($id);
            $companies = Company::getCompanyList();

            return view('product_edit', [
                'product' => $product,
                'companies' => $companies,
            ]);
        } catch (Exception $e) {
            return redirect()
                ->route('product.index')
                ->with('error', '商品情報の取得に失敗しました。');
        }
    }

    /**
     * 商品更新処理
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        try {
            $product = Product::getProductDetail($id);
            $img_path = $product->img_path;

            if ($request->hasFile('img_path')) {
                $img_path = $request->file('img_path')
                                    ->store('images', 'public');
            }

            Product::updateProduct(
                $id,
                $request->input('product_name'),
                $request->input('company_id'),
                $request->input('price'),
                $request->input('stock'),
                $request->input('comment'),
                $img_path
            );

            return redirect()->route('product.edit', $id);
        } catch (Exception $e) {
            return redirect()
                ->route('product.edit', $id)
                ->withInput()
                ->with('error', '商品の更新に失敗しました。');
        }
    }
}