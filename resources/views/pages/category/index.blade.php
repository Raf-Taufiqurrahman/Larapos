@extends('layouts.apps.app', ['title' => 'Category'])

@section('content')
    <x-container>
        <div class="col-12 col-lg-8">
            <x-card-action title="List Category" :url="route('app.category.index')">
                <x-table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $i => $category)
                            <tr>
                                <td>{{ $i + $categories->firstItem() }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <x-btn-modal title="Edit Data" :id="$category->id" />
                                    <x-modal title="Edit Data" :id="$category->id">
                                        <form action="{{ route('app.category.update', $category->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <x-input type="text" title="Name" name="name" :value="$category->name"
                                                placeholder="Category Name" />
                                            <x-btn-save />
                                        </form>
                                    </x-modal>
                                    <x-btn-delete :id="$category->id" :url="route('app.category.destroy', $category->id)" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table>
            </x-card-action>
            <div class="d-flex justify-content-end">{{ $categories->links() }}</div>
        </div>
        <div class="col-12 col-lg-4">
            <x-card title="Add New Category" class="card-body">
                <form action="{{ route('app.category.store') }}" method="POST">
                    @csrf
                    <x-input type="text" title="Name" name="name" :value="old('name')" placeholder="Category Name" />
                    <x-btn-save />
                </form>
            </x-card>
        </div>
    </x-container>
@endsection
