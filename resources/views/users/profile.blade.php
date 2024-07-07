@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('includes.profile_nav')
            <div class="col-12 col-lg-8">
                <h1 class="text-red mb-3">Данные аккаунта</h1>
                <form action="{{ route('profile.update') }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-outline mb-3">
                        <label for="nick">Ник</label>
                        <input type="text" name="nick" id="nick" class="form-control"
                            value="{{ auth()->user()->nick }}">
                        @error('nick')
                            <div class="text-red">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-outline mb-3">
                        <label for="email">Почта</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ auth()->user()->email }}">
                        @error('email')
                            <div class="text-red">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-outline">
                        <button type="submit" class="btn btn-red rounded-c">Изменить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
