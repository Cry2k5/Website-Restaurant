@php use Carbon\Carbon; @endphp
@props(['blog'])

<div class="blo1">
    <div class="wrap-pic-blo1 bo-rad-10 hov-img-zoom pos-relative">
        <div> <img src="{{ $blog->image }}" alt="IMG-INTRO"></div>

        <div class="time-blog">
            {{ Carbon::parse($blog->date)->format('d F, Y') }}
        </div>
    </div>

    <div class="wrap-text-blo1 p-t-35">
        <div><h4 class="txt5 color0-hov trans-0-4 m-b-13">
                {{ $blog->title }}
            </h4></div>

        <p class="m-b-20">
            {{ Str::limit($blog->description, 10) }}
        </p>

        <a href="{{route('home.blog')}}" class="txt4">
            Continue Reading
            <i class="fa fa-long-arrow-right m-l-10" aria-hidden="true"></i>
        </a>
    </div>
</div>
