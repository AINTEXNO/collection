@extends('layouts.base')

@section('title') Регистрация @endsection

@section('content')
    @include('parts.header')
    <section class="w-full h-[calc(100vh-150px)] flex justify-center items-center">
        <form action="" method="POST" class="w-1/3 flex flex-col items-start box-border py-5 px-6 border border-gray-150 rounded-sm">
            @csrf
            @if(session()->has('registration'))
                <div class="w-full p-4 mb-4 text-sm text-blue-700 font-normal bg-blue-100 rounded-lg" role="alert">
                    <span class="font-normal">Вы успешно зарегистрировались. <a href="{{ route('login') }}" class="underline">Войдите в аккаунт</a></span>
                </div>
            @endif
            <div class="w-full border-b border-gray-200 mt-3 mb-6">
                <h2 class="text-lg text-gray-600 mb-2">Личный данные</h2>
            </div>
            <div class="w-full flex flex-col items-start">
                <div class="w-full flex items-center">
                    <label for="name" class="w-28 text-md font-normal text-gray-700 mr-5">Имя <span class="font-medium text-red-500">*</span></label>
                    <input type="text" name="name" id="name" class="@error('name') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm" placeholder="Имя" value="{{ old('name') }}">
                </div>
                @error('name')<p class="ml-28 text-base text-red-400 my-2">{{ $message }}</p>@enderror
            </div>
            <div class="w-full flex flex-col items-start mt-3">
                <div class="w-full flex items-center">
                    <label for="surname" class="w-28 text-md font-normal text-gray-700 mr-5">Фамилия <span class="font-medium text-red-500">*</span></label>
                    <input type="text" name="surname" id="surname" class="@error('surname') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm" placeholder="Фамилия" value="{{ old('surname') }}">
                </div>
                @error('surname')<p class="ml-28 text-base text-red-400 my-2">{{ $message }}</p>@enderror
            </div>
            <div class="w-full flex flex-col items-start mt-3">
                <div class="w-full flex items-center">
                    <label for="email" class="w-28 text-md font-normal text-gray-700 mr-5">Email <span class="font-medium text-red-500">*</span></label>
                    <input type="text" name="email" id="email" class="@error('email') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm" placeholder="Email-адрес" value="{{ old('email') }}">
                </div>
                @error('email')<p class="ml-28 text-base text-red-400 my-2">{{ $message }}</p>@enderror
            </div>
            <div class="w-full border-b border-gray-200 mt-5 mb-6">
                <h2 class="text-lg text-gray-600 mb-2">Пароль от аккаунта</h2>
            </div>
            <div class="w-full flex flex-col items-start">
                <div class="w-full flex items-center">
                    <label for="password" class="w-28 text-md font-normal text-gray-700 mr-5">Пароль <span class="font-medium text-red-500">*</span></label>
                    <input type="password" name="password" id="password" class="@error('password') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm" placeholder="Пароль">
                </div>
                @error('password')<p class="ml-28 text-base text-red-400 my-2">{{ $message }}</p>@enderror
            </div>
            <div class="w-full flex flex-col items-start mt-3">
                <div class="w-full flex items-center">
                    <label for="password_confirmation" class="w-28 text-md font-normal text-gray-700 mr-5">Повторите пароль <span class="font-medium text-red-500">*</span></label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="@error('password') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm" placeholder="Пароль">
                </div>
                @error('password_confirmation')<p class="ml-28 text-base text-red-400 my-2">{{ $message }}</p>@enderror
            </div>
            <span class="text-gray-600 mt-5">
                <input type="checkbox" name="rule" id="rule">
                <label for="rule">Согласие на обработку данных</label>
            </span>
            <div class="mt-3">
                <span class="text-base text-gray-500">
                    <a href="{{ route('login') }}" class="underline">Войдите</a>
                    в свой аккаунт
                </span>
            </div>
            <div class="w-full flex justify-end">
                <button type="submit" class="px-6 py-2.5 text-sm bg-gray-200 text-gray-600 rounded-full uppercase text-black mt-7">Зарегистрироваться</button>
            </div>
        </form>
    </section>
@endsection
