@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mb-4">Заказы</h1>
        <div class="row mb-3">
            <div class="col text-center fw-semibold">Заказ</div>
            <div class="col text-center fw-semibold">Дата</div>
            <div class="col text-center fw-semibold">Статус</div>
            <div class="col text-center fw-semibold">Итого</div>
            <div class="col text-center fw-semibold">Данные заказчика</div>
        </div>
        @forelse ($orders as $order)
            <div class="border-bottom mb-3 pb-2">
                <div class="row mb-3">
                    <div class="col text-center">{{ $order->id }}</div>
                    <div class="col text-center">{{ $order->created_at }}</div>
                    <div class="col text-center">{{ $order->status()->first()->status }}</div>
                    <div class="col text-center text-red fw-semibold">{{ $order->total_price }} руб.</div>
                    <div class="col text-center text-red fw-semibold">{{ $order->surname }} {{ $order->name }}</div>
                </div>
                @if ($order->status_id < 3)
                    <div class="d-flex gap-2 justify-content-center">
                        @if ($order->status_id == 1)
                            <form action="{{ route('orders.delivered', $order->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-red rounded-c" type="submit">Доставлен</button>
                            </form>
                        @elseif ($order->status_id == 2)
                            <form action="{{ route('orders.paid', $order->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-red rounded-c" type="submit">Оплачен</button>
                            </form>
                        @endif
                        <form action="{{ route('orders.cancel', $order->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-red rounded-c" type="submit">Отменить</button>
                        </form>
                    </div>
                @endif
            </div>
        @empty
            <div class="alert alert-warning text-center">
                Заказов ещё не создано.
            </div>
        @endforelse
    </div>
@endsection
