@extends('layouts.base')

@section('title') Заказы пользователей @endsection

@section('content')
    @include('parts.header')
    <section class="w-full flex justify-center mt-8">
        <div class="container">

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
                            <a href="{{ route('account.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2">Аккаунт</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-600" fill="currentColor" stroke-width="1" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2">Заказы пользователей</span>
                        </div>
                    </li>
                </ol>
            </nav>

            {{--/breadcrumbs--}}

            <div class="w-full flex justify-between items-center mb-8">
                <h2 class="text-xl text-gray-900">Заказы пользователей</h2>
            </div>
            @if(session()->has('delete'))
                <div class="p-4 mb-4 text-sm text-red-600 bg-red-100 rounded-lg" role="alert">
                    <span class="font-medium">{{ session()->get('delete') }}</span>
                </div>
            @endif
            @if(session()->has('updated'))
                <div class="w-full p-4 mb-4 text-sm text-blue-700 font-normal bg-blue-100 rounded-lg" role="alert">
                    <span class="font-normal">{{ session()->get('updated') }}</span>
                </div>
            @endif
            <table class="w-full text-sm text-left text-gray-500 overflow-x-auto shadow-md sm:rounded-lg">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Код
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Стоимость
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Кол-во товаров
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Дата заказа
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Статус
                    </th>
                    <th scope="col" class="px-6 py-3"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr class="bg-white border-b border-gray-100">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900">
                            {{ $order->code }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $order->total }} &#8381;
                        </td>
                        <td class="px-6 py-4">
                            {{ $order->products->count() }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $order->created }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $order->status->title }}
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900">
                            <a href="{{ route('order.show', ['order' => $order->id]) }}" class="font-medium text-indigo-600 hover:underline">Подробнее</a>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
