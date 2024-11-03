<?php

namespace App\Http\Controllers\Api;

use App\Models\UserModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        // Validasi request termasuk konfirmasi password
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'password' => 'required|string|min:5|confirmed',
            'level_id' => 'required|integer',
            'avatar' => 'nullable|string',
        ]);

        // Jika validasi gagal, kembalikan respons error
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Membuat user baru jika validasi berhasil
        $m_user = UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->password), // Enkripsi password sebelum disimpan
            'level_id' => $request->level_id,
            'avatar' => $request->avatar ?? 'default_avatar.jpg', // Set avatar default jika null
        ]);

        // Jika user berhasil dibuat, kembalikan respons sukses
        if ($m_user) {
            return response()->json([
                'success' => true,
                'm_user' => [
                    'username' => $m_user->username,
                    'nama' => $m_user->nama,
                    'password' => $m_user->password, // Menampilkan hash password
                    'level_id' => (string) $m_user->level_id,
                    'updated_at' => $m_user->updated_at->toIso8601String(),
                    'created_at' => $m_user->created_at->toIso8601String(),
                    'user_id' => $m_user->user_id,
                ]
            ], 201);
        }

        // Mengembalikan respons jika pembuatan user gagal
        return response()->json([
            'success' => false,
            'message' => 'Failed to create user'
        ], 409);
    }
}
