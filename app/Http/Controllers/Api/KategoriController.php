<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriModel;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
        return response()->json(KategoriModel::all(), 200);
    }

    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'kategori_kode' => 'required|min:3',
            'kategori_nama' => 'required',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Menyimpan data jika validasi berhasil
        $kategori = KategoriModel::create($request->all());

        return response()->json([
            'success' => true,
            'kategori' => $kategori
        ], 201);
    }

    public function show(KategoriModel $kategori)
    {
        // Menampilkan data kategori
        return response()->json([
            'success' => true,
            'kategori' => $kategori
        ], 200);
    }

    public function update(Request $request, KategoriModel $kategori)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'kategori_kode' => 'required|min:3',
            'kategori_nama' => 'required',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Mengupdate data jika validasi berhasil
        $kategori->update($request->all());

        return response()->json([
            'success' => true,
            'kategori' => $kategori
        ], 200);
    }

    public function destroy(KategoriModel $kategori)
{
    // Menghapus data kategori
    $kategori->delete();

    // Mengembalikan respons JSON setelah penghapusan berhasil
    return response()->json([
        'success' => true,
        'message' => 'Data Terhapus'
    ], 200);
}
    }
{}
