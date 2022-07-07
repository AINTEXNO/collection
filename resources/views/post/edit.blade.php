@extends('layouts.base')

@section('title') Редактирование новости @endsection

@section('content')
    @include('parts.header')

    {{--breadcrumbs--}}

    <section class="w-full justify-center">
        <div class="container">
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
                            <a href="{{ route('admin.posts') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2">Новости</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-600" fill="currentColor" stroke-width="1" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2">Изменить новость</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    {{--/breadcrumbs--}}

    <section class="w-full h-[calc(100vh-200px)] flex justify-center items-center">
        <div class="w-full flex justify-center">
            <div class="container flex justify-center">
                <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST" class="w-3/5 flex flex-col items-start" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="w-full border border-gray-150 rounded-sm box-border py-5 px-6">
                        <div class="w-full border-b border-gray-200 mt-3 mb-6">
                            <h2 class="text-lg text-gray-600 mb-2">Данные новости</h2>
                        </div>
                        <div class="w-full flex flex-col items-start">
                            <div class="w-full flex mb-3">
                                <label for="title" class="w-44 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Заголовок</label>
                                <div class="w-full flex flex-col items-start">
                                    <input type="text" name="title" id="title" class="@error('title') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm" placeholder="Заголовок новости" value="{{ $post->title }}">
                                    @error('title')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="w-full flex mb-3">
                                <label for="image" class="w-44 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Изображение</label>
                                <div class="w-full flex flex-col items-start">
                                    <input type="file" name="image" id="image" class="@error('image') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm" placeholder="Изображение новости" value="{{ $post->photo }}">
                                    @error('image')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="w-full flex mb-3">
                                <label for="text" class="w-44 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Описание</label>
                                <div class="w-full flex flex-col items-start">
                                    <textarea name="text" id="text" class="@error('text') border-red-400 @enderror resize-none w-full h-44 border box-border py-1.5 px-3 mt-1 rounded-sm" placeholder="Описание новости">{{ $post->text }}</textarea>
                                    @error('text')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="w-full flex justify-end">
                                <button type="submit" class="px-6 py-2.5 text-sm bg-gray-200 text-gray-600 rounded-full uppercase text-black mt-7">Изменить новость</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
