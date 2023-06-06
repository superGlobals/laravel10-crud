@extends('layouts.main')
@section('content')
    
    <div class="col-md-10 mx-auto mt-5">
        <div class="card shadow border-0">
            <div class="card-header">
                <div class="mb-3">
                    <form action="{{ route('products.index') }}" method="GET" accept-charset="UTF-8" role="search">
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Search" >
                    </form>
                </div>
                <a href="{{ route('products.create') }}" class="btn btn-primary float-end">New Product</a>
                <h3>Product List</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Inventory</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td><img src="{{ asset('images/'. $product->image) }}" width="50" alt=""></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td class="d-flex ">
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-success mx-2">Edit</a>
                                    <form action="{{ route('products.delete', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="deleteConfirm(event)" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <td><h1>NO PRODUCT</h1></td>
                        @endforelse
                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <script>
        window.deleteConfirm = function(e) {
            e.preventDefault();
            var form = e.target.form;
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
            })
        }
    </script>
@endsection