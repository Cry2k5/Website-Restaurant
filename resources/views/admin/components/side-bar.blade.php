<div class="sidebar">
    <!-- Logo và tên website -->
    <div class="py-3 text-center">
        <h3>Website XXX</h3>
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
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a href="{{ route('users.index') }}" class="nav-link text-white">Quản lý người dùng</a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('users.index') }}" class="nav-link text-white">Quản lý thực đơn</a>
            </li>
            <li class="nav-item mb-2">
                <a href="#" class="nav-link text-white">Quản lý hóa đơn</a>
            </li>
        </ul>

    </ul>

    <!-- Nút Đăng xuất -->
    @auth
        <form method="POST" action="{{ route('logout') }}" class="mt-auto w-100 text-center">
            @csrf
            <button type="submit" class="btn btn-danger w-75">Đăng xuất</button>
        </form>
    @endauth
</div>
