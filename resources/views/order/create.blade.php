@extends('layouts.base')

@section('title') Оформление заказа @endsection

@section('content')
    @include('parts.header')
    <section class="w-full flex flex-col items-center mt-6" id="order-app">
        <div class="w-full flex justify-center">
            <div class="w-full container">

                {{--breadcrumbs--}}

                <nav class="flex mb-4" aria-label="Breadcrumb">
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
                                <a href="{{ route('cart') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2">Корзина</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-600" fill="currentColor" stroke-width="1" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2">Оформление заказа</span>
                            </div>
                        </li>
                    </ol>
                </nav>

                {{--/breadcrumbs--}}

                <div class="w-full flex mt-8">
                    <div class="w-4/6 bg-white">
                        <div class="flex justify-between pb-8">
                            <h2 class="text-lg text-gray-900">Данные получателя</h2>
                        </div>
                        <div class="w-full border border-gray-150 rounded-sm box-border py-5 px-6" id="fields">
                            <div class="w-full flex flex-col items-start">
                                <div class="w-full flex mb-3">
                                    <label for="surname" class="w-52 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Фамилия <span class="font-medium text-red-500">*</span></label>
                                    <div class="w-full flex flex-col items-start">
                                        <input type="text" name="surname" id="surname" class="@error('surname') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm" placeholder="Фамилия получателя" value="{{ $user->surname }}">
                                        @error('surname')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                                <div class="w-full flex mb-3">
                                    <label for="name" class="w-52 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Имя <span class="font-medium text-red-500">*</span></label>
                                    <div class="w-full flex flex-col items-start">
                                        <input type="text" name="name" id="name" class="@error('name') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm" placeholder="Имя получателя" value="{{ $user->name }}">
                                        @error('name')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                                <div class="w-full flex mb-3">
                                    <label for="email" class="w-52 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Email <span class="font-medium text-red-500">*</span></label>
                                    <div class="w-full flex flex-col items-start">
                                        <input type="text" name="email" id="email" class="@error('email') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm" placeholder="Адрес электронной почты" value="{{ $user->email }}">
                                        @error('email')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                                <div class="w-full flex mb-3">
                                    <label for="address" class="w-52 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Адрес доставки <span class="font-medium text-red-500">*</span></label>
                                    <div class="w-full flex flex-col items-start">
                                        <input type="text" name="address" id="address" class="create-order-input @error('address') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm" placeholder="Адрес доставки" value="{{ $user->address ?? '' }}" required>
                                        @error('address')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-2/6 pl-10" id="order-details"></div>
                </div>
                <input type="hidden" name="user_id" class="create-order-input" value="{{ auth()->id() }}">
            </div>
        </div>
    </section>
    <script type="module" src="{{ asset('js/order.js') }}"></script>
@endsection
