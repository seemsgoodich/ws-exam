@extends('app')

@section('title', 'Авторизация')

@section('content')
    <h2 class="mt-4">Авторизация</h2>

    <form class="login-form">
        <div class="mb-3">
            <label class="form-label">Логин</label>
            <input placeholder="Логин" required type="text" name="login" class="form-control" aria-describedby="emailHelp">
            <span class="text-danger"></span>
        </div>
        <div class="mb-3">
            <label class="form-label">Пароль</label>
            <input placeholder="Пароль" required type="password" name="password" class="form-control" aria-describedby="emailHelp">
            <span class="text-danger"></span>
        </div>
        <button type="submit" class="btn btn-primary">Войти</button>
    </form>
@endsection

@push('scripts')
    <script>
        document.querySelector('.login-form').onsubmit = function(e) {
            e.preventDefault();

            $('form input').removeClass('is-invalid').parent().find('span').text('')

            $.post('/login', $('.login-form').serializeArray(), data => {
                location.href = '/'
            }).fail(err => {
                const {errors} = err.responseJSON;
                for(let key in errors) {
                    $(`input[name="${key}"]`).addClass('is-invalid').parent().find('span').text(errors[key][0])
                }
            })
        }
    </script>
@endpush
