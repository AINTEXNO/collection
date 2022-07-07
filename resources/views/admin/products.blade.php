@extends('layouts.base')

@section('title') Товары @endsection

@section('content')
    @include('parts.header')
    <section class="w-full flex justify-center mb-12">
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
                            <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2">Товары</span>
                        </div>
                    </li>
                </ol>
            </nav>

            {{--/breadcrumbs--}}

            <div class="w-full flex justify-between items-center mb-8">
                <h2 class="text-xl text-gray-900">Товары</h2>
                <a href="{{ route('product.create') }}" class="px-6 py-2.5 text-sm bg-indigo-600 text-white rounded-full text-black">Добавить товар</a>
            </div>
            @if(session()->has('delete'))
                <div class="p-4 text-sm text-red-600 bg-red-100 rounded-lg mt-4" role="alert">
                    <span class="font-medium">{{ session()->get('delete') }}</span>
                </div>
            @endif
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-8">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3"></th>
                        <th scope="col" class="px-6 py-3">
                            Наименование
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Категория
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Стоимость
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Количество
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Код
                        </th>
                        <th scope="col" class="px-6 py-3"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                <img src="/public/storage/{{ $product->photo ?? 'undefined.png' }}" alt="{{ $product->title }}" class="w-10 h-10 rounded-full object-cover">
                            </th>
                            <td class="px-6 py-4">
                                {{ $product->title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $product->category->title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $product->price }} &#8381;
                            </td>
                            <td class="px-6">
                                {{ $product->count }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $product->code }}
                            </td>
                            <td class="px-6 py-4 flex items-center mt-2">
                                <a href="{{ route('product.edit', ['product' => $product->id]) }}" class="font-medium text-indigo-600 hover:underline">Редактировать</a>
                                <form action="{{ route('product.destroy', ['product' => $product->id]) }}" method="POST" class="ml-6" onsubmit="confirmation(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium text-red-500 hover:underline">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/confirmation.js') }}"></script>
@endsection
