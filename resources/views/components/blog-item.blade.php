@php use Carbon\Carbon; @endphp
@props(['blog'])

<div class="blo4 p-b-63">
    <div class="pic-blo4 hov-img-zoom bo-rad-10 pos-relative">
        <div>
            <!-- Giả sử bạn có trường image_path trong bảng blogs để lưu ảnh -->
            <img src="{{ $blog->image }}" alt="IMG-BLOG">
        </div>

        <div class="date-blo4 flex-col-c-m">
            <span class="txt30 m-b-4">
                {{ Carbon::parse($blog->date)->format('d') }} <!-- Ngày -->
            </span>

            <span class="txt31">
                {{ Carbon::parse($blog->date)->format('M, Y') }} <!-- Tháng và Năm -->
            </span>
        </div>
    </div>

    <div class="text-blo4 p-t-33">
        <h4 class="p-b-16">
            <div class="tit9">{{ $blog->title }}</div> <!-- Tiêu đề bài viết -->
        </h4>

        <div class="txt32 flex-w p-b-24">
            <span>
                by {{ $blog->user->name }} <!-- Tên người đăng từ bảng users -->
                <span class="m-r-6 m-l-4">|</span>
            </span>

            <span>
                {{ Carbon::parse($blog->date)->format('d F, Y') }} <!-- Ngày tháng năm -->
                <span class="m-r-6 m-l-4">|</span>
            </span>
        </div>

        <p>
            {{ Str::limit($blog->description) }} <!-- Mô tả ngắn gọn của bài viết -->
        </p>
    </div>
</div>
