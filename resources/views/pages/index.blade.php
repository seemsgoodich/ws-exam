@extends('app')

@section('title', 'О нас')

@section('content')
    <div style="text-align: center;">
        <h2 class="change-font">Music House - С музыкой по жизни</h2>

        <h3 class="mb-2 mt-2">Новинки компании</h3>
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" style="width: 70%; margin: 0 auto;">
            <div class="carousel-indicators">
                @foreach($items as $index => $item)
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$index}}" @if($index === 0) class="active" @endif aria-current="true" aria-label="Slide 1"></button>
                @endforeach
            </div>
            <div class="carousel-inner" >
                @forelse($items as $index => $item)
                    <div class="carousel-item @if($index === 0) active @endif">
                        <img height="600" width="200" style="object-fit: cover;" src="{{$item->image}}" class="d-block w-100" alt="{{$item->name}}">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 style="display: block!important;">{{$item->name}}</h5>
                        </div>
                    </div>
                @empty
                    Товаров еще нет, приходите позже
                @endforelse
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
@endsection
