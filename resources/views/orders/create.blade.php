@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 p-5 pt-0 rounded-c">
                <form action="{{ route('orders.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="delivery" value="{{ request()->input('delivery') }}">
                    <div class="mb-3">
                        <p class="fs-4"><span class="text-red">1.</span> Контактные данные</p>
                        <div class="form-outline mb-3">
                            <label class="ms-2 mb-1" for="surname">Фамилия</label>
                            <input type="text" name="surname" id="surname"
                                class="form-control rounded-c text-secondary">
                            @error('surname')
                                <div class="text-red">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-outline mb-3">
                            <label class="ms-2 mb-1" for="name">Имя</label>
                            <input type="text" name="name" id="name"
                                class="form-control rounded-c text-secondary">
                            @error('name')
                                <div class="text-red">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-outline mb-3">
                            <label class="ms-2 mb-1" for="phone">Телефон</label>
                            <input type="text" name="phone" id="phone"
                                class="form-control rounded-c text-secondary">
                            @error('phone')
                                <div class="text-red">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-outline mb-4">
                            <label class="ms-2 mb-1" for="email">Почта</label>
                            <input type="email" name="email" id="email"
                                class="form-control rounded-c text-secondary" value="{{ auth()->user()->email }}">
                            @error('email')
                                <div class="text-red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="fs-4"><span class="text-red">2.</span> Способ оплаты</p>
                        <div class="form-outline mb-2">
                            <input type="radio" name="payment" id="bank" value="1" checked>
                            <label for="bank">Прямой банковский перевод</label>
                        </div>
                        <div class="form-outline mb-2">
                            <input type="radio" name="payment" id="delivery" value="2">
                            <label for="delivery">Оплата при доставке</label>
                        </div>
                    </div>
                    <div class="form-outline">
                        <button class="btn btn-red rounded-c d-block w-100">Подтвердить заказ</button>
                    </div>
                </form>
            </div>
            <div class="col-12 col-lg-6 p-5 pt-0 rounded-c">
                <?$products = $cart->products()->get()?>
                @foreach ($products as $product)
                    <div class="row mb-4 align-items-center">
                        <div class="col-1 d-flex justify-content-end">
                            <form action="{{ route('cart.remove', $product->id) }}" method="POST"
                                class="d-flex justify-content-end">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn">X</button>
                            </form>
                        </div>
                        <div class="col-9 col-lg-9 d-grid align-items-center">
                            <div class="row">
                                <div class="col-12 col-lg-3">
                                    <img src="{{ url('storage', $product->image) }}" alt="product" class="mt-3 w-100">
                                </div>
                                <div class="col-12 col-lg-7 d-flex flex-column g-2 align-items-center">
                                    <div class="mb-2 text-gray text-center">{{ $product->name }}</div>
                                    <div class="d-flex justify-content-center">
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
                            </div>
                        </div>
                        <div class="col-2 col-lg-2">
                            <?$price = $product->discount ? $product->discount : $product->price?>
                            <span class="text-red fw-semibold ">{{ $product->pivot->count * $price }}руб.</span>
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-between align-items-center">
                    <div class="fs-4">
                        Итого
                    </div>
                    <div class="fs-4 text-red">
                        {{ $cart->getTotal() }} руб.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
