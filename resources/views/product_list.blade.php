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

        <form action="{{ route('home') }}" method="get" class="product-list__form" id="searchForm">
            <input type="text" placeholder="検索キーワード" class="product-list__input" id="searchKeyword" name="keyword" value="{{ request('keyword') }}">
            <select name="maker" class="product-list__maker-select" id="searchMaker">
                <option value="">メーカー名</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{request('maker') == $company->id ? 'selected' : '' }}>
                        {{ $company->company_name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="product-list__search-button" id="searchButton" data-url="{{ route('ajax.home' )}}">検索</button>
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
            <tbody class="product-list__tbody" id="productTable">
                @include('partials.product_table', ['products' => $products])
            </tbody>
        </table>
        <div class="product-list__pagination">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>
@section('scripts')
    <script src="{{ asset('js/product.js') }}"></script>
@endsection

@endsection
