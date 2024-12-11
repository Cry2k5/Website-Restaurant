<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        // Khởi tạo truy vấn để bỏ qua user có id = 1
        $query = User::where('id', '>', 1);

        // Kiểm tra nếu có từ khóa tìm kiếm
        if (isset($request->keyword) && $request->keyword != '') {
            // Tìm kiếm trên tất cả các cột bạn muốn, ví dụ: name, email, phone, address
            $query->where(function ($query) use ($request) {
                $query->orWhere('name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('email', 'like', '%' . $request->keyword . '%')
                    ->orWhere('phone', 'like', '%' . $request->keyword . '%')
                    ->orWhere('address', 'like', '%' . $request->keyword . '%')
                    ->orWhere('role', 'like', '%' . $request->keyword . '%');
            });
        }

        // Thực hiện phân trang kết quả tìm kiếm
        $users = $query->paginate(10);

        // Trả về view với dữ liệu tìm kiếm
        return view('admin.users', ['users' => $users]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'role' => 'required|in:Admin,Staff',
        ]);

        // Mã hóa mật khẩu trước khi lưu
        $data['password'] = Hash::make($request->password);

        User::create($data);

        return redirect()->route('users.index')->with('success', 'User added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return response()->json($user);  // Trả về dữ liệu người dùng dưới dạng JSON
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,User $user)
    {

        // Xác thực dữ liệu từ form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|min:6',
            'role' => 'required|in:Admin,Staff',
        ]);


        // Cập nhật thông tin người dùng
        $user->fill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'role' => $request->input('role'),
        ]);

        // Chỉ cập nhật mật khẩu nếu người dùng nhập
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Lưu thông tin người dùng
        $user->save();

        // Chuyển hướng lại với thông báo thành công
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete(); // $id là đối tượng User được tự động tìm nhờ Route Model Binding

        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }


//

    public function search(Request $request)
    {
        $users = User::where('id','>',1)
            ->paginate(10);
        if(isset($request->keyword)&&$request->keyword != ''){
            $users = User::where(
                'name','like','%'.$request->keyword.'%')->paginate(10);
        }
        return view('admin.users',['users'=>$users]);

    }



}
