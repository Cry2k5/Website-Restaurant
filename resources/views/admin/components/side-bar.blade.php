<div class="sidebar">
    <!-- Logo và tên website -->
    <div class="py-3 text-center">
        <h3>Administrator</h3>
    </div>

    <!-- Hiển thị thông tin người dùng -->
    <div class="text-center mb-4">
        @auth
            <p>Logged in as:</p>
            <p><strong>Tên:</strong> {{ Auth::user()->name }}</p>
        @else
            <p>Chưa đăng nhập</p>
        @endauth
    </div>

    <!-- Danh sách chức năng -->
    <ul>
        <!-- Sidebar Menu -->
        <li class="nav-item mb-2">
            <a href="{{route('dashboard')}}" class="nav-link text-white">Dashboard</a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('orders.view') }}" class="nav-link text-white">Quản lý bán hàng</a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{route('bills.index')}}" class="nav-link text-white">Quản lý hóa đơn</a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('users.index') }}" class="nav-link text-white">Quản lý người dùng</a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('blogs.index') }}" class="nav-link text-white">Quản lý bài viết</a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('tables.index') }}" class="nav-link text-white">Quản lý bàn</a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('dishes.index') }}" class="nav-link text-white">Quản lý món ăn</a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{route('galleries.index')}}" class="nav-link text-white">Quản lý thư viện ảnh</a>
        </li>
        

    </ul>

    <!-- Nút Đăng xuất -->
    @auth
        <form method="POST" action="{{ route('logout') }}" class="mt-auto w-100 text-center">
            @csrf
            <button type="submit" class="btn btn-danger w-75">Đăng xuất</button>
        </form>
    @endauth
</div>
