@extends('layouts.app')

@section('hide_header')
@endsection

@section('title', '商品一覧画面')
@section('content')
    <div class="product-list">
        @if (session('message'))
            <div class="product-list__delete--alert product-list__delete--alert-success">
                {{ session('message') }}
            </div>
        @endif

        <h1 class="product-list__title">商品一覧画面</h1>

        <form action="{{ route('home') }}" method="get" class="product-list__form">
            <input type="text" placeholder="検索キーワード" class="product-list__input" name="keyword" value="{{ request('keyword') }}">
            <select name="maker" class="product-list__maker-select">
                <option value="">メーカー名</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{request('maker') == $company->id ? 'selected' : '' }}>
                        {{ $company->company_name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="product-list__search-button">検索</button>
        </form>

        <table class="product-list__table">
            <thead class="product-list__thead">
                <tr class="product-list__header">
                    <th class="product-list__header--cell">ID</th>
                    <th class="product-list__header--cell">商品画像</th>
                    <th class="product-list__header--cell">商品名</th>
                    <th class="product-list__header--cell">価格</th>
                    <th class="product-list__header--cell">在庫数</th>
                    <th class="product-list__header--cell">メーカー名</th>
                    <th class="product-list__header--cell">
                        <div class="product-list__product-new">
                            <a href="{{ route('product_new') }}" class="product-list__product-new--button">新規登録</a>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody class="product-list__tbody">
            @foreach ($products as $product)
                <tr class="product-list__product-all{{ $loop->odd ? ' product-list__product-all--odd' : '' }}">
                    <td class="product-list__product-all--cell">{{ $product->id }}</td>
                    <td class="product-list__product-all--cell">
                        @if (! empty($product->img_path))
                            <img src="{{ asset($product->img_path) }}" alt="商品画像" class="product-list__image">
                        @else
                            
                        @endif
                    </td>
                    <td class="product-list__product-all--cell">{{ $product->product_name }}</td>
                    <td class="product-list__product-all--cell">{{ $product->price }}</td>
                    <td class="product-list__product-all--cell">{{ $product->stock }}</td>
                    <td class="product-list__product-all--cell">{{ $product->company_name }}</td>
                    <td class="product-list__product-all--cell product-list__transition-buttons">
                        <a href="{{ route('product_detail', ['id' => $product->id]) }}" class="product-list__detail-button">詳細</a>
                        <form action="{{ route('product_delete', ['id' => $product->id]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="product-list__delete-button" onclick="return confirm('本当に削除しますか？')">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="product-list__pagination">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
