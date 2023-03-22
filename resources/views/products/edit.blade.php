@extends('layouts.app')

@section('content')

<h1>Edit Product</h1>

<form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
    @csrf
   
    
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="input_nama" value="{{ $product->name }}" required>
    </div>

    <div class="form-group">
        <label for="category_id">Category</label>
        <select class="form-control" id="category_id" name="input_category">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="input_description" rows="3" required>{{ $product->description }}</textarea>
    </div>

    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" class="form-control" id="price" name="input_harga" value="{{ $product->price }}" required>
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control-file" id="image" name="input_image">

        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" width="150">
    </div>

    <button type="submit" class="btn btn-primary">Update Product</button>
</form>

@endsection
