<link rel="stylesheet" href="{{ asset('css/product_edit.css') }}">

<h1>商品情報編集画面</h1>

<div class="product_edit-area">
    {{-- バリデーションエラー --}}
    @if ($errors->any())
        <div class="product_edit-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('product.update', $product->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        <div class="product_edit-form-group">
            <label class="product_edit-label">
                <span class="product_edit-id-label">
                    ID.
                </span>
            </label>

            <div class="product_edit-id">
                {{ $product->id }}.
            </div>
        </div>

        <div class="product_edit-form-group">
            <label class="product_edit-label">
                商品名
                <span class="product_edit-required">
                    *
                </span>
            </label>

            <input
                class="product_edit-input"
                type="text"
                name="product_name"
                value="{{ old('product_name', $product->product_name) }}"
            >
        </div>

        <div class="product_edit-form-group">
            <label class="product_edit-label">
                メーカー名
                <span class="product_edit-required">
                    *
                </span>
            </label>

            <select
                class="product_edit-select"
                name="company_id"
            >
                <option value="">
                </option>

                @foreach ($companies as $company)
                    <option
                        value="{{ $company->id }}"
                        @if (old('company_id', $product->company_id) == $company->id)
                            selected
                        @endif
                    >
                        {{ $company->company_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="product_edit-form-group">
            <label class="product_edit-label">
                価格
                <span class="product_edit-required">
                    *
                </span>
            </label>

            <input
                class="product_edit-input"
                type="text"
                name="price"
                value="{{ old('price', $product->price) }}"
            >
        </div>

        <div class="product_edit-form-group">
            <label class="product_edit-label">
                在庫数
                <span class="product_edit-required">
                    *
                </span>
            </label>

            <input
                class="product_edit-input"
                type="text"
                name="stock"
                value="{{ old('stock', $product->stock) }}"
            >
        </div>

        <div class="product_edit-form-group">
            <label class="product_edit-label">
                コメント
            </label>

            <textarea
                class="product_edit-textarea"
                name="comment"
            >{{ old('comment', $product->comment) }}</textarea>
        </div>

        <div class="product_edit-form-group">
            <label class="product_edit-label">
                商品画像
            </label>

            <input
                class="product_edit-file"
                type="file"
                name="img_path"
            >
        </div>

        <div class="product_edit-button-area">
            <button
                class="product_edit-submit-button"
                type="submit"
            >
                更新
            </button>

            <a
                class="product_edit-back-button"
                href="{{ route('product.detail', $product->id) }}"
            >
                戻る
            </a>
        </div>
    </form>
</div>