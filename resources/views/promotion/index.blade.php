@extends('layouts.base')

@section('title') Акции @endsection

@section('content')
    @include('parts.header')
    <section class="w-full flex justify-center mt-8">
        <div class="container flex flex-col">

            {{--breadcrumbs--}}

            <nav class="flex mb-8" aria-label="Breadcrumb">
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
                            <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2">Акции</span>
                        </div>
                    </li>
                </ol>
            </nav>

            {{--/breadcrumbs--}}

            <h2 class="text-xl text-gray-900">Акции</h2>
            <div class="w-full flex flex-start items-start mt-8">
                <div class="w-full grid grid-cols-2 gap-10">
                    @foreach($promotions as $promotion)
                        <article class="flex flex-col border border-gray-100 rounded-md overflow-hidden">
                            <a href="{{ route('promotions.show', ['promotion' => $promotion->id]) }}" class="w-full h-80 overflow-hidden post-img">
                                <img src="/public/storage/{{ $promotion->photo }}" alt="{{ $promotion->title }}" class="w-full h-full object-cover hover:scale-110 duration-300">
                            </a>
                            <div class="w-full box-border p-5 flex flex-col items-start">
                                <h2 class="text-lg">{{ $promotion->title }}</h2>
                                <div class="flex items-center text-base text-gray-500 mt-1">
                                    <p class="text-gray-400">во всех магазинах {{ $promotion->duration }}</p>
                                </div>
                                <div class="h-full flex flex-col justify-between">
                                    <p class="text-base text-gray-400 mt-3 text-justify t-overflow-lg overflow-hidden post-text">{{ $promotion->description }}</p>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
