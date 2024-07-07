@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mb-3">Категории товаров</h1>
        <div class="mb-4">
            <a href="{{ route('categories.create') }}" class="btn btn-red rounded-c">Создать новую категорию</a>
        </div>
        <table class="w-100">
            <thead class="bg-red">
                <div class="row">
                    <th class="text-center col-9 text-white">Категория</th>
                    <th class="text-center col-1 text-white">Изменить</th>
                    <th class="text-center col-1 text-white">Удалить</th>
                </div>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr class="border-bottom">
                        <td class="p-2">{{ $category->category }}</td>
                        <td class="text-center p-2">
                            <a href="{{ route('categories.edit', $category->id) }}"
                                class="btn btn-red rounded-c">Изменить</a>
                        </td>
                        <td class="text-center p-2">
                            <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-red rounded-c" type="submit">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center">Категории не созданы</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
