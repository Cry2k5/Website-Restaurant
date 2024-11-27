<?php

namespace App\Http\Controllers;

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

    public function index()
    {

        $users = User::where('id','>',1)
        ->paginate(10);

        return view('admin.user',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user');  // Hiển thị form thêm người dùng
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
        $data['password'] = Crypt::encrypt($request->password);

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
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'role' => 'required|in:Admin,Staff',
        ]);

        // Nếu có thay đổi mật khẩu, mã hóa lại mật khẩu
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

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


    public function search(Request $request)
    {
        $search = $request->input('search');

        $users = User::when($search, function ($query, $search) {
            return $query->where('id', '>', 1)
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('role', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            });
        })
            ->paginate(10);

        // Trả về kết quả dưới dạng JSON để cập nhật bảng
        return response()->json([
            'users' => $users
        ]);
    }



}
