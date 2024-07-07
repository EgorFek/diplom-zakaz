@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 90vh">
            <div class="col-12 col-lg-6 bg-red p-4 rounded-c">
                <form action="{{ route('actions.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-outline mb-3">
                        <label for="image" class="text-white ms-3 fw-bold mb-2">Изображение акции</label>
                        <input type="file" name="image" id="image" class="form-control f-c rounded-c">
                        @error('image')
                            <div class="text-white">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-outline mb-3">
                        <label for="text" class="text-white ms-3 fw-bold mb-2">Текст акции</label>
                        <textarea name="text" id="text" class="form-control f-c rounded-c" cols="30" rows="5"></textarea>
                        @error('text')
                            <div class="text-white">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-outline mb-3">
                        <p class="text-white ms-3 fw-bold mb-2">Позиция текста</p>
                        <div>
                            <input type="radio" name="position" id="left" value="left" checked>
                            <label class="text-white" for="left">Слева</label>
                        </div>
                        <div>
                            <input type="radio" name="position" id="center" value="center">
                            <label class="text-white" for="center">В центре</label>
                        </div>
                        <div>
                            <input type="radio" name="position" id="right" value="right">
                            <label class="text-white" for="right">Справа</label>
                        </div>
                        @error('position')
                            <div class="text-white">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-white rounded-c d-block w-100">Создать</button>
                </form>
            </div>
        </div>
    </div>
@endsection
