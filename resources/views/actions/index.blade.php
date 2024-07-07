@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mb-3">Акции</h1>
        <div class="mb-4">
            <a href="{{ route('actions.create') }}" class="btn btn-red rounded-c">Создать новую акцию</a>
        </div>
        <div class="row">
            @forelse ($actions as $action)
                <div class="col-12 mb-3">
                    <div class="card">
                        <img src="{{ url('storage', $action->image) }}" class="card-img-top">
                        <div class="card-body">
                            <p class="card-title">{{ $action->text }}</p>
                            <div class="d-flex justify-content-center gap-2">
                                @if (!$action->is_avaliable)
                                    <form action="{{ route('actions.on', $action->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <button class="btn btn-red rounded-c">Включить</button>
                                    </form>
                                @else
                                    <form action="{{ route('actions.off', $action->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <button class="btn btn-red rounded-c">Выключить</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning">Акции не найдены</div>
            @endforelse
        </div>
    </div>
@endsection
