@extends('layouts.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="row">
    @foreach ($products as $product)
        <div class="col-md-4 mb-3">
            <div class="card h-100" style="width: 18rem;">
                <img src="{{asset('images/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit:cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <h6>Category: {{ $product->category->name}}</h6>
                    <p class="card-text">{{ $product->description }}</p>
                        <p class="mt-auto"><strong>Price: Rp. {{ $product->price }}</strong></p>
                    {{-- Create form to add to cart --}}
                    <form action="{{ route('cart.add') }}" method="post">
                        @csrf
                        <input type="hidden" name="input_productid" value="{{ $product->id }}">
                        <div class="input-group mb-3">
                            <input type="number" name="input_quantity" class="form-control" value="1" min="1">
                        </div>
                        <button type="submit" class="btn btn-primary">Add to cart</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
    
@endsection
