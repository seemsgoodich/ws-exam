@extends('app')

@section('title', 'Каталог')

@section('content')
    <form>
        <div class="mb-2 w-75">
            <h4>Сортировка по параметрам</h4>
            <select name="sort" class="form-select" aria-label="Default select example">
                @foreach([
                    'id' => 'По новизне',
                    'model_year' => 'По году производства',
                    'name' => 'По наименованию',
                    'price' => 'По цене',
                ] as $key => $name)
                    <option @if($sort === $key) selected @endif value="{{$key}}">{{$name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2 w-75">
            <h4>Сортировка по порядку</h4>
            <select name="type" class="form-select" aria-label="Default select example">
                @foreach([
                    'asc' => 'Сначала старые',
                    'desc' => 'Сначала новые',
                ] as $key => $name)
                    <option @if($type === $key) selected @endif value="{{$key}}">{{$name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2 w-75">
            <h4>Сортировка по категориям</h4>
            <select name="category_id" class="form-select" aria-label="Default select example">
                <option value="">Все</option>
                @foreach($categories as $category)
                    <option @if($category->id === $categoryId) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-success mb-2" type="submit">Поиск</button>
    </form>

    <div class="d-flex flex-wrap">
        @forelse($items as $item)
            <div class="card me-2" style="width: 18rem;">
                <a href="{{route('show', $item)}}"><img src="{{$item->image}}" class="card-img-top" alt="{{$item->name}}"></a>
                <div class="card-body">
                    <h5 class="card-title">{{$item->name}}</h5>
                    <p class="card-text">{{$item->available}} шт.</p>
                    @auth
                        <button data-id="{{$item->id}}" class="btn btn-primary addToCart">В корзину</button>
                    @endauth
                </div>
            </div>
        @empty
            <div class="alert alert-primary" role="alert">
                Товары не найдены
            </div>
        @endforelse
    </div>
@endsection
