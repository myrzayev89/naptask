@extends('layouts.app')
@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">
        @foreach($products as $product)
            <div class="col-4 mb-3">
                <div class="card" style="width: 18rem;">
                    <img src="https://picsum.photos/seed/picsum/286/186" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($product->desc, 60) }}</p>
                        <div class="float-start">
                            <a href="{{ route('add', $product->id) }}" class="btn btn-outline-success">Add to cart</a>
                        </div>
                        <div class="float-end">
                            <span class="badge bg-primary">{{ $product->price }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div style="display:flex;justify-content:center">
            {{ $products->links() }}
        </div>
    </div>
@endsection
