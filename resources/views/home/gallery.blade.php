<x-app-layout title="Gallery">

    <!-- Sidebar -->
    <x-menu-sidebar></x-menu-sidebar>

    <!-- Title Page -->
    <section class="bg-title-page flex-c-m p-t-160 p-b-80 p-l-15 p-r-15" style="background-image: url('{{ asset('images/bg-title-page-02.jpg') }}');">
        <h2 class="tit6 t-center">
            Gallery
        </h2>
    </section>

    <!-- Gallery Section -->
    <div class="section-gallery p-t-118 p-b-100">
        <!-- Gallery Filter Buttons -->
        <div class="wrap-label-gallery filter-tope-group size27 flex-w flex-sb-m m-l-r-auto flex-col-c-sm p-l-15 p-r-15 m-b-60">
            <button class="label-gallery txt26 trans-0-4 is-actived" data-filter="*">
                All Photos
            </button>
            @foreach($categories as $category)
                <button class="label-gallery txt26 trans-0-4" data-filter=".{{ Str::slug($category->name) }}">
                    {{ $category->name }}
                </button>
            @endforeach
        </div>

        <!-- Gallery Items -->
        <div class="wrap-gallery isotope-grid flex-w p-l-25 p-r-25">
            @foreach($galleries as $gallery)
                <div class="item-gallery isotope-item bo-rad-10 hov-img-zoom {{ Str::slug($gallery->category->name) }}">
                    <img src="{{ asset($gallery->image_path) }}" alt="IMG-GALLERY">

                    <div class="overlay-item-gallery trans-0-4 flex-c-m">
                        <a class="btn-show-gallery flex-c-m fa fa-search" href="{{ asset($gallery->image_path) }}" data-lightbox="gallery"></a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination flex-c-m flex-w p-l-15 p-r-15 m-t-24 m-b-50">
            @if ($galleries->lastPage() > 1)
                @foreach ($galleries->getUrlRange(1, $galleries->lastPage()) as $page => $url)
                    <a href="{{ $url }}" class="item-pagination flex-c-m trans-0-4 {{ $page == $galleries->currentPage() ? 'active-pagination' : '' }}">
                        {{ $page }}
                    </a>
                @endforeach
            @endif
        </div>
    </div>

</x-app-layout>
