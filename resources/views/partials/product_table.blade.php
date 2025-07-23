@foreach ($products as $product)
    <tr class="product-list__product-all">
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
            <form class="product-list__delete-form" data-id="{{ $product->id }}" data-url="{{ route('product_delete', ['id' => $product->id]) }}">
                @csrf
                @method('delete')
                <button type="button" class="product-list__delete-button">削除</button>
            </form>
        </td>
    </tr>
@endforeach
