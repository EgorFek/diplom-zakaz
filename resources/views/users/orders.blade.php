@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('includes.profile_nav')
            <div class="col-12 col-lg-8">
                <h1 class="text-red mb-4">Заказы</h1>
                <div class="row mb-3">
                    <div class="col text-center fw-semibold">Заказ</div>
                    <div class="col text-center fw-semibold">Дата</div>
                    <div class="col text-center fw-semibold">Статус</div>
                    <div class="col text-center fw-semibold">Итого</div>
                </div>
                @forelse ($orders as $order)
                    <div class="border-bottom mb-3 pb-2">
                        <div class="row">
                            <div class="col text-center">{{ $order->id }}</div>
                            <div class="col text-center">{{ $order->created_at }}</div>
                            <div class="col text-center">{{ $order->status()->first()->status }}</div>
                            <div class="col text-center text-red fw-semibold">{{ $order->total_price }} руб.</div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-warning text-center">
                        Заказов ещё не создано.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
