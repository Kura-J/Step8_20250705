<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <title>商品詳細画面</title>
</head>
<body>
    <h1 class="product-detail__title">商品情報詳細画面</h1>
    <div class="product-detail">
        
        <table class="product-detail__table">
            <tr class="product-detail__tr">
                <th class="product-detail__th">ID</th>
                <td class="product-detail__td">{{ $product->id }}</td>
            </tr>
            <tr class="product-detail__tr">
                <th class="product-detail__th">商品画像</th>
                <td class="product-detail__td"><img src="{{ asset($product->img_path) }}" alt="商品画像" width="100"></td>
            </tr>
            <tr class="product-detail__tr">
                <th class="product-detail__th">商品名</th>
                <td class="product-detail__td">{{ $product->product_name }}</td>
            </tr>
            <tr class="product-detail__tr">
                <th class="product-detail__th">メーカー</th>
                <td class="product-detail__td">{{ $product->company_name }}</td>
            </tr>
            <tr class="product-detail__tr">
                <th class="product-detail__th">価格</th>
                <td class="product-detail__td">{{ $product->price }}</td>
            </tr>
            <tr class="product-detail__tr">
                <th class="product-detail__th">在庫数</th>
                <td class="product-detail__td">{{ $product->stock }}</td>
            </tr>
            <tr class="product-detail__tr product-detail__tr-comment">
                <td colspan="2">
                    <div class="product-detail__comment">
                        <div class="product-detail__comment-label">コメント</div>
                        <div class="product-detail__comment-box">{{ $product->comment }}</div>
                    </div>
                </td>
            </tr>
        </table>
        <div class="product-detail__buttons">
            <p class="product-detail__edit">編集</p>
            <p class="product-detail__back">戻る</p>
        </div>
    </div>
</body>
</html>
