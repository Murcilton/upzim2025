@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4" style="font-size: 3rem; font-weight: bold; color: #343a40;">Вход в систему</h2>

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

    <form method="POST" action="{{ route('user.login') }}" class="shadow p-5 rounded bg-white">
        @csrf
        <div class="form-group">
            <label for="email" class="font-weight-bold" style="font-size: 1.5rem;">Email</label>
            <input id="email" type="email" name="email" class="form-control form-control-lg" required autofocus value="{{ old('email') }}" style="font-size: 1.5rem;">
        </div>

        <div class="form-group">
            <label for="password" class="font-weight-bold" style="font-size: 1.5rem;">Пароль</label>
            <input id="password" type="password" name="password" class="form-control form-control-lg" required style="font-size: 1.5rem;">
        </div>

        <div class="form-check m-2">
            <input name="remember" type="checkbox" class="form-check-input" id="remember" style="font-size: 1.2rem;">
            <label class="form-check-label" for="remember" style="font-size: 1.2rem;">Запомнить меня</label>
        </div>

        <button type="submit" class="btn btn-primary text-center btn-lg" style="font-size: 1.5rem;">Войти</button>
    </form>

    <div class="text-center mt-4">
        <p style="font-size: 1.2rem;">Нет аккаунта? <a href="{{ route('user.FormRegister') }}" class="font-weight-bold">Зарегистрироваться</a></p>
    </div>
</div>
@endsection