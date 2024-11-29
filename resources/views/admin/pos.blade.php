<x-admin-base-layout title="Quản lý bán hàng">
    <div class="container mt-4">
        <h1 class="text-center mb-4">Danh sách bàn</h1>
        <div class="row justify-content-center">
            <div class="d-flex flex-wrap justify-content-center gap-3">
                @foreach($restaurant_tables as $table)
                    <div class="table-card"
                         style="background-color:
                         {{ $table->state == 'unavailable' ? 'rgb(216, 0, 50)' : ($table->state == 'reserved' ? 'rgb(248, 222, 34)' : 'rgb(23, 89, 74)') }};">
                        <a href="#" class="text-decoration-none text-white">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h4>Table {{ $table->table_id }}</h4>
                                <p>Capacity: {{ $table->capacity }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="row d-flex justify-content-around" style="margin-top: 2rem;">
            <div class="col-md-3">
                <div class="alert alert-success text-center" style="background-color: rgb(23, 89, 74); color: white;">
                    Available
                </div>
            </div>
            <div class="col-md-3">
                <div class="alert alert-warning text-center" style="background-color: rgb(248, 222, 34); color: black;">
                    Reserved
                </div>
            </div>
            <div class="col-md-3">
                <div class="alert alert-danger text-center" style="background-color: rgb(216, 0, 50); color: white;">
                    Unavailable
                </div>
            </div>
        </div>
    </div>

    <style>
        .table-card {
            width: 120px;
            height: 120px;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .table-card:hover {
            transform: scale(1.1);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }

        .card-body {
            text-align: center;
        }

        .table-card a {
            display: block;
            height: 100%;
            width: 100%;
            color: white;
        }
    </style>
</x-admin-base-layout>
