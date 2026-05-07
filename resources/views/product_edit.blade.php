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
                value="{{ old('product_name') }}"
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
        name="company_name"
    >

        <option
            value=""
            selected
            disabled
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
                value="{{ old('product_name') }}"
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
                value="{{ old('product_name') }}"
            >
        </div>

        <div class="product_edit-form-group">
            <label class="product_edit-label">
                コメント
            </label>

            <textarea
                class="product_edit-textarea"
                name="comment"
            >{{ old('comment') }}</textarea>
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

            <button
                class="product_edit-back-button"
                type="button"
                onclick="location.href='{{ route('product.detail', $product->id) }}'"
            >
                戻る
            </button>
        </div>
    </form>
</div>