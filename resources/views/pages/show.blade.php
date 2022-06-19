@extends('app')

@section('title', 'Корзина')

@section('content')
    <h2 class="mb-2">Название товара: {{$item->name}}</h2>
    <div class="d-flex">
        <img style="object-fit: cover;" height="400" width="400" src="{{$item->image}}" alt="{{$item->name}}">
        <div class="m-2">
            <p class="mb-1">Цена: {{$item->price}} р.</p>
            <p class="mb-1">Страна производитель: {{$item->model_country}}</p>
            <p class="mb-1">Год выпуска: {{$item->model_year}}</p>
            <p class="mb-1">Модель: {{$item->model_type}}</p>
            @auth
                <button data-id="{{$item->id}}" class="btn btn-primary addToCart">В корзину</button>
            @endauth
        </div>
    </div>
@endsection
