<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;

class ProductController extends Controller
{
    /**
     * 商品一覧画面
     */
    public function index(Request $request)
    {
        $product_name = $request->input('product_name');
        $company_id = $request->input('company_id');

        $products = Product::searchProducts(
            $product_name,
            $company_id
        );

        $companies = Company::all();

        return view('product_index', [
            'products' => $products,
            'product_name' => $product_name,
            'company_id' => $company_id,
            'companies' => $companies,
        ]);
    }

    /**
     * 商品登録画面
     */
    public function create()
    {
        $companies = Company::all();

        return view('product_create', [
            'companies' => $companies,
        ]);
    }

    /**
     * 商品登録処理
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'product_name' => 'required',
                'company_id' => 'required',
                'price' => 'required',
                'stock' => 'required',
                'img_path' => 'nullable|image',
            ],
            [
                'product_name.required' => '商品名は必須です。',
                'company_id.required' => 'メーカー名は必須です。',
                'price.required' => '価格は必須です。',
                'stock.required' => '在庫数は必須です。',
            ]
        );

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
    }

    /**
     * 商品削除
     */
    public function destroy($id)
    {
        Product::deleteProduct($id);

        return redirect()->route('product.index');
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
        $product = Product::getProductDetail($id);
        $companies = Company::all();

        return view('product_edit', [
            'product' => $product,
            'companies' => $companies,
        ]);
    }

    /**
     * 商品更新処理
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'product_name' => 'required',
                'company_id' => 'required',
                'price' => 'required',
                'stock' => 'required',
                'img_path' => 'nullable|image',
            ],
            [
                'product_name.required' => '商品名は必須です。',
                'company_id.required' => 'メーカー名は必須です。',
                'price.required' => '価格は必須です。',
                'stock.required' => '在庫数は必須です。',
            ]
        );

        $product = Product::getProductDetail($id);
        $img_path = $product->img_path;

        if ($request->hasFile('img_path')) {
            $img_path = $request->file('img_path')
                                ->store('images', 'public');
        }

        Product::updateProduct(
            $request,
            $id,
            $img_path
        );

        return redirect()->route(
            'product.detail',
            $id
        );
    }
}