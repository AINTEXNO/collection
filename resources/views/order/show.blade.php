@extends('layouts.base')

@section('title') Заказ {{ $order->code }} @endsection

@section('content')
    @include('parts.header')
    <section class="w-full flex justify-center mt-8">
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
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-600" fill="currentColor" stroke-width="1" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="{{ route('admin.orders') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2">Заказы пользователей</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-600" fill="currentColor" stroke-width="1" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2">Заказ {{ $order->code }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            {{--/breadcrumbs--}}
            <h2 class="text-xl text-gray-900">Заказ #{{ $order->code }}</h2>
            @if(session()->has('updated'))
                <div class="w-full p-4 text-sm text-green-700 bg-green-100 rounded-lg mt-4" role="alert">
                    <span class="font-medium">{{ session()->get('updated') }}</span>
                </div>
            @endif
            <div class="w-full flex flex-start items-start mt-8">
                <div class="w-full flex justify-start items-start">
                    <div class="w-1/3 flex flex-col mr-14">
                        <ul class="w-full text-sm text-gray-900 bg-white border border-gray-100 rounded-md">
                            <li class="w-full px-4 py-2.5 border-b border-gray-200 rounded-t-lg">
                                <span class="font-medium">Номер заказа:</span>
                                <span>{{ $order->code }}</span>
                            </li>
                            <li class="w-full px-4 py-2.5 border-b border-gray-200 rounded-t-lg">
                                <span class="font-medium">Текущий статус:</span>
                                <span>{{ $order->status->title }}</span>
                            </li>
                            <li class="w-full px-4 py-2.5 border-b border-gray-200 rounded-t-lg">
                                <span class="font-medium">Получатель:</span>
                                <span>{{ $order->user->full_name }}</span>
                            </li>
                            <li class="w-full px-4 py-2.5 border-b border-gray-200">
                                <span class="font-medium">Адрес:</span>
                                <span>{{ $order->address }}</span>
                            </li>
                            <li class="w-full px-4 py-2.5">
                                <span class="font-medium">Email:</span>
                                <span>{{ $order->user->email }}</span>
                            </li>
                        </ul>
                        <form action="{{ route('order.update', ['order' => $order->id]) }}" method="POST" class="flex items-center mt-6">
                            @csrf
                            @method('PATCH')
                            <select id="countries" name="order_status_id" class="bg-gray-50 border border-gray-100 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}" @if($status->id === $order->status->id) selected @endif>{{ $status->title }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 ml-4">Изменить</button>
                        </form>
                    </div>
                    <div class="w-2/3 flex flex-col border border-gray-100 rounded-md mb-12">
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
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/confirmation.js') }}"></script>
@endsection
