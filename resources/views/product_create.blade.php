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
        name="company_name"
    >

        <option
            value=""
            disabled
            selected
            hidden
        >
        </option>

        <option
            value="コカ・コーラ"
            @if (old('company_name') === 'コカ・コーラ')
                selected
            @endif
        >
            コカ・コーラ
        </option>

        <option
            value="伊藤園"
            @if (old('company_name') === '伊藤園')
                selected
            @endif
        >
            伊藤園
        </option>

        <option
            value="サントリー"
            @if (old('company_name') === 'サントリー')
                selected
            @endif
        >
            サントリー
        </option>

        <option
            value="キリン"
            @if (old('company_name') === 'キリン')
                selected
            @endif
        >
            キリン
        </option>

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

    <br></br>

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