@extends('layouts.base')

@section('title') Редактирование профиля @endsection

@section('content')
    @include('parts.header')
    {{--breadcrumbs--}}

    <section class="w-full mt-2 flex justify-center">
        <div class="container">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">
                            <svg class="mr-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                            Главная
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-600" fill="currentColor" stroke-width="1" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="{{ route('account.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2">Аккаунт</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-600" fill="currentColor" stroke-width="1" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2">Редактирование профиля</span>
                        </div>
                    </li>
                </ol>
            </nav>

        </div>
    </section>

    {{--/breadcrumbs--}}

    <section class="w-full flex mt-8">
        <div class="container flex justify-between items-start">
            <div class="rounded-md min-w-80 w-1/4 bg-white border border-gray-100 mr-10">
                <div class="flex flex-col items-center justify-center p-4 relative">
                    <a href="#" class="block bg-white relative rounded-full h-28 w-28 overflow-hidden absolute">
                        <img alt="{{ $user->name }}" src="/public/storage/{{ $user->photo ?? 'undefined.png' }}" class="mx-auto object-cover rounded-full h-24 w-24 border-2 border-white"/>
                    </a>
                    <p class="text-gray-800 text-xl font-medium mt-2">
                        {{ $user->name }}
                    </p>
                    <p class="text-gray-400 text-sm mb-4">
                        {{ $user->surname }}
                    </p>
                    <p class="text-xs p-2 bg-gray-100 text-gray-500 px-4 rounded-full">
                        {{ $user->role->title }}
                    </p>
                    <p class="flex flex-col mb-1 mt-5 text-center">
                        Сделано заказов
                        <span class="text-black font-bold">{{ $user->orders()->count() }}</span>
                    </p>
                    <div class="w-full flex justify-end mt-5">
                        <a href="{{ route('user.edit', ['user' => $user->id]) }}" class="text-gray-500 font-normal rounded-lg text-sm mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="w-3/4">
                <form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    @if(session()->has('updated'))
                        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                            <span class="font-medium">{{ session()->get('updated') }}</span>
                        </div>
                    @endif
                    @if(session()->has('reset'))
                        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                            <span class="font-medium">{{ session()->get('reset') }}</span>
                        </div>
                    @endif
                    <div class="flex items-center justify-center w-full mb-5">
                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-40 border-1 border-gray-200 border-dashed rounded-lg cursor-pointer bg-gray-50">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Загрузите изображение ил</span></p>
                                <p class="text-xs text-gray-500">SVG, PNG, JPG или GIF</p>
                            </div>
                            @error('image')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                            <input id="dropzone-file" name="image" type="file" class="hidden" />
                        </label>
                    </div>
                    <div class="w-full flex items-center">
                        <div class="w-1/2 flex flex-col items-start mb-3 mr-4">
                            <label for="name" class="text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center mb-2">Имя</label>
                            <div class="w-full flex flex-col items-start">
                                <input type="text" name="name" id="name" class="@error('name') border-red-400 @enderror w-full border py-1.5 px-3 text-base rounded-sm" placeholder="Имя" value="{{ $user->name }}">
                                @error('name')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="w-1/2 flex flex-col items-start mb-3 ml-4">
                            <label for="surname" class="text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center mb-2">Фамилия</label>
                            <div class="w-full flex flex-col items-start">
                                <input type="text" name="surname" id="surname" class="@error('surname') border-red-400 @enderror w-full border py-1.5 px-3 text-base rounded-sm" placeholder="Фамилия" value="{{ $user->surname }}">
                                @error('surname')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="w-full flex items-center">
                        <div class="w-1/2 flex flex-col items-start mb-3 mr-4">
                            <label for="address" class="text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center mb-2">Адрес</label>
                            <div class="w-full flex flex-col items-start">
                                <input type="text" name="address" id="address" class="@error('address') border-red-400 @enderror w-full border py-1.5 px-3 text-base rounded-sm" placeholder="Адрес" value="{{ $user->address }}">
                                @error('address')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="w-1/2 flex flex-col items-start mb-3 ml-4">
                            <label for="email" class="text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center mb-2">Email</label>
                            <div class="w-full flex flex-col items-start">
                                <input type="text" name="email" id="email" class="@error('email') border-red-400 @enderror w-full border py-1.5 px-3 text-base rounded-sm" placeholder="Email" value="{{ $user->email }}">
                                @error('email')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="w-full flex justify-end">
                        <button type="submit" class="px-6 py-2.5 text-sm bg-gray-200 text-gray-600 rounded-full uppercase text-black mt-4">Изменить</button>
                    </div>
                </form>
                <form action="{{ route('password.reset', ['user' => $user->id]) }}" method="POST" class="mt-10">
                    @csrf
                    @method('PATCH')
                    <div class="w-full flex">
                        <div class="w-1/3 flex flex-col items-start mb-3 mr-4">
                            <label for="old_password" class="text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center mb-2">Старый пароль</label>
                            <div class="w-full flex flex-col items-start">
                                <input type="password" name="old_password" id="old_password" class="@error('old_password') border-red-400 @enderror w-full border py-1.5 px-3 text-base rounded-sm" placeholder="Старый пароль" value="{{ $user->old_password }}">
                                @error('old_password')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="w-1/3 flex flex-col items-start mb-3 mx-4">
                            <label for="new_password" class="text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center mb-2">Новый пароль</label>
                            <div class="w-full flex flex-col items-start">
                                <input type="password" name="new_password" id="new_password" class="@error('new_password') border-red-400 @enderror w-full border py-1.5 px-3 text-base rounded-sm" placeholder="Новый пароль" value="{{ $user->new_password }}">
                                @error('new_password')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="w-1/3 flex flex-col items-start mb-3 ml-4">
                            <label for="new_password_confirmation" class="text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center mb-2">Повторите пароль</label>
                            <div class="w-full flex flex-col items-start">
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="@error('new_password_confirmation') border-red-400 @enderror w-full border py-1.5 px-3 text-base rounded-sm" placeholder="Повторите новый пароль" value="{{ $user->new_password_confirmation }}">
                                @error('new_password_confirmation')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="w-full flex justify-end">
                        <button type="submit" class="px-6 py-2.5 text-sm bg-gray-200 text-gray-600 rounded-full uppercase text-black mt-4">Изменить</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
