@php
use Illuminate\Support\Facades\{Crypt};

@endphp
<x-admin-base-layout title="Quản lý người dùng">
    <x-admin-side-bar />
    <div class="main-content" style="padding: 20px;">
        <h3>Quản lý người dùng</h3>
        <!-- Search and Add User -->
        <div class="d-flex justify-content-between my-3">
            <input type="text" id="searchInput" class="form-control w-50" placeholder="Search users...">
            <button class="btn btn-success" id="addUserBtn" data-bs-toggle="modal" data-bs-target="#userModalAdd">Add User</button>
        </div>

        <!-- User Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="userTableBody">
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{$user->address}}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#userModalEdit" data-id="{{ $user->id }}">Edit</button>
                            <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>

    <!-- User Modal for Add -->
    <div class="modal fade" id="userModalAdd" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for Adding User -->
                    <form id="userFormAdd" method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="userNameAdd" class="form-label">Name</label>
                            <input type="text" class="form-control" id="userNameAdd" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="userEmailAdd" class="form-label">Email</label>
                            <input type="email" class="form-control" id="userEmailAdd" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="userPhoneAdd" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="userPhoneAdd" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="userAddressAdd" class="form-label">Address</label>
                            <input type="text" class="form-control" id="userAddressAdd" name="address">
                        </div>
                        <div class="mb-3">
                            <label for="userPasswordAdd" class="form-label">Password</label>
                            <input type="password" class="form-control" id="userPasswordAdd" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="userRoleAdd" class="form-label">Role</label>
                            <select class="form-select" id="userRoleAdd" name="role" required>
                                <option value="Admin">Admin</option>
                                <option value="Staff">Staff</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- User Modal for Edit -->
    <div class="modal fade" id="userModalEdit" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for Editing User -->
                    <form id="userFormEdit" method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="userIdEdit" name="id">
                        <div class="mb-3">
                            <label for="userNameEdit" class="form-label">Name</label>
                            <input type="text" class="form-control" id="userNameEdit" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="userEmailEdit" class="form-label">Email</label>
                            <input type="email" class="form-control" id="userEmailEdit" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="userPhoneEdit" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="userPhoneEdit" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="userAddressEdit" class="form-label">Address</label>
                            <input type="text" class="form-control" id="userAddressEdit" name="address">
                        </div>
                        <div class="mb-3">
                            <label for="userPasswordEdit" class="form-label">Password</label>
                            <input type="password" class="form-control" id="userPasswordEdit" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="userRoleEdit" class="form-label">Role</label>
                            <select class="form-select" id="userRoleEdit" name="role" required>
                                <option value="Admin">Admin</option>
                                <option value="Staff">Staff</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
    $('#searchInput').on('keyup', function () {
        var query = $(this).val();

        $.ajax({
            url: '/users/search',
            method: 'GET',
            data: { search: query },
            success: function(response) {
                // Cập nhật bảng với dữ liệu mới
                var tableBody = $('#userTableBody');
                tableBody.empty();  // Xóa dữ liệu cũ

                response.users.data.forEach(function(user) {
                    var row = `<tr>
                    <td>${user.id}</td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>${user.phone}</td>
                    <td>${user.address}</td>
                    <td>${user.role}</td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#userModalEdit" data-id="${user.id}">Edit</button>
                        <form method="POST" action="/users/${user.id}" style="display:inline;">
                            @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>`;
                    tableBody.append(row);
                });

                // Cập nhật phân trang (nếu có)
                var pagination = $('.pagination');
                pagination.empty();  // Xóa phân trang cũ
                response.users.links.forEach(function(link) {
                    if (link.url) {
                        pagination.append(`<li class="page-item"><a class="page-link" href="${link.url}">${link.label}</a></li>`);
                    }
                });
            }
        });
    });


</script>

</x-admin-base-layout>
