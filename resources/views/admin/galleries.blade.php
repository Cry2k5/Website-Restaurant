<x-admin-base-layout title="Quản lý thư viện ảnh">
    <div class="main-content" style="padding: 20px;">
        <h3>Quản lý thư viện ảnh</h3>
        <div class="d-flex justify-content-between my-3">
            <button class="btn btn-success" id="addGalleryBtn" data-bs-toggle="modal" data-bs-target="#galleryModalAdd">Add New Picture</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="galleryTableBody">
                @foreach ($galleries as $gallery)
                    <tr>
                        <td>{{ $gallery->id }}</td>
                        <td>{{ $gallery->category->name }}</td>
                        <td>
                            @if ($gallery->image_path)
                                <img src="{{ asset($gallery->image_path) }}" alt="Image" width="50">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#galleryModalEdit" data-id="{{ $gallery->id }}">Edit</button>
                            <form method="POST" action="{{ route('galleries.destroy', $gallery->id) }}" style="display:inline;">
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
            {{ $galleries->links() }}
        </div>
    </div>

    <!-- Add Gallery Modal -->
    <div class="modal fade" id="galleryModalAdd" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="galleryModalLabel">Add Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="galleryFormAdd" method="POST" action="{{ route('galleries.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="galleryCategoryAdd" class="form-label">Category</label>
                            <select class="form-control" id="galleryCategoryAdd" name="gallery_category_id" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="galleryImageAdd" class="form-label">Image</label>
                            <input type="file" class="form-control" id="galleryImageAdd" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Gallery Modal -->
    <div class="modal fade" id="galleryModalEdit" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="galleryModalLabel">Edit Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="galleryFormEdit" method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="galleryIdEdit" name="id">
                        <div class="mb-3">
                            <label for="galleryCategoryEdit" class="form-label">Category</label>
                            <select class="form-control" id="galleryCategoryEdit" name="gallery_category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="galleryImageEdit" class="form-label">Image</label>
                            <input type="file" class="form-control" id="galleryImageEdit" name="image">
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
        const galleryID = $(this).data('id');
        $.ajax({
            url: '/admin/galleries/' + galleryID,
            method: 'GET',
            success: function(gallery) {
                $('#galleryIdEdit').val(gallery.id);
                $('#galleryCategoryEdit').val(gallery.gallery_category_id);

                // Cập nhật dynamic action của form
                $('#galleryFormEdit').attr('action', '/admin/galleries/' + gallery.id);
            },
            error: function() {
                alert("Error fetching gallery details.");
            }
        });
    });
</script>
