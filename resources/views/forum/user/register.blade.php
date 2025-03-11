@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4" style="font-size: 3rem; font-weight: bold; color: #343a40;">Регистрация</h2>

    <!-- Вывод ошибок валидации -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('user.register') }}" class="shadow p-5 rounded bg-white">
        @csrf
        <div class="form-group">
            <label for="name" class="font-weight-bold" style="font-size: 1.5rem;">Имя</label>
            <input id="name" type="text" name="name" class="form-control form-control-lg" required autofocus value="{{ old('name') }}" style="font-size: 1.5rem;">
        </div>

        <div class="form-group">
            <label for="email" class="font-weight-bold" style="font-size: 1.5rem;">Электронная почта</label>
            <input id="email" type="email" name="email" class="form-control form-control-lg" required value="{{ old('email') }}" style="font-size: 1.5rem;">
        </div>

        <div class="form-group">
            <label for="password" class="font-weight-bold" style="font-size: 1.5rem;">Пароль</label>
            <input id="password" type="password" name="password" class="form-control form-control-lg" required style="font-size: 1.5rem;">
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="font-weight-bold" style="font-size: 1.5rem;">Подтверждение пароля</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control form-control-lg" required style="font-size: 1.5rem;">
        </div>

        <div class="form-check m-2">
            <input name="verification" type="checkbox" class="form-check-input" id="verification" style="font-size: 1.2rem;" required>
            <label class="form-check-label" for="verification" style="font-size: 1.2rem;">Вы согласны с условиями использования</label>
        </div>

        <button type="submit" class="btn btn-primary text-center btn-lg">Зарегистрироваться</button>
    </form>

    <div class="text-center mt-4">
        <p style="font-size: 1.2rem;">Уже есть аккаунт? <a href="{{ route('user.FormLogin') }}" class="font-weight-bold">Войти</a></p>
    </div>
</div>
@endsection