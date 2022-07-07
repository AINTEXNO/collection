@extends('layouts.base')

@section('title') Стили @endsection

@section('content')
    @include('parts.header')
    <section class="w-full flex justify-center mt-8">
        <div class="container">

            {{--breadcrumbs--}}

            <nav class="flex mb-6" aria-label="Breadcrumb">
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
                            <a href="{{ route('admin.control') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2">Управление контентом</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-600" fill="currentColor" stroke-width="1" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2">Стили</span>
                        </div>
                    </li>
                </ol>
            </nav>

            {{--/breadcrumbs--}}

            <div class="w-full flex justify-between items-center mb-8">
                <h2 class="text-xl text-gray-900">Стили</h2>
            </div>
            @if(session()->has('delete'))
                <div class="p-4 mb-4 text-sm text-red-600 bg-red-100 rounded-lg" role="alert">
                    <span class="font-medium">{{ session()->get('delete') }}</span>
                </div>
            @endif
            @error('title-update')
            <div class="p-4 mb-4 text-sm text-red-600 bg-red-100 rounded-lg" role="alert">
                <span class="font-medium">{{ $message }}</span>
            </div>
            @enderror
            @if(session()->has('created'))
                <div class="w-full p-4 mb-4 text-sm text-green-700 font-normal bg-green-100 rounded-lg" role="alert">
                    <span class="font-normal">{{ session()->get('created') }}</span>
                </div>
            @endif
            @if(session()->has('updated'))
                <div class="w-full p-4 mb-4 text-sm text-green-700 font-normal bg-green-100 rounded-lg" role="alert">
                    <span class="font-normal">{{ session()->get('updated') }}</span>
                </div>
            @endif
            <div class="w-full flex items-start mb-10">
                <ul class="w-1/2 text-sm font-medium text-gray-900 bg-white border border-gray-100 rounded-md">
                    @foreach($styles as $style)
                        <li class="w-full flex justify-between items-center px-4 py-2 border-b border-gray-200 rounded-t-lg">
                            @if(session()->has("edit-{$style->id}"))
                                <form action="{{ route('style.update', ['style' => $style->id]) }}" method="POST" class="w-full flex items-center mr-10">
                                    @csrf
                                    @method('PATCH')
                                    <div class="w-full">
                                        <input type="text" name="title-update" id="title" class="@error('title') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 @enderror
                                            bg-gray-50 border border-gray-100 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2"
                                               placeholder="Нименование" value="{{ $style->title }}">
                                        @error('title')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <button type="submit" class="ml-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-1.5 text-center">Изменить</button>
                                </form>
                            @else
                                {{ $style->title }}
                            @endif
                            <div class="flex items-center">
                                <a href="{{ route('style.edit', ['style' => $style->id]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="fill-gray-600 mr-4 cursor-pointer" viewBox="0 0 16 16" id="edit-button">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('style.destroy', ['style' => $style->id]) }}" method="POST" onsubmit="confirmation(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="fill-red-500" viewBox="0 0 16 16">
                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <form action="{{ route('style.store') }}" method="POST" class="w-1/2 ml-12 flex flex-col items-end">
                    @csrf
                    <div class="w-full">
                        <label for="title" class="block mb-2 text-base text-gray-900">Наименование стиля</label>
                        <input type="text" name="title" id="title" class="@error('title') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 @enderror bg-gray-50 border border-gray-100 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Нименование">
                        @error('title')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Добавить</button>
                </form>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/confirmation.js') }}"></script>
@endsection
