@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Product</div>
                <div class="card-body">
                    <form action="{{ url('products') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="input_nama" class="form-label">Name</label>
                            <input type="text" class="form-control" id="input_nama" name="input_nama">
                        </div>
                        <div class="mb-3">
                            <label for="input_description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="input_description" name="input_description">
                        </div>
                        <div class="mb-3">
                            <label for="input_harga" class="form-label">Price</label>
                            <input type="number" class="form-control" id="input_harga" name="input_harga">
                        </div>
                        <div class="mb-3">
                            <label for="input_category" class="form-label">Category</label>
                            <select class="form-select" id="input_category" name="input_category">
                                <option value="" disabled selected>Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="input_image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="input_image" name="input_image">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
