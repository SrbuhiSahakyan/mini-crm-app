@extends('layouts.app')
@section('title', 'Авторизация')
@section('content')
    <div class="widget">
        <div class="widget_body">
            <h2>Вход для менеджера</h2>
            <form method="POST" action="{{ route('login') }}" class="auth_form">
                @csrf
                <div class="form_control">
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form_control" >
                    <input type="password" name="password" placeholder="Пароль">
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="submit">
                    <button type="submit">Войти</button>
                </div>
            </form>
        </div>
    </div>
@endsection