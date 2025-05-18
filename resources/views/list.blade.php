@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Product List</h1>

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add new product</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product['id'] }}</td>
                <td>{{ $product['name'] }}</td>
                <td>{{ $product['description'] }}</td>
                <td>${{ $product['price'] }}</td>
                <td>
                    <a href="{{ route('products.show', $product['id']) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('products.edit', $product['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
