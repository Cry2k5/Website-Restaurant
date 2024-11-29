<x-admin-base-layout title="Quản lý bài viết">
    <div class="main-content" style="padding: 20px;">
        <h3>Quản lý bàn</h3>

        <div class="d-flex justify-content-between my-3">
            <input type="text" id="searchTableInput" class="form-control w-50" placeholder="Search tables...">
            <button class="btn btn-success" id="addTableBtn" data-bs-toggle="modal" data-bs-target="#tableModalAdd">Add Table</button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Capacity</th>
                    <th>Sate</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="tableTableBody">
                @foreach ($restaurant_tables as $table)
                    <tr>
                        <td>{{ $table->table_id }}</td>
                        <td>{{ $table->capacity }}</td>
                        <td>{{ $table->state }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#tableModalEdit" data-id="{{$table->table_id}}">Edit</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $restaurant_tables->links() }}
        </div>
    </div>

    <div class="modal fade" id="tableModalAdd" tabindex="-1" aria-labelledby="tableModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tableModalLabel">Add Table</h5>
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
                    <form id="tableFormAdd" method="POST" action="{{ route('tables.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="tableCapacityAdd" class="form-label">Capacity</label>
                            <input type="text" class="form-control" id="tableCapacityAdd" name="capacity" required>
                        </div>
                        <div class="mb-3">
                            <label for="tableStateAdd" class="form-label">State</label>
                            <select class="form-select" id="tableStateAdd" name="state" required>
                                <option value="available">Available</option>
                                <option value="reserved">Reserved</option>
                                <option value="unavailable">Unavailable</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tableModalEdit" tabindex="-1" aria-labelledby="tableModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tableModalLabel">Edit Table</h5>
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
                    <form id="tableFormEdit" method="POST" action="{{ route('tables.store') }}">
                        @csrf
                        @method('put')
                        @csrf
                        <input type="hidden" id="tableIdEdit" name="table_id">
                        <div class="mb-3">
                            <label for="tableCapacityEdit" class="form-label">Capacity</label>
                            <input type="text" class="form-control" id="tableCapacityEdit" name="capacity" required>
                        </div>
                        <div class="mb-3">
                            <label for="tableStateEdit" class="form-label">State</label>
                            <select class="form-select" id="tableStateEdit" name="state" required>
                                <option value="available">Available</option>
                                <option value="reserved">Reserved</option>
                                <option value="unavailable">Unavailable</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-base-layout>
<script>
    $('.edit-btn').on('click', function() {
        const tableId = $(this).data('id');
       console.log(tableId);
        $.ajax({
            url: '/admin/tables/' + tableId,
            method: 'GET',
            success: function(table) {
                console.log(table);
                $('#tableIdEdit').val(table.table_id);  // Điền ID vào input ẩn
                $('#tableCapacityEdit').val(table.capacity);
                $('#tableStateEdit').val(table.state);

                $('#tableFormEdit').attr('action', '/admin/tables/' + table.table_id);
            },
            error: function() {
                alert("Error fetching user details.");
            }
        });
    });

</script>
