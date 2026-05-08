<link rel="stylesheet" href="{{ asset('css/product_detail.css') }}">

<h1>商品情報詳細画面</h1>

<div class="product_detail-area">
    <div class="product_detail-item">
        <label class="product_detail-label">
            <span class="product_detail-id-label">
                ID
            </span>
        </label>

        <div class="product_detail-value">
            {{ $product->id }}.
        </div>
    </div>

    <div class="product_detail-item">
        <label class="product_detail-label">
            商品画像
        </label>

        <div class="product_detail-value">
            @if (!empty($product->img_path))
                <img
                    class="product_detail-image"
                    src="{{ asset('storage/' . $product->img_path) }}"
                    alt="商品画像"
                >
            @else
                <div class="product_detail-box">
                    画像は登録されていません
                </div>
            @endif
        </div>
    </div>

    <div class="product_detail-item">
        <label class="product_detail-label">
            商品名
        </label>

        <div class="product_detail-value">
            {{ $product->product_name }}
        </div>
    </div>

    <div class="product_detail-item">
        <label class="product_detail-label">
            メーカー
        </label>

        <div class="product_detail-value">
            {{ $product->company->company_name }}
        </div>
    </div>

    <div class="product_detail-item">
        <label class="product_detail-label">
            価格
        </label>

        <div class="product_detail-value">
            ¥{{ $product->price }}
        </div>
    </div>

    <div class="product_detail-item">
        <label class="product_detail-label">
            在庫数
        </label>

        <div class="product_detail-value">
            {{ $product->stock }}
        </div>
    </div>

    <div class="product_detail-item">
        <label class="product_detail-label">
            コメント
        </label>

        <div class="product_detail-value">
            <div class="product_detail-box">
                {{ $product->comment }}
            </div>
        </div>
    </div>

    <div class="product_detail-button-area">
        <a
            class="product_detail-edit-link"
            href="{{ route('product.edit', $product->id) }}"
        >
            編集
        </a>

        <a
            class="product_detail-back-link"
            href="{{ route('product.index') }}"
        >
            戻る
        </a>
    </div>
</div>