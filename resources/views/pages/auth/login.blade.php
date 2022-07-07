@extends('layouts.base')

@section('title') Вход в аккаунт @endsection

@section('content')
    @include('parts.header')
    <section class="w-full h-[calc(100vh-250px)] flex justify-center items-center">
        <form action="" method="POST" class="w-96 flex flex-col items-start py-5 px-6 border border-gray-100 rounded-sm" id="login-form">
            @csrf
            <h2 class="w-full text-xl mb-5 text-center text-gray-600">Вход в аккаунт</h2>
            <div class="w-full flex flex-col items-start">
                <label for="email" class="text-md font-normal text-gray-700">Email</label>
                <input type="text" name="email" id="email" class="@error('email') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm login-field" placeholder="Email-адрес" value="{{ old('email') }}">
                @error('email')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
            </div>
            <div class="w-full flex flex-col items-start mt-3">
                <label for="password" class="text-md font-normal text-gray-700">Пароль</label>
                <input type="password" name="password" id="password" class="@error('password') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm login-field" placeholder="Пароль">
                @error('password')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
            </div>
            <div class="mt-3">
                <span class="text-base text-gray-500">
                    <a href="{{ route('registration') }}" class="underline">Зарегистрировать</a>
                    новый аккаунт
                </span>
            </div>
            <div class="w-full flex justify-center">
                <button type="submit" class="px-6 py-2.5 text-sm bg-gray-200 rounded-full uppercase text-gray-600 mt-7">Войти</button>
            </div>
        </form>
    </section>
    <script src="{{ asset('js/login.js') }}"></script>
@endsection
