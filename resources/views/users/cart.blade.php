@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                <?$products = $cart->products()->get()->all();?>
                @if (!empty($products))
                    <form action="{{ route('cart.clear') }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-red">Очистить</button>
                    </form>
                @endif
                @foreach ($products as $product)
                    <div class="row mb-4">
                        <div class="col-12 col-lg-3">
                            <img src="{{ url('storage', $product->image) }}" alt="product" class="mt-3 w-100">
                        </div>
                        <div class="col-12 col-lg-9 d-grid align-items-center">
                            <div class="col-12 d-flex justify-content-end">
                                <form action="{{ route('cart.remove', $product->id) }}" method="POST"
                                    class="d-flex justify-content-end">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn">X</button>
                                </form>
                            </div>
                            <div class="row gap-3 align-items-center">
                                <div class="col-12 d-flex justify-content-between align-items-center border-bottom">
                                    <div class="fw-semibold">Товар</div>
                                    <span class="fw-semibold fs-4">{{ $product->name }}</span>
                                </div>
                                <div class="col-12 d-flex justify-content-between align-items-center border-bottom">
                                    <?$price = $product->discount ? $product->discount : $product->price?>
                                    <div class="fw-semibold">Цена</div>
                                    {{ $price }} руб.
                                </div>
                                <div class="col-12 d-flex justify-content-between align-items-center border-bottom">
                                    <div class="fw-semibold">Количество</div>
                                    <div class="d-flex justify-content-center gap-3">
                                        <div class="d-flex rounded-c" style="border: 1px solid gray;">
                                            <form action="{{ route('cart.decrease', $product->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn rounded-c">-</button>
                                            </form>
                                            <input type="number" min="1" name="count" id="count" required
                                                class="text-center border-none" style="width: 40px; appearance: textfield;"
                                                value="{{ $product->pivot->count }}">
                                            <form action="{{ route('cart.increase', $product->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn rounded-c">+</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between align-items-center border-bottom">
                                    <div class="fw-semibold">Подтытог</div>

                                    <span class="text-red fw-semibold ">{{ $product->pivot->count * $price }} руб.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-12 col-lg-4 ">
                <div class="bg-gray rounded-c p-4">
                    <form action="{{ route('orders.create') }}" method="get">
                        <h5 class="fs-4 fw-semibold mb-3">Итого</h5>
                        <div
                            class="d-flex justify-content-between align-items-center border-bottom border-top mb-3 pt-3 pb-3">
                            <div class="fs-5 fw-semibold">Доставка</div>
                            <div class="d-flex flex-column align-items-end">
                                <div>
                                    <label for="delivery_m">Самовывоз (Москва)</label>
                                    <input type="radio" name="delivery" id="delivery_m" value="1" checked>
                                </div>
                                <div>
                                    <label for="delivery_i">Самовывоз (Истра)</label>
                                    <input type="radio" name="delivery" id="delivery_i" value="2">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="fs-5 fw-semibold">Итого</div>
                            <div class="text-red fs-5 font-semibold">{{ $totalPrice }} руб.</div>
                        </div>
                        <div>
                            <button class="btn btn-red rounded-c w-100" type="submit">Оформить заказ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
