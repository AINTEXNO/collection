@extends('layouts.base')

@section('title') Личный кабинет @endsection

@section('content')
    @include('parts.header')
    <section class="w-full flex mt-10">
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
            <div class="w-3/4 grid grid-cols-3 rounded-md overflow-hidden">
                <a href="{{ route('order.index', ['status' => 1]) }}" class="admin-item p-6 flex flex-col cursor-pointer border border-gray-100">
                    <div class="w-full flex justify-between items-start">
                        <div class="w-12 h-12 bg-indigo-100 rounded-md flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="fill-indigo-600" viewBox="0 0 16 16">
                                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="admin-item__icon fill-gray-300" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0v-6z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-medium mt-4">Мои заказы</h2>
                    <p class="mt-px text-gray-500 text-base">В этом разделе находятся все ваши заказы</p>
                </a>
                @can('is-admin')
                <a href="{{ route('admin.orders') }}" class="admin-item p-6 flex flex-col cursor-pointer border border-gray-100">
                    <div class="w-full flex justify-between items-start">
                        <div class="w-12 h-12 bg-fuchsia-100 rounded-md flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="fill-fuchsia-600" viewBox="0 0 16 16">
                                <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1H2zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12z"/>
                                <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="admin-item__icon fill-gray-300" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0v-6z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-medium mt-4">Заказы пользователей</h2>
                    <p class="mt-px text-gray-500 text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, natus!</p>
                </a>
                <a href="{{ route('admin.control') }}" class="admin-item p-6 flex flex-col cursor-pointer border border-gray-100">
                    <div class="w-full flex justify-between items-start">
                        <div class="w-12 h-12 bg-green-100 rounded-md flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="fill-green-600" viewBox="0 0 16 16">
                                <path d="M6 1v3H1V1h5zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H1zm14 12v3h-5v-3h5zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5zM6 8v7H1V8h5zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H1zm14-6v7h-5V1h5zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1h-5z"/>
                            </svg>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="admin-item__icon fill-gray-300" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0v-6z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-medium mt-4">Управление контентом</h2>
                    <p class="mt-px text-gray-500 text-base">В этом разделе можно создавать, редактировать и удалять категории и товары</p>
                </a>
                <a href="{{ route('admin.products') }}" class="admin-item p-6 flex flex-col cursor-pointer border border-gray-100">
                    <div class="w-full flex justify-between items-start">
                        <div class="w-12 h-12 bg-indigo-100 rounded-md flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="fill-indigo-600" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z"/>
                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                            </svg>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="admin-item__icon fill-gray-300" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0v-6z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-medium mt-4">Товары</h2>
                    <p class="mt-px text-gray-500 text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, natus!</p>
                </a>
                <a href="{{ route('admin.users') }}" class="admin-item p-6 flex flex-col cursor-pointer border border-gray-100">
                    <div class="w-full flex justify-between items-start">
                        <div class="w-12 h-12 bg-sky-100 rounded-md flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="fill-sky-600" viewBox="0 0 16 16">--}}
                                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                            </svg>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="admin-item__icon fill-gray-300" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0v-6z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-medium mt-4">Пользователи</h2>
                    <p class="mt-px text-gray-500 text-base">В этом разделе находятся все пользователи системы</p>
                </a>
                <a href="{{ route('admin.posts') }}" class="admin-item p-6 flex flex-col cursor-pointer border border-gray-100">
                    <div class="w-full flex justify-between items-start">
                        <div class="w-12 h-12 bg-rose-100 rounded-md flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="fill-rose-600" viewBox="0 0 16 16">
                                <path d="M2.5 1A1.5 1.5 0 0 0 1 2.5v11A1.5 1.5 0 0 0 2.5 15h6.086a1.5 1.5 0 0 0 1.06-.44l4.915-4.914A1.5 1.5 0 0 0 15 8.586V2.5A1.5 1.5 0 0 0 13.5 1h-11zM2 2.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5V8H9.5A1.5 1.5 0 0 0 8 9.5V14H2.5a.5.5 0 0 1-.5-.5v-11zm7 11.293V9.5a.5.5 0 0 1 .5-.5h4.293L9 13.793z"/>
                            </svg>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="admin-item__icon fill-gray-300" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0v-6z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-medium mt-4">Новости</h2>
                    <p class="mt-px text-gray-500 text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, natus!</p>
                </a>
                <a href="{{ route('admin.promotions') }}" class="admin-item p-6 flex flex-col cursor-pointer border border-gray-100">
                    <div class="w-full flex justify-between items-start">
                        <div class="w-12 h-12 bg-yellow-100 rounded-md flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="fill-yellow-600" viewBox="0 0 16 16">
                                <path d="M13.442 2.558a.625.625 0 0 1 0 .884l-10 10a.625.625 0 1 1-.884-.884l10-10a.625.625 0 0 1 .884 0zM4.5 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm7 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                            </svg>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="admin-item__icon fill-gray-300" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0v-6z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-medium mt-4">Акции</h2>
                    <p class="mt-px text-gray-500 text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, natus!</p>
                </a>
                @endcan
            </div>
        </div>
    </section>
@endsection
