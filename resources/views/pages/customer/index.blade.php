@extends('layouts.apps.app', ['title' => 'Customer'])

@section('content')
    <x-container>
        <div class="col-12 col-lg-8">
            <x-card-action title="List Customer" :url="route('app.customer.index')">
                <x-table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer Name</th>
                            <th>Customer Telp</th>
                            <th>Customer Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $i => $customer)
                            <tr>
                                <td>{{ $i + $customers->firstItem() }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->no_telp }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>
                                    <x-btn-modal title="Edit Data" :id="$customer->id" />
                                    <x-modal title="Edit Data" :id="$customer->id">
                                        <form action="{{ route('app.customer.update', $customer->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <x-input type="text" title="Name" name="name" :value="$customer->name"
                                                placeholder="Customer Name" />
                                            <x-input type="number" title="Telp" name="no_telp" :value="$customer->no_telp"
                                                placeholder="Customer Telp" />
                                            <x-textarea title="Address" name="address" placeholder="Customer Address">
                                                {{ $customer->address }}</x-textarea>
                                            <x-btn-save />
                                        </form>
                                    </x-modal>
                                    <x-btn-delete :id="$customer->id" :url="route('app.customer.destroy', $customer->id)" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table>
            </x-card-action>
            <div class="d-flex justify-content-end">{{ $customers->links() }}</div>
        </div>
        <div class="col-12 col-lg-4">
            <x-card title="Add New Customer" class="card-body">
                <form action="{{ route('app.customer.store') }}" method="POST">
                    @csrf
                    <x-input type="text" title="Name" name="name" :value="old('name')" placeholder="Customer Name" />
                    <x-input type="number" title="Telp" name="no_telp" :value="old('no_telp')" placeholder="Customer Telp" />
                    <x-textarea title="Address" name="address" placeholder="Customer Address">{{ old('address') }}
                    </x-textarea>
                    <x-btn-save />
                </form>
            </x-card>
        </div>
    </x-container>
@endsection
