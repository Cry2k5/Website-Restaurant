<x-app-layout title="Reservation">
    <!-- Sidebar -->
    <x-menu-sidebar></x-menu-sidebar>
    <!-- Title Page -->
    <section class="bg-title-page flex-c-m p-t-160 p-b-80 p-l-15 p-r-15" style="background-image: url(images/bg-title-page-02.jpg);">
        <h2 class="tit6 t-center">
            Reservation
        </h2>
    </section>

    <!-- Reservation -->
    <section class="section-reservation bg1-pattern p-t-100 p-b-113">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 p-b-30">
                    <div class="t-center">
                        <span class="tit2 t-center">
                            Reservation
                        </span>

                        <h3 class="tit3 t-center m-b-35 m-t-2">
                            Book table
                        </h3>
                    </div>
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <form action="{{ route('home.reservations.store') }}" method="POST" class="wrap-form-reservation size22 m-l-r-auto">
                        @csrf
                        <div class="column">
                            <!-- Date -->
                            <div>
                                <span class="txt9">Date</span>
                                <div class="wrap-inputdate pos-relative txt10 size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class=" bo-rad-10 sizefull txt10 p-l-20" type="date" name="reservation_date" required>
{{--                                    <i class="btn-calendar fa fa-calendar ab-r-m hov-pointer m-r-18" aria-hidden="true"></i>--}}
                                </div>
                            </div>

                            <!-- Table -->
                            <div>
                                <span class="txt9">Table</span>
                                <div class="wrap-inputtime size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <select class="selection-1" name="table_id" required>
                                        @foreach ($tables as $table)
                                            <option value="{{ $table->table_id }}">
                                                For {{ $table->capacity }} people (Table ID: {{ $table->table_id }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Time -->
                            <div>
                                <span class="txt9">Time</span>
                                <div class="wrap-inputtime size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <select class="selection-1" name="reservation_time" required>
                                        <option value="09:00">9:00</option>
                                        <option value="10:30">10:30</option>
                                        <option value="12:00">12:00</option>
                                        <option value="13:30">13:30</option>
                                        <option value="15:00">15:00</option>
                                        <option value="16:30">16:30</option>
                                        <option value="18:00">18:00</option>
                                        <option value="19:30">19:30</option>
                                        <option value="21:00">21:00</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="column">
                            <!-- Name -->
                            <div>
                                <span class="txt9">Name</span>
                                <div class="wrap-inputname size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class="bo-rad-10 sizefull txt10 p-l-20" type="text" name="customer_name" placeholder="Name" required>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div>
                                <span class="txt9">Phone</span>
                                <div class="wrap-inputphone size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class="bo-rad-10 sizefull txt10 p-l-20" type="text" name="customer_phone" placeholder="Phone" required>
                                </div>
                            </div>

                            <!-- Email -->
                            <div>
                                <span class="txt9">Email</span>
                                <div class="wrap-inputemail size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class="bo-rad-10 sizefull txt10 p-l-20" type="email" name="customer_email" placeholder="Email">
                                </div>
                            </div>

                            <!-- Description -->
                            <div>
                                <span class="txt9">Description</span>
                                <div class="wrap-inputemail size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class="bo-rad-10 sizefull txt10 p-l-20" type="text" name="description" placeholder="Additional details">
                                </div>
                            </div>
                        </div>

                        <div class="wrap-btn-booking flex-c-m m-t-6">
                            <button type="submit" class="btn3 flex-c-m size13 txt11 trans-0-4">
                                Book Table
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>

