@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Categories</div>
                <div class="card-body">
                    <form action="{{ url('categories') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="input_nama" class="form-label">Name</label>
                            <input type="text" class="form-control" id="input_nama" name="input_nama">
                        </div>
                        <div class="mb-3">
                            <label for="input_description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="input_description" name="input_description">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
