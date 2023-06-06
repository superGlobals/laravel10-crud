@extends('layouts.main')
@section('content')
    
    <div class="col-md-8 mx-auto mt-5">
        <div class="card shadow border-0">
            <div class="card-header">
                <a href="{{ route('products.index') }}" class="btn btn-primary float-end">Back</a>
                <h3>Add Product</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Name</label>
                      <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
                      @error('name')
                          <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Description</label>
                      <textarea name="description" id="" class="form-control"></textarea>
                      @error('description')
                          <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Image</label>
                        <img src="" id="file-preview" width="50" alt="">
                        <input type="file" name="image" accept="image/*" onchange="showFile(event)" class="form-control" id="exampleInputPassword1">
                        @error('image')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Category</label>
                        <select name="category" id="" class="form-select">
                            @foreach (json_decode('{"Smartphone":"Smartphone","Smart TV":"Smart TV","Computer":"Computer"}', true) as $optionKey => $optionValue)
                                <option value="{{ $optionKey }}">{{ $optionValue }}</option>
                            @endforeach
                        </select>
                        @error('category')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Inventory</label>
                        <input type="number" name="quantity" class="form-control" id="exampleInputPassword1">
                        @error('inventory')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" id="exampleInputPassword1">
                        @error('price')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                  </form>
            </div>
        </div>
    </div>

    <script>
        function showFile(event) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function() {
                var dataURL = reader.result;
                var output = document.getElementById('file-preview');
                output.src = dataURL;
            }

            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection