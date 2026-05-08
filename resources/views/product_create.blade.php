<link rel="stylesheet" href="{{ asset('css/product_create.css') }}">

<h1>商品新規登録画面</h1>

{{-- エラー表示 --}}
@if ($errors->any())
    <div class="product_create-error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
@endif

{{-- 登録フォーム --}}
<div class="product_create-form-area">
    <form
        action="{{ route('product.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        <div class="product_create-form-group">
            <label class="product_create-label">
                商品名
                <span class="product_create-required">
                    *
                </span>
            </label>

            <input
                class="product_create-input"
                type="text"
                name="product_name"
                value="{{ old('product_name') }}"
            >
        </div>

        <div class="product_create-form-group">
            <label class="product_create-label">
                メーカー名
                <span class="product_create-required">
                    *
                </span>
            </label>

            <select
                class="product_create-select"
                name="company_id"
            >
                <option value="">
                </option>

                @foreach ($companies as $company)
                    <option
                        value="{{ $company->id }}"
                        @if (old('company_id') == $company->id)
                            selected
                        @endif
                    >
                        {{ $company->company_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="product_create-form-group">
            <label class="product_create-label">
                価格
                <span class="product_create-required">
                    *
                </span>
            </label>

            <input
                class="product_create-input"
                type="text"
                name="price"
                value="{{ old('price') }}"
            >
        </div>

        <div class="product_create-form-group">
            <label class="product_create-label">
                在庫数
                <span class="product_create-required">
                    *
                </span>
            </label>

            <input
                class="product_create-input"
                type="text"
                name="stock"
                value="{{ old('stock') }}"
            >
        </div>

        <div class="product_create-form-group">
            <label class="product_create-label">
                コメント
            </label>

            <textarea
                class="product_create-textarea"
                name="comment"
            >{{ old('comment') }}</textarea>
        </div>

        <div class="product_create-form-group">
            <label class="product_create-label">
                商品画像
            </label>

            <input
                class="product_create-file"
                type="file"
                name="img_path"
            >
        </div>

        <br>

        <div class="product_create-button-area">
            <button
                class="product_create-submit-button"
                type="submit"
            >
                新規登録
            </button>

            <a
                class="product_create-back-link"
                href="{{ route('product.index') }}"
            >
                戻る
            </a>
        </div>
    </form>
</div>