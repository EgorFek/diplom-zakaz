@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 90vh">
            <div class="col-6 col-lg-3">
                <div class="card d-flex justify-content-center align-items-center" style="min-height: 200px">
                    <a href="{{ route('orders') }}" class="text-decoration-none fw-semibold fs-5 text-red">Заказы</a>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card d-flex justify-content-center align-items-center" style="min-height: 200px">
                    <a href="{{ route('products') }}" class="text-decoration-none fw-semibold fs-5 text-red">Товары</a>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card d-flex justify-content-center align-items-center" style="min-height: 200px">
                    <a href="{{ route('categories') }}" class="text-decoration-none fw-semibold fs-5 text-red">Категории</a>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card d-flex justify-content-center align-items-center" style="min-height: 200px">
                    <a href="{{ route('actions') }}" class="text-decoration-none fw-semibold fs-5 text-red">Акции</a>
                </div>
            </div>
        </div>
    </div>
@endsection
