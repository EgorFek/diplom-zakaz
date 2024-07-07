@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 90vh">
            <div class="col-12 col-lg-6 bg-red p-5 pt-0 rounded-c">
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <h1 class="fs-3 text-white text-center fw-bold mt-5 mb-5">Вход в аккаунт</h1>
                    <div class="form-outline mb-4">
                        <label for="email" class="text-white ms-3 mb-1 fw-bold">Почта</label>
                        <input type="email" name="email" id="email" class="form-control f-c rounded-c">
                        @error('email')
                            <div class="text-white ms-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-outline mb-5">
                        <label for="password" class="text-white ms-3 mb-1 fw-bold">Пароль</label>
                        <input type="password" name="password" id="password" class="form-control f-c rounded-c">
                        @error('password')
                            <div class="text-white ms-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-outline">
                        <button type="submit" class="btn btn-white rounded-c d-block w-100">Войти</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
