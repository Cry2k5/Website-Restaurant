<?php

namespace App\Http\Controllers;
use App\Models\RestaurantTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TableController extends Controller
{

    public function posIndex()
    {

        $tables = RestaurantTable::all();

        return view('admin.pos',['restaurant_tables'=>$tables]);
    }

    public function index()
    {

        $tables = RestaurantTable::paginate(10);

        return view('admin.tables',['restaurant_tables'=>$tables]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tables');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'capacity' => 'required|string',
            'state' => 'required|in:available,reserved,unavailable',
        ]);

        // Mã hóa mật khẩu trước khi lưu

        RestaurantTable::create($data);

        return redirect()->route('tables.index')->with('success', 'Table added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(RestaurantTable $table)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RestaurantTable $table_id)
    {
        return response()->json($table_id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,RestaurantTable $table_id)
    {

        // Xác thực dữ liệu từ form
        $request->validate([
            'capacity' => 'required|string',
            'state' => 'required|in:available,reserved,unavailable',
        ]);

        // Cập nhật thông tin người dùng
        $table_id->fill([
            'capacity' => $request->input('capacity'),
            'state' => $request->input('state'),
        ]);

        $table_id->save();

        // Chuyển hướng lại với thông báo thành công
        return redirect()->route('tables.index')->with('success', 'Table updated successfully!');
    }

}
