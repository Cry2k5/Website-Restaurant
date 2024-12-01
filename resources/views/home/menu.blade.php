<x-app-layout title="Menu">

    <!-- Sidebar -->
    <x-menu-sidebar></x-menu-sidebar>

    <!-- Title Page -->
    <section class="bg-title-page flex-c-m p-t-160 p-b-80 p-l-15 p-r-15" style="background-image: url({{asset('images/bg-title-page-01.jpg')}});">
        <h2 class="tit6 t-center">
            Menu
        </h2>
    </section>
{{--    main menu--}}
    <section class="section-mainmenu p-t-110 p-b-70 bg1-pattern">
        <div class="container">
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-lg-6 col-md-12 p-b-30">
                        <div class="wrap-item-mainmenu p-b-22">
                            <!-- Tên danh mục -->
                            <h3 class="tit-mainmenu tit10 p-b-25">
                                {{ $category->cate_name }}
                            </h3>

                            @foreach ($category->dishes as $dish)
                                <!-- Món ăn -->
                                <div class="item-mainmenu m-b-36">
                                    <div class="flex-w flex-b m-b-3">
                                        <a href="#" class="name-item-mainmenu txt21">
                                            {{ $dish->dish_name }}
                                        </a>

                                        <div class="line-item-mainmenu bg3-pattern"></div>

                                        <div class="price-item-mainmenu txt22">
                                            {{ number_format($dish->dish_price, 0, ',', '.') }} đ
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Menu Content -->
    @foreach($categories as $category)
        <section class="section-lunch bgwhite">
            <div class="header-lunch parallax0 parallax100" style="background-image: url({{asset('images/header-menu-01.jpg')}});">
                <div class="bg1-overlay t-center p-t-170 p-b-165">
                    <h2 class="tit4 t-center">
                        {{ $category->cate_name }}
                    </h2>
                </div>
            </div>

            <div class="container">
                <div class="row p-t-108 p-b-70">
                    <!-- Column 1 -->
                    <div class="col-md-4 col-lg-4 m-l-r-auto">
                        @foreach($category->dishes->take(ceil($category->dishes->count() / 3)) as $dish)
                            <x-menu-item :dish="$dish"></x-menu-item>
                        @endforeach
                    </div>

                    <!-- Column 2 -->
                    <div class="col-md-4 col-lg-4 m-l-r-auto">
                        @foreach($category->dishes->skip(ceil($category->dishes->count() / 3))->take(ceil($category->dishes->count() / 3)) as $dish)
                            <x-menu-item :dish="$dish"></x-menu-item>
                        @endforeach
                    </div>

                    <!-- Column 3 -->
                    <div class="col-md-4 col-lg-4 m-l-r-auto">
                        @foreach($category->dishes->skip(2 * ceil($category->dishes->count() / 3)) as $dish)
                            <x-menu-item :dish="$dish"></x-menu-item>
                        @endforeach
                    </div>
                </div>
            </div>


        </section>
    @endforeach

</x-app-layout>
