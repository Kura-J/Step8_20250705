{{--
@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
    <h1>商品一覧画面a</h1>

@endsection
--}}

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <title>商品一覧画面</title>
</head>
<body>
    <div class="list">
        <h1 class="list__title">商品一覧画面</h1>

        <form action="#" method="get" class="list__form">
            <input type="text" placeholder="検索キーワード" class="list__input">
            <select name="maker" class="list__select">
                <option value="">メーカー名</option>
            </select>
            <button type="submit" class="list__button--search">検索</button>
        </form>

        <table class="list__table">
            <thead class="list__thead">
                <tr class="list__header">
                    <th class="list__header-cell">ID</th>
                    <th class="list__header-cell">商品画像</th>
                    <th class="list__header-cell">商品名</th>
                    <th class="list__header-cell">価格</th>
                    <th class="list__header-cell">在庫数</th>
                    <th class="list__header-cell">メーカー名</th>
                    <th class="list__header-cell">
                        <p class="list__product--new">新規登録</p>
                    </th>
                </tr>
            </thead>
            <tbody class="list__tbody">
            @foreach ($products as $product)
                <tr class="list__all{{ $loop->odd ? ' list__all--odd' : '' }}">
                    <td class="list__all-cell">{{ $product->id }}</td>
                    <td class="list__all-cell">{{ $product->img_path }}</td>
                    <td class="list__all-cell">{{ $product->product_name }}</td>
                    <td class="list__all-cell">{{ $product->price }}</td>
                    <td class="list__all-cell">{{ $product->stock }}</td>
                    <td class="list__all-cell">{{ $product->company_name }}</td>
                    <td class="list__all-cell list__transition-cell">
                        <p class="list__detail-button">詳細</p>
                        <p class="list__delete-button">削除</p>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="list__pagination">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>
</body>
</html>
