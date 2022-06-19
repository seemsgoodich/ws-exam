@extends('app')

@section('title', 'Корзина')

@section('content')
    <h2 class="mb-2">Корзина</h2>

    <div class="d-flex flex-wrap">
        @forelse($items as $item)
            <div class="card me-2" style="width: 18rem;">
                <img src="{{$item['item']['image']}}" class="card-img-top" alt="{{$item['item']['image']}}">
                <div class="card-body">
                    <h5 class="card-title">{{$item['item']['name']}}</h5>
                    <p class="card-text">{{$item['item']['price'] * $item['count']}} р.</p>
                    <p class="card-text">{{$item['count']}} шт.</p>
                    <button data-id="{{$item['item']['id']}}" data-count="1" class="btn btn-success editCart">+</button>
                    <button data-id="{{$item['item']['id']}}" data-count="-1" class="btn btn-danger editCart">-</button>
                </div>
            </div>
        @empty
            <div class="alert alert-primary" role="alert">
                Ваша корзина пуста
            </div>
        @endforelse
    </div>

    <div class="mt-2 mb-4">
        Финальная цена: {{$finalPrice}}
    </div>

    <form class="order-form">
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Пароль для подтверждения заказа</label>
            <input required type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-success">Оформить заказ</button>
    </form>
@endsection

@push('scripts')
    <script>
        $('.editCart').click(function() {
            const itemId = $(this).data('id')
            const count = Number($(this).data('count'))
            addToCart(itemId, count, true)
        })

        document.querySelector('.order-form').onsubmit = function(e) {
            e.preventDefault();

            $.post('/order/create', $('.order-form').serializeArray(), data => {
                if (data.error) return alert(data.error)
                location.href = '/orders'
            }).fail(err => alert('неизвестная ошибка'))
        }
    </script>
@endpush
