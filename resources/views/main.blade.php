@extends('layouts.app')

@section('content')
    <div class="container">
        @if (!empty($actions))
            <section>
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        @foreach ($actions as $action)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div style="background-image: url({{ url('storage', $action->image) }}); background-size:cover; min-height: 90vh"
                                    class="d-flex align-items-center ps-5 pe-5 
                                    @if ($action->position == 'left') justify-content-start
                                    @elseif($action->position == 'center')
                                        justify-content-center
                                    @else
                                        justify-content-end @endif
                                    ">
                                    <p class="fs-5">{{ $action->text }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </section>
        @endif
        <section>
            <h1>Товары</h1>
            <div class="row">
                @forelse ($products as $product)
                    <div class="col-6 col-lg-3">
                        <div class="card">
                            <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none">
                                <img src="{{ url('storage', $product->image) }}" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title text-black">{{ $product->name }}</h5>
                                    <p class="card-title text-black">{{ $product->price }}</p>
                                </div>
                            </a>
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
