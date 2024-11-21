<x-app-layout title="Gallery">

    <!-- Sidebar -->
    <aside class="sidebar trans-0-4">
        <!-- Button Hide sidebar -->
        <button class="btn-hide-sidebar ti-close color0-hov trans-0-4"></button>

        <!-- - -->
        <ul class="menu-sidebar p-t-95 p-b-70">
            <li class="t-center m-b-13">
                <a href="{{route('home')}}" class="txt19">Home</a>
            </li>

            <li class="t-center m-b-13">
                <a href="{{route('menu')}}" class="txt19">Menu</a>
            </li>

            <li class="t-center m-b-13">
                <a href="{{route('gallery')}}" class="txt19">Gallery</a>
            </li>

            <li class="t-center m-b-13">
                <a href="{{route('about')}}" class="txt19">About</a>
            </li>

            <li class="t-center m-b-13">
                <a href="{{route('blog')}}" class="txt19">Blog</a>
            </li>

            <li class="t-center m-b-33">
                <a href="{{route('contact')}}" class="txt19">Contact</a>
            </li>

            <li class="t-center">
                <!-- Button3 -->
                <a href="{{route('reservation')}}" class="btn3 flex-c-m size13 txt11 trans-0-4 m-l-r-auto">
                    Reservation
                </a>
            </li>
        </ul>

        <!-- - -->
        <div class="gallery-sidebar t-center p-l-60 p-r-60 p-b-40">
            <!-- - -->
            <h4 class="txt20 m-b-33">
                Gallery
            </h4>

            <!-- Gallery -->
            <div class="wrap-gallery-sidebar flex-w">
                <a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-01.jpg" data-lightbox="gallery-footer">
                    <img src="images/photo-gallery-thumb-01.jpg" alt="GALLERY">
                </a>

                <a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-02.jpg" data-lightbox="gallery-footer">
                    <img src="images/photo-gallery-thumb-02.jpg" alt="GALLERY">
                </a>

                <a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-03.jpg" data-lightbox="gallery-footer">
                    <img src="images/photo-gallery-thumb-03.jpg" alt="GALLERY">
                </a>

                <a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-05.jpg" data-lightbox="gallery-footer">
                    <img src="images/photo-gallery-thumb-05.jpg" alt="GALLERY">
                </a>

                <a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-06.jpg" data-lightbox="gallery-footer">
                    <img src="images/photo-gallery-thumb-06.jpg" alt="GALLERY">
                </a>

                <a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-07.jpg" data-lightbox="gallery-footer">
                    <img src="images/photo-gallery-thumb-07.jpg" alt="GALLERY">
                </a>

                <a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-09.jpg" data-lightbox="gallery-footer">
                    <img src="images/photo-gallery-thumb-09.jpg" alt="GALLERY">
                </a>

                <a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-10.jpg" data-lightbox="gallery-footer">
                    <img src="images/photo-gallery-thumb-10.jpg" alt="GALLERY">
                </a>

                <a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-11.jpg" data-lightbox="gallery-footer">
                    <img src="images/photo-gallery-thumb-11.jpg" alt="GALLERY">
                </a>
            </div>
        </div>
    </aside>
    <!-- Title Page -->
    <section class="bg-title-page flex-c-m p-t-160 p-b-80 p-l-15 p-r-15" style="background-image: url(images/bg-title-page-02.jpg);">
        <h2 class="tit6 t-center">
            Gallery
        </h2>
    </section>



    <!-- Gallery -->
    <div class="section-gallery p-t-118 p-b-100">
        <div class="wrap-label-gallery filter-tope-group size27 flex-w flex-sb-m m-l-r-auto flex-col-c-sm p-l-15 p-r-15 m-b-60">
            <button class="label-gallery txt26 trans-0-4 is-actived" data-filter="*">
                All Photo
            </button>

            <button class="label-gallery txt26 trans-0-4" data-filter=".interior">
                Interior
            </button>

            <button class="label-gallery txt26 trans-0-4" data-filter=".food">
                Food
            </button>

            <button class="label-gallery txt26 trans-0-4" data-filter=".events">
                Events
            </button>

            <button class="label-gallery txt26 trans-0-4" data-filter=".guests">
                Vip guests
            </button>
        </div>

        <div class="wrap-gallery isotope-grid flex-w p-l-25 p-r-25">
            <!-- - -->
            <div class="item-gallery isotope-item bo-rad-10 hov-img-zoom events guests">
                <img src="images/photo-gallery-13.jpg" alt="IMG-GALLERY">

                <div class="overlay-item-gallery trans-0-4 flex-c-m">
                    <a class="btn-show-gallery flex-c-m fa fa-search" href="images/photo-gallery-13.jpg" data-lightbox="gallery"></a>
                </div>
            </div>

            <!-- - -->
            <div class="item-gallery isotope-item bo-rad-10 hov-img-zoom food">
                <img src="images/photo-gallery-14.jpg" alt="IMG-GALLERY">

                <div class="overlay-item-gallery trans-0-4 flex-c-m">
                    <a class="btn-show-gallery flex-c-m fa fa-search" href="images/photo-gallery-14.jpg" data-lightbox="gallery"></a>
                </div>
            </div>

            <!-- - -->
            <div class="item-gallery isotope-item bo-rad-10 hov-img-zoom events">
                <img src="images/photo-gallery-15.jpg" alt="IMG-GALLERY">

                <div class="overlay-item-gallery trans-0-4 flex-c-m">
                    <a class="btn-show-gallery flex-c-m fa fa-search" href="images/photo-gallery-15.jpg" data-lightbox="gallery"></a>
                </div>
            </div>

            <!-- - -->
            <div class="item-gallery isotope-item bo-rad-10 hov-img-zoom food">
                <img src="images/photo-gallery-16.jpg" alt="IMG-GALLERY">

                <div class="overlay-item-gallery trans-0-4 flex-c-m">
                    <a class="btn-show-gallery flex-c-m fa fa-search" href="images/photo-gallery-16.jpg" data-lightbox="gallery"></a>
                </div>
            </div>

            <!-- - -->
            <div class="item-gallery isotope-item bo-rad-10 hov-img-zoom food">
                <img src="images/photo-gallery-17.jpg" alt="IMG-GALLERY">

                <div class="overlay-item-gallery trans-0-4 flex-c-m">
                    <a class="btn-show-gallery flex-c-m fa fa-search" href="images/photo-gallery-17.jpg" data-lightbox="gallery"></a>
                </div>
            </div>

            <!-- - -->
            <div class="item-gallery isotope-item bo-rad-10 hov-img-zoom interior guests">
                <img src="images/photo-gallery-18.jpg" alt="IMG-GALLERY">

                <div class="overlay-item-gallery trans-0-4 flex-c-m">
                    <a class="btn-show-gallery flex-c-m fa fa-search" href="images/photo-gallery-18.jpg" data-lightbox="gallery"></a>
                </div>
            </div>

            <!-- - -->
            <div class="item-gallery isotope-item bo-rad-10 hov-img-zoom interior">
                <img src="images/photo-gallery-19.jpg" alt="IMG-GALLERY">

                <div class="overlay-item-gallery trans-0-4 flex-c-m">
                    <a class="btn-show-gallery flex-c-m fa fa-search" href="images/photo-gallery-19.jpg" data-lightbox="gallery"></a>
                </div>
            </div>

            <!-- - -->
            <div class="item-gallery isotope-item bo-rad-10 hov-img-zoom interior">
                <img src="images/photo-gallery-20.jpg" alt="IMG-GALLERY">

                <div class="overlay-item-gallery trans-0-4 flex-c-m">
                    <a class="btn-show-gallery flex-c-m fa fa-search" href="images/photo-gallery-20.jpg" data-lightbox="gallery"></a>
                </div>
            </div>

            <!-- - -->
            <div class="item-gallery isotope-item bo-rad-10 hov-img-zoom events">
                <img src="images/photo-gallery-21.jpg" alt="IMG-GALLERY">

                <div class="overlay-item-gallery trans-0-4 flex-c-m">
                    <a class="btn-show-gallery flex-c-m fa fa-search" href="images/photo-gallery-21.jpg" data-lightbox="gallery"></a>
                </div>
            </div>
        </div>

        <div class="pagination flex-c-m flex-w p-l-15 p-r-15 m-t-24 m-b-50">
            <a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>
            <a href="#" class="item-pagination flex-c-m trans-0-4">2</a>
            <a href="#" class="item-pagination flex-c-m trans-0-4">3</a>
        </div>
    </div>

</x-app-layout>
