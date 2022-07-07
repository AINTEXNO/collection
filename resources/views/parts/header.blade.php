<section class="top-section" id="action-menu">
    <div class="container relative">
        <ul class="menu-list">
            <li class="menu-list__item"><a href="{{ route('favorites') }}" class="menu-list__link" id="favorites-counter">Избранное (0)</a></li>
        </ul>
        <a href="{{ route('home') }}" class="logo-item"><h2 class="logo">Collection</h2></a>
        <ul class="menu-list">
            <li class="menu-list__item"><a href="#" class="menu-list__link"><img src="{{ asset('img/search.svg') }}" alt="Поиск" class="menu-list__icon search-icon"></a></li>
            <li class="menu-list__strip"></li>
            <li class="menu-list__item"><a href="{{ auth()->user() ? route('account.index') : route('login') }}" class="menu-list__link">Мой аккаунт</a></li>
            <li class="menu-list__strip"></li>
            <li class="menu-list__item"><a href="{{ route('cart') }}" class="menu-list__link" id="cart-counter">Корзина (0)</a></li>
            @auth
                <li class="menu-list__strip"></li>
                <li class="menu-list__item"><a href="{{ route('logout') }}" class="menu-list__link" id="logout-btn">Выйти</a></li>
            @endauth
        </ul>
    </div>
</section>
<header class="header">
    <div class="container">
        <nav class="menu">
            <a href="{{ route('home') }}" class="menu__item">Главная</a>
            <a href="{{ route('product.index') }}" class="menu__item">Каталог</a>
            <a href="{{ route('posts.index') }}" class="menu__item">Новости</a>
            <a href="{{ route('promotions.index') }}" class="menu__item">Акции</a>
            <a href="{{ route('shops.index') }}" class="menu__item">Магазины</a>
        </nav>
    </div>
</header>
<script src="{{ asset('js/cart-counter.js') }}"></script>
<script src="{{ asset('js/favorites-counter.js') }}"></script>
<script src="{{ asset('js/logout.js') }}"></script>
