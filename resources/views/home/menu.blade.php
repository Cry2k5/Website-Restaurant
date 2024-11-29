<x-app-layout title="Menu">

    <!-- Sidebar -->
    <x-menu-sidebar></x-menu-sidebar>

    <!-- Title Page -->
    <section class="bg-title-page flex-c-m p-t-160 p-b-80 p-l-15 p-r-15" style="background-image: url({{asset('images/bg-title-page-01.jpg')}});">
        <h2 class="tit6 t-center">
            Menu
        </h2>
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
                    <div class="col-md-6 col-lg-6 m-l-r-auto">
                        @foreach($category->dishes->take(ceil($category->dishes->count() / 2)) as $dish)
                            <x-menu-item :dish="$dish"></x-menu-item> <!-- Pass dish data to the menu item component -->
                        @endforeach
                    </div>

                    <!-- Column 2 -->
                    <div class="col-md-6 col-lg-6 m-l-r-auto">
                        @foreach($category->dishes->skip(ceil($category->dishes->count() / 2)) as $dish)
                            <x-menu-item :dish="$dish"></x-menu-item> <!-- Pass dish data to the menu item component -->
                        @endforeach
                    </div>
                </div>
            </div>

        </section>
    @endforeach

</x-app-layout>
