@extends('layouts.base')

@section('title') Мои заказы @endsection

@section('content')
    @include('parts.header')
    <section class="w-full flex justify-center mt-6">
        <div class="container flex flex-col">

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
                            <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2">Мои заказы</span>
                        </div>
                    </li>
                </ol>
            </nav>

            {{--/breadcrumbs--}}

            <h2 class="text-xl text-gray-900">Мои заказы</h2>
            @if(session()->has('updated'))
                <div class="w-full p-4 text-sm text-green-700 bg-green-100 rounded-lg mt-4" role="alert">
                    <span class="font-medium">{{ session()->get('updated') }}</span>
                </div>
            @endif
            <div class="w-full flex flex-start items-start mt-8">
                <ul class="w-1/5 border border-gray-100 rounded-md mr-10">
                    <li class="w-full text-gray-600 border-b border-gray-100 cursor-pointer
                        @if(is_null(request()->query('status'))) bg-gray-100 cursor-default text-gray-400 pointer-events-none @endif">
                        <a href="{{ request()->url() }}" class="w-full h-full flex box-border px-5 py-3.5">Все заказы</a>
                    </li>
                    @foreach(array('Созданные', 'В доставке', 'Завершенные', 'Отмененные') as $key => $value)
                        <li class="w-full text-gray-600 border-b border-gray-100 cursor-pointer
                            @if(request()->query('status') == $key + 1) bg-gray-100 cursor-default text-gray-400 pointer-events-none @endif">
                            <a href="{{ request()->fullUrlWithQuery(['status' => $key + 1]) }}" class="w-full h-full flex box-border px-5 py-3.5">{{ $value }}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="w-4/5 flex flex-col">
                    @forelse($orders as $order)
                        <div class="f-full flex flex-col border border-gray-100 rounded-md mb-12">
                            <div class="w-full flex justify-between items-center p-7 py-5 border-gray-100">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="pr-20 font-medium text-gray-900">
                                            Номер заказа
                                        </th>
                                        <th class="pr-20 font-medium text-gray-900">
                                            Дата заказа
                                        </th>
                                        <th class="pr-20 font-medium text-gray-900">
                                            Статус
                                        </th>
                                        <th class="pr-20 font-medium text-gray-900">
                                            Стоимость
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-gray-400">
                                            {{ $order->code }}
                                        </td>
                                        <td class="text-gray-400">
                                            {{ $order->created }}
                                        </td>
                                        <td class="text-gray-400">
                                            {{ $order->status->title }}
                                        </td>
                                        <td class="font-medium text-gray-900">
                                            {{ $order->total }} &#8381;
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                @if($order->status->id === 1 || $order->status->id === 2)
                                <form action="{{ route('order.update', ['order' => $order->id]) }}" method="POST" class="flex items-center">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="order_status_id" value="3" class="p-4 py-2 border border-gray-200 rounded-md font-medium text-gray-600 hover:bg-green-600 hover:text-white ease-linear duration-200">
                                        Доставлен
                                    </button>
                                    <button type="submit" name="order_status_id" value="4" class="ml-5 p-4 py-2 border border-gray-200 rounded-md font-medium text-gray-600 hover:bg-red-500 hover:text-white ease-linear duration-200">
                                        Отменить
                                    </button>
                                </form>
                                @endif
                            </div>
                            @foreach($order->products as $product)
                                <div class="w-full flex justify-start items-start border-t border-gray-100 p-7 py-6">
                                    <a href="{{ route('product.show', ['product' => $product->product->id]) }}" class="w-1/5 h-40 flex justify-center items-center bg-gray-50 rounded-md p-5 mr-8">
                                        <img src="/public/storage/{{ $product->product->photo }}" alt="{{ $product->product->title }}" class="3/4 object-cover">
                                    </a>
                                    <div class="w-4/5 h-40 flex flex-col justify-between">
                                        <div class="w-full flex flex-col">
                                            <div class="w-full flex justify-between items-center">
                                                <h2 class="font-medium text-gray-900">{{ $product->product->title }}</h2>
                                                @if($product->product->discount)
                                                    <div class="flex items-end">
                                                        <p class="text-lg font-medium mr-4">
                                                            {{ round($product->product->currentPrice) }}
                                                            &#8381;
                                                        </p>
                                                        <p class="text-base text-gray-400 line-through mb-px">
                                                            {{ $product->product->price }} &#8381;
                                                        </p>
                                                    </div>
                                                @else
                                                    <p class="text-lg font-medium">{{ $product->product->price }} &#8381;</p>
                                                @endif
                                            </div>
                                            <p class="text-base font-normal text-justify mt-1.5 text-gray-400 t-overflow">{{ $product->product->description }}</p>
                                        </div>
                                        <div class="w-full flex justify-end">
                                            <p class="text-gray-400">{{ $product->count }} шт.</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @empty
                        <div class="w-full bg-gray-50 py-5 flex justify-center text-base text-gray-400">Заказы с таким статусом не найдены</div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
