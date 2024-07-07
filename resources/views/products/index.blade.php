@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mb-3">Товары</h1>
        <div class="mb-4">
            <a href="{{ route('products.create') }}" class="btn btn-red rounded-c">Создать новый товар</a>
        </div>
        <div class="row">
            @forelse ($products as $product)
                <div class="col-6 col-lg-4">
                    <div class="card">
                        <img src="{{ url('storage', $product->image) }}" class="card-img-top">
                        <div class="card-body">
                            <p class="card-title">{{ $product->name }}</p>
                            <p class="card-title">{{ $product->price }}</p>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-red rounded-c m-0">
                                    Изменить
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-red rounded-c">Удалить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning">Товары не были добавлены</div>
            @endforelse
        </div>
    </div>
@endsection
