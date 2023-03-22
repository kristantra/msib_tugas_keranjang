@extends('layouts.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<h1>halaman toko </h1>

@endsection