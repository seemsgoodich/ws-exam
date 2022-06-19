@extends('admin.index')

@section('title', 'Редактирование товара')

@section('content')
    <form method="post" action="{{route('admin.items.edit', $item)}}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Название товара</label>
            <input required value="{{$item->name}}" type="text" name="name" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Год производства товара</label>
            <input required value="{{$item->model_year}}" type="text" name="model_year" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Страна производства товара</label>
            <input required value="{{$item->model_country}}" type="text" name="model_country" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Модель товара</label>
            <input required value="{{$item->model_type}}" type="text" name="model_type" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Цена товара</label>
            <input required value="{{$item->price}}" type="number" name="price" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Количество товара</label>
            <input required value="{{$item->available}}" type="number" name="available" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Категория товара</label>
            <select required name="category_id" class="form-select" aria-label="Default select example">
                @foreach($categories as $category)
                    <option @if($category->id === $item->category_id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <h5 class="mb-2">Изображение товара</h5>
            <input required name="image" type="file" accept="image/jpeg,image/png,image/jpg,image/bpm" class="form-control" id="inputGroupFile02">
        </div>
        <button type="submit" class="btn btn-primary">Обновить</button>
    </form>
@endsection
