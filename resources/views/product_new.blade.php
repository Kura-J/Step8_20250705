<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <title>商品登録画面</title>
</head>
<body>
    <div class="product-new">
        <h1 class="product-new__title">商品新規登録画面</h1>

        <form action="{{ route('submit') }}" method="post" class="product-new__form" enctype="multipart/form-data">
            @csrf

            <div class="product-new__field">
                <label for="product">商品名</label>
                <input type="text" class="product-new__name" id="product" name="product_name" value="{{ old('product_name') }}">
                @if($errors->has('product_name'))
                    <p>{{ $errors->first('product_name') }}</p>
                @endif
            </div>

            <div class="product-new__field">
                <label for="maker">メーカー名</label>
                <select name="company_id" class="product-new__maker" id="maker">
                    <option value=""></option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                            {{ $company->company_name }}
                        </option>
                    @endforeach
                    @if($errors->has('company_id'))
                        <p>{{ $errors->first('company_id') }}</p>
                    @endif
                </select>
            </div>

            <div class="product-new__field">
                <label for="price">価格</label>
                <input type="text" class="product-new__price" id="price" name="price" value="{{ old('price') }}">
                @if($errors->has('price'))
                    <p>{{ $errors->first('price') }}</p>
                @endif
            </div>

            <div class="product-new__field">
                <label for="stock">在庫数</label>
                <input type="text" class="product-new__stock" id="stock" name="stock" value="{{ old('stock') }}">
                @if($errors->has('stock'))
                    <p>{{ $errors->first('stock') }}</p>
                @endif
            </div>

            <div class="product-new__field">
                <label for="comment">コメント</label>
                <textarea class="product-new__comment" id="comment" name="comment">{{ old('comment') }}</textarea>
            </div>

            <div class="product-new__field">
                <label for="img_path">商品画像</label>
                <input type="file" class="product-new__img-path" id="img_path" name="img_path">
            </div>

            <div class="product-new__buttons">
                <button type="submit" class="product-new__new">新規登録</button>
                <a href="#" class="product-new__back">戻る</a>
            </div>

        </form>
    </div>
</body>
</html>
