@extends('layouts.base')

@section('title') Главная @endsection

@section('content')
    @include('parts.header')
    <section class="slider">
        <div class="container">
            <div class="slider-content">
                <h3 class="slider-subtitle slider-content__subtitle">Новая акция</h3>
                <h2 class="slider-title slider-content__title">{{ $promotion->title }}</h2>
                <a href="{{ route('promotions.show', ['promotion' => $promotion->id]) }}" class="view-more slider-content__btn">Подробнее</a>
            </div>
            <img src="{{ asset('img/migos-transparent-bracelet-6.png') }}" alt="Изображение" class="slider-image">
        </div>
        <div class="slider-btn prev-btn" id="prev-btn"><svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><title/><g data-name="1" id="_1"><path d="M353,450a15,15,0,0,1-10.61-4.39L157.5,260.71a15,15,0,0,1,0-21.21L342.39,54.6a15,15,0,1,1,21.22,21.21L189.32,250.1,363.61,424.39A15,15,0,0,1,353,450Z"/></g></svg></div>
        <div class="slider-btn next-btn" id="next-btn"><svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><title/><g data-name="1" id="_1"><path d="M353,450a15,15,0,0,1-10.61-4.39L157.5,260.71a15,15,0,0,1,0-21.21L342.39,54.6a15,15,0,1,1,21.22,21.21L189.32,250.1,363.61,424.39A15,15,0,0,1,353,450Z"/></g></svg></div>
    </section>
    <section class="offers">
        <div class="container">
            <div class="offer">
                <div class="offer-content">
                    <h2 class="offer-content__title slider-title">Сумки, кошельки и рюкзаки</h2>
                    <a href="/product?category=sumki_koshelki_ryukzaki" class="offer-content__link">Подробнее</a>
                </div>
                <img src="{{ asset('img/laguna-breeze-rusm-e.png') }}" alt="Сумка" class="offer-image">
            </div>
            <div class="offer">
                <div class="offer-content">
                    <h2 class="offer-content__title slider-title">Солнцезащитные очки</h2>
                    <a href="/product?category=solncezaschitnye-ochki" class="offer-content__link">Подробнее</a>
                </div>
                <img src="{{ asset('img/image6-1.png') }}" alt="Очки" class="offer-image">
            </div>
            <div class="offer">
                <div class="offer-content">
                    <h2 class="offer-content__title slider-title">Бижутерия и аксессуары</h2>
                    <a href="/product?category=bizhuteriya" class="offer-content__link">Подробнее</a>
                </div>
                <img src="{{ asset('img/migos-transparent-bracelet-6.png') }}" alt="Бижутерия" class="offer-image">
            </div>
        </div>
    </section>
    <section class="services">
        <div class="container">
            <div class="service-block">
                <div class="service-block__image">
                    <svg version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve" class="service-block__icon">
                        <g><g>
                                <path d="M451.133,244.876c-9.304-19.694-22.906-37.979-39.793-53.479l-6.333-76.151l-65.309,34.165
                                c-22.943-7.813-47.155-11.77-72.071-11.77c-52.577,0-102.107,17.742-139.465,49.957c-26.576,22.917-44.787,51.213-53.339,82.122
                                c-5.291-2.427-11.167-3.792-17.36-3.792c-23.04,0-41.784,18.744-41.784,41.784v37.89h41.784v-30H45.679v-7.89
                                c0-6.498,5.286-11.784,11.784-11.784c6.497,0,11.783,5.286,11.783,11.784h0.043c-0.02,1.02-0.043,2.04-0.043,3.063
                                c0,49.721,24.173,96.545,66.563,129.421L144.747,512h85.244l5.401-30.374c19.732,2.815,40.052,3.021,59.864,0.612L298.96,512
                                h85.245l12.38-69.625c23.938-17.873,42.623-40.382,54.554-65.701l45.183-12.352V257.229L451.133,244.876z M429.276,351.549
                                l-2.815,6.781c-10.225,24.628-28.263,46.461-52.164,63.139l-5.098,3.556L359.068,482h-33.61l-4.33-34.783l-15.771,3.074
                                c-25.798,5.028-53.258,4.788-78.965-0.722l-15.192-3.256L204.854,482h-33.611l-7.259-58.316l-5.292-3.825
                                c-37.779-27.306-59.447-67.066-59.447-109.084c0-78.924,75.535-143.133,168.381-143.133c23.631,0,46.484,4.087,67.925,12.146
                                l6.283,2.362l37.021-19.367l3.595,43.224l4.676,4.008c17.517,15.016,31.118,33.414,39.334,53.204l2.815,6.782l37.045,10.127
                                v61.294h0L429.276,351.549z"/>
                            </g></g><g>
                            <g><circle cx="368.32" cy="269.51" r="15"/>
                            </g></g><g>
                            <g><rect x="197.28" y="210.97" width="106.88" height="30"/>
                            </g></g><g>
                            <g><path d="M250.72,0c-29.632,0-53.739,24.107-53.739,53.739c0,29.632,24.108,53.739,53.739,53.739
                                c29.632,0,53.739-24.107,53.739-53.739C304.458,24.107,280.352,0,250.72,0z M250.72,77.478c-13.09,0-23.739-10.649-23.739-23.739
                                c0-13.09,10.65-23.739,23.739-23.739c13.09,0,23.739,10.649,23.739,23.739C274.459,66.829,263.81,77.478,250.72,77.478z"/>
                            </g></g>
                    </svg>
                </div>
                <div class="service-content">
                    <h3 class="service-content__title">Бесплатная доставка</h3>
                    <p class="service-content__description">Для любых заказов</p>
                </div>
            </div>
            <div class="service-block">
                <div class="service-block__image">
                    <svg version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve" class="service-block__icon">
                        <g><g>
                                <path d="M451.133,244.876c-9.304-19.694-22.906-37.979-39.793-53.479l-6.333-76.151l-65.309,34.165
                                c-22.943-7.813-47.155-11.77-72.071-11.77c-52.577,0-102.107,17.742-139.465,49.957c-26.576,22.917-44.787,51.213-53.339,82.122
                                c-5.291-2.427-11.167-3.792-17.36-3.792c-23.04,0-41.784,18.744-41.784,41.784v37.89h41.784v-30H45.679v-7.89
                                c0-6.498,5.286-11.784,11.784-11.784c6.497,0,11.783,5.286,11.783,11.784h0.043c-0.02,1.02-0.043,2.04-0.043,3.063
                                c0,49.721,24.173,96.545,66.563,129.421L144.747,512h85.244l5.401-30.374c19.732,2.815,40.052,3.021,59.864,0.612L298.96,512
                                h85.245l12.38-69.625c23.938-17.873,42.623-40.382,54.554-65.701l45.183-12.352V257.229L451.133,244.876z M429.276,351.549
                                l-2.815,6.781c-10.225,24.628-28.263,46.461-52.164,63.139l-5.098,3.556L359.068,482h-33.61l-4.33-34.783l-15.771,3.074
                                c-25.798,5.028-53.258,4.788-78.965-0.722l-15.192-3.256L204.854,482h-33.611l-7.259-58.316l-5.292-3.825
                                c-37.779-27.306-59.447-67.066-59.447-109.084c0-78.924,75.535-143.133,168.381-143.133c23.631,0,46.484,4.087,67.925,12.146
                                l6.283,2.362l37.021-19.367l3.595,43.224l4.676,4.008c17.517,15.016,31.118,33.414,39.334,53.204l2.815,6.782l37.045,10.127
                                v61.294h0L429.276,351.549z"/>
                            </g></g><g>
                            <g><circle cx="368.32" cy="269.51" r="15"/>
                            </g></g><g>
                            <g><rect x="197.28" y="210.97" width="106.88" height="30"/>
                            </g></g><g>
                            <g><path d="M250.72,0c-29.632,0-53.739,24.107-53.739,53.739c0,29.632,24.108,53.739,53.739,53.739
                                c29.632,0,53.739-24.107,53.739-53.739C304.458,24.107,280.352,0,250.72,0z M250.72,77.478c-13.09,0-23.739-10.649-23.739-23.739
                                c0-13.09,10.65-23.739,23.739-23.739c13.09,0,23.739,10.649,23.739,23.739C274.459,66.829,263.81,77.478,250.72,77.478z"/>
                            </g></g>
                    </svg>
                </div>
                <div class="service-content">
                    <h3 class="service-content__title">Бесплатная доставка</h3>
                    <p class="service-content__description">Для любых заказов</p>
                </div>
            </div>
            <div class="service-block">
                <div class="service-block__image">
                    <svg version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve" class="service-block__icon">
                        <g><g>
                                <path d="M451.133,244.876c-9.304-19.694-22.906-37.979-39.793-53.479l-6.333-76.151l-65.309,34.165
                                c-22.943-7.813-47.155-11.77-72.071-11.77c-52.577,0-102.107,17.742-139.465,49.957c-26.576,22.917-44.787,51.213-53.339,82.122
                                c-5.291-2.427-11.167-3.792-17.36-3.792c-23.04,0-41.784,18.744-41.784,41.784v37.89h41.784v-30H45.679v-7.89
                                c0-6.498,5.286-11.784,11.784-11.784c6.497,0,11.783,5.286,11.783,11.784h0.043c-0.02,1.02-0.043,2.04-0.043,3.063
                                c0,49.721,24.173,96.545,66.563,129.421L144.747,512h85.244l5.401-30.374c19.732,2.815,40.052,3.021,59.864,0.612L298.96,512
                                h85.245l12.38-69.625c23.938-17.873,42.623-40.382,54.554-65.701l45.183-12.352V257.229L451.133,244.876z M429.276,351.549
                                l-2.815,6.781c-10.225,24.628-28.263,46.461-52.164,63.139l-5.098,3.556L359.068,482h-33.61l-4.33-34.783l-15.771,3.074
                                c-25.798,5.028-53.258,4.788-78.965-0.722l-15.192-3.256L204.854,482h-33.611l-7.259-58.316l-5.292-3.825
                                c-37.779-27.306-59.447-67.066-59.447-109.084c0-78.924,75.535-143.133,168.381-143.133c23.631,0,46.484,4.087,67.925,12.146
                                l6.283,2.362l37.021-19.367l3.595,43.224l4.676,4.008c17.517,15.016,31.118,33.414,39.334,53.204l2.815,6.782l37.045,10.127
                                v61.294h0L429.276,351.549z"/>
                            </g></g><g>
                            <g><circle cx="368.32" cy="269.51" r="15"/>
                            </g></g><g>
                            <g><rect x="197.28" y="210.97" width="106.88" height="30"/>
                            </g></g><g>
                            <g><path d="M250.72,0c-29.632,0-53.739,24.107-53.739,53.739c0,29.632,24.108,53.739,53.739,53.739
                                c29.632,0,53.739-24.107,53.739-53.739C304.458,24.107,280.352,0,250.72,0z M250.72,77.478c-13.09,0-23.739-10.649-23.739-23.739
                                c0-13.09,10.65-23.739,23.739-23.739c13.09,0,23.739,10.649,23.739,23.739C274.459,66.829,263.81,77.478,250.72,77.478z"/>
                            </g></g>
                    </svg>
                </div>
                <div class="service-content">
                    <h3 class="service-content__title">Бесплатная доставка</h3>
                    <p class="service-content__description">Для любых заказов</p>
                </div>
            </div>
            <div class="service-block">
                <div class="service-block__image">
                    <svg version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve" class="service-block__icon">
                        <g><g>
                                <path d="M451.133,244.876c-9.304-19.694-22.906-37.979-39.793-53.479l-6.333-76.151l-65.309,34.165
                                c-22.943-7.813-47.155-11.77-72.071-11.77c-52.577,0-102.107,17.742-139.465,49.957c-26.576,22.917-44.787,51.213-53.339,82.122
                                c-5.291-2.427-11.167-3.792-17.36-3.792c-23.04,0-41.784,18.744-41.784,41.784v37.89h41.784v-30H45.679v-7.89
                                c0-6.498,5.286-11.784,11.784-11.784c6.497,0,11.783,5.286,11.783,11.784h0.043c-0.02,1.02-0.043,2.04-0.043,3.063
                                c0,49.721,24.173,96.545,66.563,129.421L144.747,512h85.244l5.401-30.374c19.732,2.815,40.052,3.021,59.864,0.612L298.96,512
                                h85.245l12.38-69.625c23.938-17.873,42.623-40.382,54.554-65.701l45.183-12.352V257.229L451.133,244.876z M429.276,351.549
                                l-2.815,6.781c-10.225,24.628-28.263,46.461-52.164,63.139l-5.098,3.556L359.068,482h-33.61l-4.33-34.783l-15.771,3.074
                                c-25.798,5.028-53.258,4.788-78.965-0.722l-15.192-3.256L204.854,482h-33.611l-7.259-58.316l-5.292-3.825
                                c-37.779-27.306-59.447-67.066-59.447-109.084c0-78.924,75.535-143.133,168.381-143.133c23.631,0,46.484,4.087,67.925,12.146
                                l6.283,2.362l37.021-19.367l3.595,43.224l4.676,4.008c17.517,15.016,31.118,33.414,39.334,53.204l2.815,6.782l37.045,10.127
                                v61.294h0L429.276,351.549z"/>
                            </g></g><g>
                            <g><circle cx="368.32" cy="269.51" r="15"/>
                            </g></g><g>
                            <g><rect x="197.28" y="210.97" width="106.88" height="30"/>
                            </g></g><g>
                            <g><path d="M250.72,0c-29.632,0-53.739,24.107-53.739,53.739c0,29.632,24.108,53.739,53.739,53.739
                                c29.632,0,53.739-24.107,53.739-53.739C304.458,24.107,280.352,0,250.72,0z M250.72,77.478c-13.09,0-23.739-10.649-23.739-23.739
                                c0-13.09,10.65-23.739,23.739-23.739c13.09,0,23.739,10.649,23.739,23.739C274.459,66.829,263.81,77.478,250.72,77.478z"/>
                            </g></g>
                    </svg>
                </div>
                <div class="service-content">
                    <h3 class="service-content__title">Бесплатная доставка</h3>
                    <p class="service-content__description">Для любых заказов</p>
                </div>
            </div>
        </div>
    </section>
    <section class="our-products">
        <div class="container">
            <h2 class="section-title our-products__title">Наши продукты</h2>
            <section class="products our-products__content">
                @foreach($products as $product)
                    <article class="product relative">
                        <a href="{{ route('product.show', ['product' => $product->id]) }}" class="product-top">
                            <img src="/public/storage/{{ $product->photo }}" alt="{{ $product->title }}" class="product-top__image">
                        </a>
                        <h2 class="product__title">{{ $product->title }}</h2>
                        @if($product->discount)
                            <div class="flex items-end">
                                <p class="text-lg font-medium mr-4">
                                    {{ $product->currentPrice }}
                                    &#8381;
                                </p>
                                <p class="text-base text-gray-400 line-through mb-px">
                                    {{ $product->price }} &#8381;
                                </p>
                            </div>
                            <span class="bg-green-200 text-green-500 text-xs rounded-md px-3 py-1 absolute top-2 left-2">-{{ $product->discount }}%</span>
                        @else
                            <p class="text-lg font-medium">{{ $product->price }} &#8381;</p>
                        @endif

                        @if($product->promotions()->whereStatus(1)->count())
                            <span class="bg-indigo-400 text-white text-xs rounded-md px-3 py-1 absolute top-2 right-2">Акция</span>
                        @endif
                    </article>
                @endforeach
            </section>
        </div>
    </section>
    <section class="box">
        <div class="container">
            <img src="{{ asset('img/quote.svg') }}" alt="Ковычки" class="quote">
            <h2 class="box__title slider-title">Very good desing. flexibal. fast support.</h2>
            <h4 class="box__author slider-title">Crystal John (Designer)</h4>
        </div>
    </section>
    <section class="categories">
        <div class="container">
            <div class="category">
                <img src="{{ asset('img/png-clipart-kaya-scodelario-standing-woman-wearing-white-dress-while-carrying-blue-bag.png') }}" alt="Девушка с сумкой" class="category__image">
                <div class="category-view">
                    <h2 class="category-view__title slider-title">Сумки и клатчи</h2>
                    <a href="{{ route('product.index', ['category' => 'sumki']) }}" class="category-view__link offer-content__link">Перейти</a>
                </div>
            </div>
            <div class="category">
                <img src="{{ asset('img/solnechnye-ochki-2021.jpg') }}" alt="Девушка с солнцезащитными очками" class="category__image">
                <div class="category-view">
                    <h2 class="category-view__title slider-title">Солнцезащитные очки</h2>
                    <a href="{{ route('product.index', ['category' => 'solncezaschitnye-ochki']) }}" class="category-view__link offer-content__link">Перейти</a>
                </div>
            </div>
            <div class="category">
                <img src="{{ asset('img/6066624131.jpg') }}" alt="Девушка с сумкой" class="category__image">
                <div class="category-view">
                    <h2 class="category-view__title slider-title">Аксессуары для волос</h2>
                    <a href="{{ route('product.index', ['category' => 'aksessuary-dlya-volos']) }}" class="category-view__link offer-content__link">Перейти</a>
                </div>
            </div>
        </div>
    </section>
    <section class="trends">
        <div class="container">
            <div class="section-title">В тренде</div>
            <section class="products our-products__content">
                @foreach($trends as $trend)
                    <article class="product relative">
                        <a href="{{ route('product.show', ['product' => $trend->id]) }}" class="product-top">
                            <img src="/public/storage/{{ $trend->photo }}" alt="{{ $trend->title }}" class="product-top__image">
                        </a>
                        <h2 class="product__title">{{ $trend->title }}</h2>
                        @if($trend->discount)
                            <div class="flex items-end">
                                <p class="text-lg font-medium mr-4">
                                    {{ $trend->currentPrice }}
                                    &#8381;
                                </p>
                                <p class="text-base text-gray-400 line-through mb-px">
                                    {{ $trend->price }} &#8381;
                                </p>
                            </div>
                            <span class="bg-green-200 text-green-500 text-xs rounded-md px-3 py-1 absolute top-2 left-2">-{{ $trend->discount }}%</span>
                        @else
                            <p class="text-lg font-medium">{{ $trend->price }} &#8381;</p>
                        @endif

                        @if($trend->promotions()->whereStatus(1)->count())
                            <span class="bg-indigo-400 text-white text-xs rounded-md px-3 py-1 absolute top-2 right-2">Акция</span>
                        @endif
                    </article>
                @endforeach
            </section>
        </div>
    </section>
    <section class="news mt-8 mb-10">
        <div class="container flex flex-col items-center">
            <div class="section-title">Последние новости</div>
            <div class="w-full grid grid-cols-3 gap-10 mt-10">
                @foreach($posts as $post)
                    <article class="flex flex-col rounded-sm overflow-hidden">
                        <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="w-full h-60 overflow-hidden post-img">
                            <img src="/public/storage/{{ $post->photo }}" alt="{{ $post->title }}" class="w-full h-full object-cover hover:scale-110 duration-300">
                        </a>
                        <div class="w-full py-3 flex-col items-start">
                            <h2 class="text-lg">{{ $post->title }}</h2>
                            <div class="flex items-center text-base text-gray-500 mt-1">
                                <p>{{ $post->created }}</p>
                                <span class="h-5 w-px bg-gray-300 mx-3"></span>
                                <p>{{ $post->comments->count() }} комментариев</p>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    @include('parts.footer')
    <script type="module" src="{{ asset('js/slider.js') }}"></script>
@endsection
