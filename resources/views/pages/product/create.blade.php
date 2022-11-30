@extends('layouts.apps.app', ['title' => 'Product Create'])

@section('content')
    <x-container>
        <div class="d-flex justify-content-center">
            <div class="col-10">
                <x-card title="Add New Product" class="card-body">
                    <form action="{{ route('app.product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <x-input type="text" title="Name" name="name" :value="old('name')" placeholder="Product Name" />
                        <div class="row">
                            <div class="col-6">
                                <x-select title="Category" name="category_id">
                                    <option value>Choose Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div class="col-6">
                                <x-input type="number" title="Stock" name="stock" :value="old('stock')"
                                    placeholder="Product Stock" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <x-input type="number" title="Buy Price" name="buy_price" :value="old('buy_price')"
                                    placeholder="Product Buy Price" />
                            </div>
                            <div class="col-6">
                                <x-input type="number" title="Sell Price" name="sell_price" :value="old('sell_price')"
                                    placeholder="Product Sell Price" />
                            </div>
                        </div>
                        <x-input type="file" title="Image" name="image" :value="old('image')"
                            placeholder="Product Image" />
                        <x-textarea title="Description" name="description" placeholder="Product Description">
                            {{ old('descriptionart') }}</x-textarea>
                        <x-btn-save />
                        <x-btn-back :url="route('app.product.index')" />
                    </form>
                </x-card>
            </div>
        </div>
    </x-container>
@endsection
