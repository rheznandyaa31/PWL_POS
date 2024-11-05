<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangModel;

class BarangController extends Controller
{
    public function index()
    {
        return response()->json(BarangModel::all(), 200);
    }

    public function store(Request $request)
    {
        // Tambahkan validasi
        $request->validate([
            'barang_kode' => 'required|string|max:255',
            'barang_nama' => 'required|string|max:255',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            // Tambahkan aturan validasi lain sesuai kebutuhan
        ]);

        $barang = BarangModel::create($request->all());
        return response()->json($barang, 201);
    }

    public function show(BarangModel $barang)
    {
        return response()->json($barang, 200);
    }

    public function update(Request $request, BarangModel $barang)
    {
        // Tambahkan validasi
        $request->validate([
            'barang_kode' => 'sometimes|required|string|max:255',
            'barang_nama' => 'sometimes|required|string|max:255',
            'harga_beli' => 'sometimes|required|numeric',
            'harga_jual' => 'sometimes|required|numeric',
            // Tambahkan aturan validasi lain sesuai kebutuhan
        ]);

        $barang->update($request->all());
        return response()->json($barang, 200);
    }

    public function destroy(BarangModel $barang)
    {
        $barang->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data terhapus',
        ], 200);
    }
}
