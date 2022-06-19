@extends('admin.index')

@section('title', 'Создание товара')

@section('content')
<h2 class="mt-2">Создание товара</h2>

<form method="post" action="{{route('admin.items.create')}}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label">Название товара</label>
        <input required type="text" name="name" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Год производства товара</label>
        <input required type="text" name="model_year" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Страна производства товара</label>
        <input required type="text" name="model_country" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Модель товара</label>
        <input required type="text" name="model_type" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Цена товара</label>
        <input required type="number" name="price" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Количество товара</label>
        <input required type="number" name="available" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Категория товара</label>
        <select required name="category_id" class="form-select" aria-label="Default select example">
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <h5 class="mb-2">Изображение товара</h5>
        <input required name="image" type="file" accept="image/jpeg,image/png,image/jpg,image/bpm" class="form-control" id="inputGroupFile02">
    </div>
    <button type="submit" class="btn btn-primary">Создать</button>
</form>
@endsection
