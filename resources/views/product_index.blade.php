<link rel="stylesheet" href="{{ asset('css/product_index.css') }}">

<h1>商品一覧画面</h1>

{{-- 検索フォーム --}}
<form
    class="product_index-search-form"
    method="GET"
    action="{{ route('product.index') }}"
>
    <div class="product_index-search-row">
        <div class="product_index-search-item">
            <input
                class="product_index-search-input"
                type="text"
                name="product_name"
                value="{{ $product_name ?? '' }}"
                placeholder="検索キーワード"
            >
        </div>

        <select
            class="product_index-search-select"
            name="company_id"
        >
            <option
               value=""
               selected
               hidden
            >
            メーカー名
        </option>

            @foreach ($companies as $company)
                <option
                    value="{{ $company->id }}"
                    @if (($company_id ?? '') == $company->id) selected @endif
                >
                    {{ $company->company_name }}
                </option>
            @endforeach
        </select>

        <button
            class="product_index-search-button"
            type="submit"
        >
            検索
        </button>
    </div>
</form>

{{-- 一覧テーブル --}}
<table class="product_index-table">
    <tr>
        <th><span class="product_index-id">ID</span></th>
        <th>商品画像</th>
        <th>商品名</th>
        <th>価格</th>
        <th>在庫数</th>
        <th>メーカー名</th>

        <th
            colspan="2"
            class="product_index-create-area"
        >
            <form
                class="product_index-create-form"
                action="{{ route('product.create') }}"
                method="GET"
            >
                <button
                    class="product_index-create-button"
                    type="submit"
                >
                    新規登録
                </button>
            </form>
        </th>
    </tr>

    @foreach ($products as $product)
        <tr>
            <td>
                {{ $product->id }}.
            </td>

            <td>
                @if ($product->img_path)
                    <img
                        class="product_index-image"
                        src="{{ asset('storage/' . $product->img_path) }}"
                        alt="商品画像"
                    >
                @else
                    商品画像
                @endif
            </td>

            <td>
                {{ $product->product_name }}
            </td>

            <td>
                ¥{{ $product->price }}
            </td>

            <td>
                {{ $product->stock }}
            </td>

            <td>
                {{ $product->company->company_name }}
            </td>

            <td class="product_index-action-cell">
                <form
                    class="product_index-detail-form"
                    action="{{ route('product.detail', $product->id) }}"
                    method="GET"
                >
                    <button
                        class="product_index-detail-button"
                        type="submit"
                    >
                        詳細
                    </button>
                </form>
            </td>

            <td class="product_index-action-cell">
                <form
                    class="product_index-delete-form"
                    action="{{ route('product.delete', $product->id) }}"
                    method="POST"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        class="product_index-delete-button"
                        type="submit"
                    >
                        削除
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

<script src="{{ asset('js/product_index.js') }}"></script>