@extends('layouts.app')

@section('content')
    <div class="container">
        <section>
            <h1>Понравившиеся товары</h1>
            <div class="row">
                @forelse ($products as $product)
                    <div class="col-6 col-lg-3">
                        <div class="card p-2">
                            <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none">
                                <img src="{{ url('storage', $product->image) }}" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title text-black">{{ $product->name }}</h5>
                                    <p class="card-title text-black">{{ $product->price }}</p>
                                </div>
                            </a>
                            <div class="mx-auto">
                                <form action="{{ route('favourite.remove', $product->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-red rounded-c" type="submit">Убрать из
                                        понравившихся</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-warning">Товары не были добавлены</div>
                @endforelse
                {{ $products->withQueryString()->links() }}
            </div>
        </section>
    </div>
@endsection
