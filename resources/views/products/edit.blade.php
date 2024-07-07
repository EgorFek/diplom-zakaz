@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 90vh">
            <div class="col-12 col-lg-6 bg-red p-5 pt-0 rounded-c">
                <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <h1 class="fs-3 text-white text-center fw-bold mt-5 mb-5">Создание товара</h1>
                    <div class="form-outline mb-4">
                        <label for="name" class="text-white ms-3 mb-1 fw-bold">Название</label>
                        <input type="title" name="name" id="name" class="form-control pt-2 f-c rounded-c"
                            value="{{ $product->name }}">
                        @error('name')
                            <div class="text-white ms-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-outline mb-4">
                        <label for="description" class="text-white ms-3 mb-1 fw-bold">Описание</label>
                        <textarea name="description" id="description" cols="30" rows="5" class="form-control pt-2 f-c rounded-c">{{ $product->description }}</textarea>
                        @error('description')
                            <div class="text-white ms-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-outline mb-4">
                        <label for="image" class="text-white ms-3 mb-1 fw-bold">Изображение</label>
                        <input type="file" name="image" id="image" class="form-control pt-2 f-c rounded-c">
                        @error('image')
                            <div class="text-white ms-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-outline mb-4">
                        <label for="price" class="text-white ms-3 mb-1 fw-bold">Цена</label>
                        <input type="number" step="0.01" name="price" id="price"
                            class="form-control pt-2 f-c rounded-c" value="{{ $product->price }}">
                        @error('price')
                            <div class="text-white ms-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-outline mb-4">
                        <label for="discount" class="text-white ms-3 mb-1 fw-bold">Цена со скидкой</label>
                        <input type="number" step="0.01" name="discount" id="discount"
                            class="form-control pt-2 f-c rounded-c" value="{{ $product->discount }}">
                        @error('discount')
                            <div class="text-white ms-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-outline mb-4">
                        <label for="category" class="text-white ms-3 mb-1 fw-bold">Категория</label>
                        <select name="category_id" id="category" class="form-control pt-2 f-c rounded-c">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                    {{ $category->category }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="text-white ms-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-outline">
                        <button type="submit" class="btn btn-white rounded-c d-block w-100">Изменить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
