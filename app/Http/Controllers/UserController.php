<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ลงทะเบียนผู้ใช้
    // public function register(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:8|confirmed',
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     return response()->json(['message' => 'User registered successfully!', 'user' => $user], 201);
    // }

    // ดึงข้อมูลผู้ใช้ทั้งหมด
    public function index()
    {
        $data = User::all();
        return response()->json($data);
        // return response()->json(User::all());
    }

    // ดึงข้อมูลผู้ใช้ตาม ID
    public function show($id)
    {
        return response()->json(User::findOrFail($id));
    }

    // อัปเดตข้อมูลผู้ใช้
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        // $user->update($request->all());
        return new UserResource($user);

        // return response()->json(['message' => 'User updated successfully!', 'user' => $user]);
    }

    // ลบผู้ใช้
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(['message' => 'User deleted successfully!']);
    }
}
