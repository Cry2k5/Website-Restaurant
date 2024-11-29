@props(['dish'])

<div class="blo3 flex-w flex-col-l-sm m-b-30">
    <div class="pic-blo3 size20 bo-rad-10 hov-img-zoom m-r-28">
        <a href="#"><img src="{{ asset($dish->image) }}" alt="IMG-MENU"></a>
    </div>
    <div class="text-blo3 size21 flex-col-l-m">
        <a href="#" class="txt21 m-b-3">
            {{ $dish->dish_name }} <!-- Display dish name -->
        </a>
        <span class="txt22 m-t-20">
            {{ number_format($dish->dish_price, 0, ',', '.') }}₫ <!-- Display dish price -->
        </span>
    </div>
</div>

