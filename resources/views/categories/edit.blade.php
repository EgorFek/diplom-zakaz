@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 90vh">
            <div class="col-12 col-lg-6 bg-red p-4 rounded-c">
                <form action="{{ route('categories.update', $category->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-outline mb-3">
                        <label for="category" class="text-white ms-3 fw-bold mb-2">Название категории</label>
                        <input type="text" name="category" id="category" class="form-control f-c rounded-c"
                            value="{{ $category->category }}">
                        @error('category')
                            <div class="text-white">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-white rounded-c d-block w-100">Изменить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
