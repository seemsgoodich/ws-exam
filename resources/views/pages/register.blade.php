@extends('app')

@section('title', 'Регистрация')

@section('content')
    <h2 class="mt-4">Регистрация</h2>

    <form class="register-form">
        <div class="mb-3">
            <label class="form-label">Имя</label>
            <input placeholder="Имя" required type="text" name="name" class="form-control" aria-describedby="emailHelp">
            <span class="text-danger"></span>
        </div>
        <div class="mb-3">
            <label class="form-label">Фамилия</label>
            <input placeholder="Фамилия" required type="text" name="surname" class="form-control" aria-describedby="emailHelp">
            <span class="text-danger"></span>
        </div>
        <div class="mb-3">
            <label class="form-label">Отчество</label>
            <input placeholder="Отчество" type="text" name="patronymic" class="form-control" aria-describedby="emailHelp">
            <span class="text-danger"></span>
        </div>
        <div class="mb-3">
            <label class="form-label">Логин</label>
            <input placeholder="Логин" required type="text" name="login" class="form-control" aria-describedby="emailHelp">
            <span class="text-danger"></span>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input placeholder="Email" required type="email" name="email" class="form-control" aria-describedby="emailHelp">
            <span class="text-danger"></span>
        </div>
        <div class="mb-3">
            <label class="form-label">Пароль</label>
            <input placeholder="Пароль" required type="password" name="password" class="form-control" aria-describedby="emailHelp">
            <span class="text-danger"></span>
        </div>
        <div class="mb-3">
            <label class="form-label">Повторение пароля</label>
            <input placeholder="Повторение пароля" required type="password" name="password_repeat" class="form-control" aria-describedby="emailHelp">
            <span class="text-danger"></span>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="rules" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Согласие с правилами регистрации</label>
            <span class="text-danger"></span>
        </div>
        <button type="submit" class="btn btn-primary">Создать аккаунт</button>
    </form>
@endsection

@push('scripts')
    <script>
        document.querySelector('.register-form').onsubmit = function(e) {
            e.preventDefault();

            $('form input').removeClass('is-invalid').parent().find('span').text('')

            $.post('/register', $('.register-form').serializeArray(), data => {
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
