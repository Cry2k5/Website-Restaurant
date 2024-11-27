<x-app-layout title="Blog">]

    <!-- Sidebar -->
    <x-menu-sidebar></x-menu-sidebar>
    <!-- Title Page -->
    <section class="bg-title-page flex-c-m p-t-160 p-b-80 p-l-15 p-r-15" style="background-image: url(images/bg-title-page-03.jpg);">
        <h2 class="tit6 t-center">
            Blog
        </h2>
    </section>


    <!-- Content page -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="p-t-80 p-b-124 bo5-r h-full p-r-50 p-r-0-md bo-none-md">
                        <!-- Blog List -->
                        @foreach ($blogs as $blog)
                            <x-blog-item :blog="$blog" />
                        @endforeach


                        <!-- Phân trang -->
                        <div class="pagination flex-c-m flex-w p-l-15 p-r-15 m-t-24 m-b-50">
                            <!-- Page Links -->
                            @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                                <a href="{{ $url }}" class="item-pagination flex-c-m trans-0-4 {{ $page == $blogs->currentPage() ? 'active-pagination' : '' }}">
                                    {{ $page }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
