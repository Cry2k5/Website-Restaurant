
<x-admin-base-layout title="Quản lý bài viết">

    <div class="main-content" style="padding: 20px;">
        <h3>Quản lý bài viết</h3>

        <!-- Search and Add Blog -->
        <div class="d-flex justify-content-between my-3">
            <form class="d-flex" action="{{ route('blogs.index') }}" method="GET">
                <input class="form-control mr-sm-2" type="text" name="keyword" placeholder="Search" aria-label="Search" value="{{ request()->query('keyword') }}">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <button class="btn btn-success" id="addBlogBtn" data-bs-toggle="modal" data-bs-target="#blogModalAdd">Add Blog</button>
        </div>

        <!-- Blog Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="blogTableBody">
                @foreach ($blogs as $blog)
                    <tr>
                        <td>{{ $blog->id }}</td>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->user->name ?? 'Unknown' }}</td>
                        <td>{{ Str::limit($blog->description, 50) }}</td>
                        <td>{{ $blog->date }}</td>
                        <td>
                            @if ($blog->image)
                                <img src="{{ asset($blog->image)}}" alt="Image" width="50">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#blogModalEdit" data-id="{{ $blog->id }}">Edit</button>
                            <form method="POST" action="{{ route('blogs.destroy', $blog->id) }}" style="display:inline;">
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
            {{ $blogs->links() }}
        </div>
    </div>

    <!-- Blog Modal for Add -->
    <div class="modal fade" id="blogModalAdd" tabindex="-1" aria-labelledby="blogModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="blogModalLabel">Add Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="blogFormAdd" method="POST" action="{{ route('blogs.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="blogTitleAdd" class="form-label">Title</label>
                            <input type="text" class="form-control" id="blogTitleAdd" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="blogDescriptionAdd" class="form-label">Description</label>
                            <textarea class="form-control" id="blogDescriptionAdd" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="blogImageAdd" class="form-label">Image</label>
                            <input type="file" class="form-control" id="blogImageAdd" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Modal for Edit -->
    <div class="modal fade" id="blogModalEdit" tabindex="-1" aria-labelledby="blogModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="blogModalLabel">Edit Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="blogFormEdit" method="post" action="" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" id="blogIdEdit" name="id">
                        <div class="mb-3">
                            <label for="blogTitleEdit" class="form-label">Title</label>
                            <input type="text" class="form-control" id="blogTitleEdit" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="blogDescriptionEdit" class="form-label">Description</label>
                            <textarea class="form-control" id="blogDescriptionEdit" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="blogImageEdit" class="form-label">Image</label>
                            <input type="file" class="form-control" id="blogImageEdit" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-base-layout>
<script>
    // Mở modal chỉnh sửa bài viết
    $('.edit-btn').on('click', function() {
        const blogID = $(this).data('id');
        console.log(blogID);
        $.ajax({
            url: '/admin/blogs/' + blogID,
            method: 'GET',
            success: function(blog) {
                $('#blogIdEdit').val(blog.id);
                $('#blogTitleEdit').val(blog.title);
                $('#blogDescriptionEdit').val(blog.description);

                // Cập nhật dynamic action của form
                $('#blogFormEdit').attr('action', '/admin/blogs/' + blog.id);
            },
            error: function() {
                alert("Error fetching blog details.");
            }
        });
    });
</script>

