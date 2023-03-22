@extends('layouts.app')

@section('content')
    <h1>All Carts</h1>

    @if ($carts->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalPrice = 0;
                    @endphp
                    @foreach ($carts as $cart)
                        <tr>
                            <td><img src="{{ asset('images/' . $cart->product->image) }}" class="img-thumbnail" alt="{{ $cart->product->name }}" style="width: 100px;"></td>
                            <td>{{ $cart->product->name }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>Rp. {{ $cart->product->price }}</td>
                            @php
                                $subtotal = $cart->product->price * $cart->quantity;
                                $totalPrice += $subtotal;
                            @endphp
                            <td>Rp. {{ $subtotal }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $cart->id) }}" method="POST"  onsubmit="return confirm('Are you sure you want to remove this product from the cart?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Remove from cart</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <h4>Total Price: Rp.{{ $totalPrice }}</h4>
            <a href="#" class="btn btn-success">Checkout</a>
        </div>
    @else
        <p>No carts found.</p>
    @endif
@endsection
