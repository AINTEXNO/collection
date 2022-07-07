@extends('layouts.base')

@section('title') Прикрепить продукты @endsection

@section('content')
    @include('parts.header')
    <section class="w-full flex justify-center mt-10">
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
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-600" fill="currentColor" stroke-width="1" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="{{ route('admin.promotions') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2">Акции</a>
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

            <div class="w-full flex flex-col items-start mb-8">
                <h2 class="text-xl text-gray-900">Прикрепить продукты</h2>
                <p class="text-base text-gray-500">к акции "{{ $promotion->title }}"</p>
            </div>
            @if(session()->has('delete'))
                <div class="p-4 mb-4 text-sm text-red-600 bg-red-100 rounded-lg" role="alert">
                    <span class="font-medium">{{ session()->get('delete') }}</span>
                </div>
            @endif
            @if(session()->has('attached'))
                <div class="w-full p-4 mb-4 text-sm text-green-700 font-normal bg-green-100 rounded-lg" role="alert">
                    <span class="font-normal">Товары успешно прикреплены к акции</span>
                </div>
            @endif
            @if(session()->has('detached'))
                <div class="p-4 mb-4 text-sm text-red-600 bg-red-100 rounded-lg" role="alert">
                    <span class="font-medium">{{ session()->get('detached') }}</span>
                </div>
            @endif
            <form action="{{ route('admin.promotions.attach') }}" method="POST">
                @csrf
                <input type="hidden" name="promotion_id" value="{{ $promotion->id }}">
                <table class="w-full text-sm text-left text-gray-500 overflow-x-auto shadow-md sm:rounded-lg">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Идентификатор
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Наименование
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Категория
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Количество
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr class="bg-white border-b border-gray-100">
                            <td class="px-6 py-4">
                                {{ $product->code }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $product->title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $product->category->title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $product->count }}
                            </td>
                            <td class="px-6 py-4 text-right flex items-center">
                                <input type="checkbox" name="products[]" value="{{ $product->id }}" class="mr-2" @if($product->promotions()->count() || !$product->count) disabled @endif>
                                @if($product->promotions()->count())
                                    Товар прикреплен
                                    <div class="w-4 h-4 bg-green-500 rounded-full flex justify-center items-center ml-4 mt-px">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="fill-white" viewBox="0 0 16 16">
                                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                                        </svg>
                                    </div>
                                @else
                                    @if(!$product->count)
                                        Нет в наличии
                                    @else
                                        Прикрепить товар
                                    @endif
                                @endif
                            </td>
                            <td class="w-0 h-0" style="display: none">
                                <form action=""></form>
                            </td>
                            <td>
                                @if($product->promotions()->count())
                                <form action="{{ route('promotion.detach', ['product' => $product->id]) }}" class="mt-2" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="fill-red-500 cursor-pointer" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </button>
                                    <input type="hidden" value="{{ $promotion->id }}" name="promotion" />
                                </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="w-full flex justify-end mt-3">
                    <button type="submit" name="action" value="1" class="px-6 py-2.5 text-sm bg-green-600 text-white rounded-md text-black mt-7">Прикрепить</button>
                </div>
            </form>
        </div>
    </section>
    <script src="{{ asset('js/confirmation.js') }}"></script>
@endsection
