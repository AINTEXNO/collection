@extends('layouts.base')

@section('title') {{ $post->title }} @endsection

@section('content')
    @include('parts.header')
    <section class="w-full flex justify-center mt-8">
        <div class="container flex flex-col">
            <div class="w-full flex flex-start items-start">
                <div class="w-full flex flex-col">
                    <article class="w-full flex flex-col border border-gray-100 rounded-md overflow-hidden">
                        <div class="w-full h-96 overflow-hidden relative">
                            <img src="/public/storage/{{ $post->photo }}" alt="{{ $post->title }}" class="w-full object-cover absolute -top-20 right-0">
                        </div>
                        <div class="w-full box-border p-5 flex flex-col items-start">
                            <h2 class="text-xl">{{ $post->title }}</h2>
                            <div class="flex items-center text-base text-gray-500 mt-2">
                                <p>{{ $post->created }}</p>
                                <span class="h-5 w-px bg-gray-300 mx-3"></span>
                                <p data-count="{{ $post->comments->count() }}" id="comments-counter">{{ $post->comments->count() }} комментариев</p>
                            </div>
                            <div class="h-full flex flex-col justify-between">
                                <p class="text-base text-gray-400 mt-4 post-text text-justify">
                                    {!! nl2br($post->text) !!}
                                </p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
    <section class="w-full flex justify-center mt-8" data-id="{{ $post->id }}" id="comments">
        <div class="container flex flex-col">
            <h2 class="text-xl text-gray-900">Комментарии</h2>
            <div class="w-full flex justify-between items-start mt-8">
                <div class="w-3/4 flex flex-col">
                    @auth
                        <form action="" class="w-full mb-14">
                            <div class="w-full border border-gray-100 rounded-sm box-border py-5 px-6">
                                <div class="w-full border-b border-gray-100 mt-3 mb-6">
                                    <h2 class="text-base text-gray-600 mb-2">Добавить комментарий</h2>
                                </div>
                                <div class="w-full flex items-start">
                                    <label for="comment-text" class="w-40 mt-7 text-md font-normal text-gray-600 text-nowrap mr-5 flex items-center">Комментарий<span class="font-medium text-red-500">*</span></label>
                                    <div class="w-full flex flex-col items-start">
                                        <textarea name="text" id="comment-text" class="resize-none border-gray-100 w-full h-20 border py-1.5 px-3 mt-1 text-base rounded-sm comments-field" placeholder="Ваш комментарий"></textarea>
                                        <p class="text-base text-red-400 my-2 hidden"></p>
                                    </div>
                                </div>
                                <div class="w-full flex justify-end">
                                    <button type="submit" class="px-6 py-2.5 text-sm bg-gray-200 text-gray-600 rounded-full uppercase text-black mt-7">Отправить</button>
                                </div>
                            </div>
                            <input type="hidden" name="post_id" class="comments-field" value="{{ $post->id }}">
                        </form>
                    @endauth
                    <div class="w-full flex flex-col mb-10" id="comments-list">
                        @foreach($comments as $comment)
                            <div class="w-full flex justify-start mb-10 last:mb-0">
                                <img src="/public/storage/{{ $comment->user->photo }}" alt="{{ $comment->user->name }}" class="post-img-sm rounded-full overflow-hidden object-cover">
                                <div class="w-full flex-col items-start ml-6">
                                    <div class="w-full flex justify-between items-center">
                                        <h3 class="text-base">{{ $comment->user->name }} {{ $comment->user->surname }}</h3>
                                        <div class="text-base text-gray-400 flex items-center relative">
                                            @auth
                                                @can('is-comment-author', ['comment' => $comment])
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill mr-3 mt-px hover:fill-red-500 cursor-pointer duration-200" data-id="{{ $comment->id }}" id="delete-comment-btn" viewBox="0 0 16 16">
                                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                    </svg>
                                                @endcan
                                            @endauth
                                            {{ $comment->created }}
                                        </div>
                                    </div>
                                    <p class="text-base text-gray-500 text-justify mt-1">{{ $comment->text }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="w-1/4 flex flex-col items-start rounded-md ml-10">
                    <select name="brand_id" id="comments-filter" class=" w-full border py-1.5 px-3 text-base text-gray-500 rounded-sm">
                        <option selected value="1">Сначала новые</option>
                        <option value="2">Сначала старые</option>
                    </select>
                </div>
            </div>
        </div>
    </section>
    @include('parts.footer')
    <script type="module" src="{{ asset('js/comments.js') }}"></script>
@endsection
