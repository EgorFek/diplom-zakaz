@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 60vh">
            <div class="col-12 col-lg-4">
                <img src="{{ url('storage', $product->image) }}" alt="{{ $product->name }}" class="w-100">
            </div>
            <div class="col-12 col-lg-4">
                <h1 class="fw-bold mb-4">{{ $product->name }}</h1>
                <p>{{ $product->description }}</p>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card p-2">
                    <div class="card-body">
                        <div class="text-red fs-4 fw-bold mb-3">
                            {{ $product->discount ? $product->discount : $product->price }} руб.
                        </div>
                        <div class="mb-3">
                            <div class="d-flex ">
                                <form action="{{ route('cart.add', $product->id) }}" method="post">
                                    @csrf
                                    <div class="d-flex gap-3">
                                        <div class="d-flex rounded-c" style="border: 1px solid gray;">
                                            <button type="button" onclick="handleDecreaseClicked()"
                                                class="btn rounded-c">-</button>
                                            <input type="number" min="1" name="count" id="count" required
                                                onchange="handleChange()" class="text-center border-none"
                                                style="width: 40px; appearance: textfield;">
                                            <button type="button" onclick="handleIncreaseClicked()"
                                                class="btn rounded-c">+</button>
                                        </div>
                                        <button type="submit" class="btn btn-red rounded-c">В корзину</button>
                                    </div>
                                </form>
                                <form action="{{ route('favourite.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn">
                                        <img src="/icons/hart.svg" alt="Лайк" width="30" height="30">
                                    </button>
                                </form>
                            </div>
                        </div>
                        Добавить в Список желаний
                    </div>
                </div>
            </div>
        </div>
        <h3>Отзывы</h3>
        <div class="p-4 bg-gray rounded-c mb-3">
            <form action="{{ route('feedbacks.store', $product->id) }}" method="POST">
                @csrf
                <textarea name="text" id="feedback" cols="30" rows="10" class="form-control rounded-c p-3 mb-3"></textarea>
                <button type="submit" class="btn btn-red rounded-c ms-auto">Оставить отзыв</button>
            </form>
        </div>
        <?$feedbacks = $product->feedbacks()->orderByDesc('created_at')->get()->all()?>
        <div class="bg-gray p-4 rounded-c">
            @forelse ($feedbacks as $feedback)
                <div class="bg-white p-2 ps-4 pe-4 rounded-c mb-3">
                    <p class="fs-5 text-red border-bottom">{{ $feedback->user()->first()->nick }}</p>
                    <p>{{ $feedback->text }}</p>
                </div>
            @empty
                <div class="alert alert-warning rounded-c">Отзывов на товар еще нет</div>
            @endforelse
        </div>
    </div>
    <script>
        let productCount = 1;

        const count = document.querySelector('#count');

        count.value = productCount

        const handleIncreaseClicked = () => {
            productCount++;
            count.value = productCount
        }

        const handleDecreaseClicked = () => {
            if (productCount - 1 > 0) {
                productCount--;
            }
            count.value = productCount
        }

        const handleChange = () => {
            productCount = parseInt(count.value) ? parseInt(count.value) : productCount
        }
    </script>
@endsection
