@extends('layouts.apps.app', ['title' => 'Product'])

@section('content')
    <x-container>
        <div class="col-12">
            <form action="{{ route('app.product.selected') }}" method="POST">
                @csrf
                <x-btn-create title="Add New Product" :url="route('app.product.create')" />
                <x-btn-modal-small />
                <x-modal-small />
                <x-card-action title="List Product" :url="route('app.product.index')">
                    <x-table>
                        <thead>
                            <tr>
                                <th class="w-1">
                                    <input class="form-check-input m-0 align-middle" type="checkbox" onclick="toggle(this)"
                                        id="checkall">
                                </th>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Product Sell Price</th>
                                <th>Product Buy Price</th>
                                <th>Product Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $i => $product)
                                <tr>
                                    <td>
                                        <input class="form-check-input m-0 align-middle" type="checkbox" name="id[]"
                                            id="checkItem" value="{{ $product->id }}" />
                                    </td>
                                    <td>{{ $i + $products->firstItem() }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        <sup>Rp</sup>
                                        {{ moneyFormat($product->sell_price) }}
                                    </td>
                                    <td>
                                        <sup>Rp</sup>
                                        {{ moneyFormat($product->buy_price) }}
                                    </td>
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                        <x-btn-edit :url="route('app.product.edit', $product->id)" />
                                        <x-btn-delete :id="$product->id" :url="route('app.product.destroy', $product->id)" />
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table>
                </x-card-action>
            </form>
            <div class="d-flex justify-content-end">{{ $products->links() }}</div>
        </div>
    </x-container>
@endsection

@push('js')
    <script>
        function toggle(source) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
    </script>
@endpush
