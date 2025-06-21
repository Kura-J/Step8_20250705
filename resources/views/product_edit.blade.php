<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <title>商品情報編集画面</title>
</head>
<body>
    <div class="product-edit">
        <h1 class="product-edit__title">商品情報編集画面</h1>

        <form action="{{ route('product_update', ['id' => $product->id]) }}" method="post" class="product-edit__form" enctype="multipart/form-data">
            @csrf

            <div class="product-edit__field">
                <label for="id">ID</label>
                <p class="product-edit__id">{{ $product->id }}</p>
            </div>

            <div class="product-edit__field">
                <label for="product">商品名</label>
                <input type="text" class="product-edit__name" id="product" name="product_name" value="{{ old('product_name', $product->product_name) }}">
                @if($errors->has('product_name'))
                    <p>{{ $errors->first('product_name') }}</p>
                @endif
            </div>

            <div class="product-edit__field">
                <label for="maker">メーカー名</label>
                <select name="company_id" class="product-edit__maker" id="maker">
                    <option value=""></option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ old('company_id', $product->company_id) == $company->id ? 'selected' : '' }}>
                            {{ $company->company_name }}
                        </option>
                    @endforeach
                    @if($errors->has('company_id'))
                        <p>{{ $errors->first('company_id') }}</p>
                    @endif
                </select>
            </div>

            <div class="product-edit__field">
                <label for="price">価格</label>
                <input type="text" class="product-edit__price" id="price" name="price" value="{{ old('price', $product->price) }}">
                @if($errors->has('price'))
                    <p>{{ $errors->first('price') }}</p>
                @endif
            </div>

            <div class="product-edit__field">
                <label for="stock">在庫数</label>
                <input type="text" class="product-edit__stock" id="stock" name="stock" value="{{ old('stock', $product->stock) }}">
                @if($errors->has('stock'))
                    <p>{{ $errors->first('stock') }}</p>
                @endif
            </div>

            <div class="product-edit__field">
                <label for="comment">コメント</label>
                <textarea class="product-edit__comment" id="comment" name="comment">{{ old('comment', $product->comment) }}</textarea>
            </div>

            <div class="product-edit__field">
                <label for="img_path">商品画像</label>
                <input type="file" class="product-edit__img-path" id="img_path" name="img_path">
            </div>
            <input type="hidden" name="existing_img_path" value="{{ $product->img_path }}">

            <div class="product-edit__buttons">
                <button type="submit" class="product-edit__edit">更新</button>
                <a href="{{ route('product_detail', ['id' => $product->id]) }}" class="product-edit__back">戻る</a>
            </div>

        </form>
    </div>
</body>
</html>
