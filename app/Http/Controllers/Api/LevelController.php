<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LevelModel;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /**
     * Menampilkan daftar resource.
     */
    public function index()
    {
        return LevelModel::all();
    }

    /**
     * Menyimpan resource baru ke dalam storage.
     */
    public function store(Request $request)
    {
        $level = LevelModel::create($request->all());
        return response()->json($level, 201);
    }

    /**
     * Menampilkan resource yang ditentukan.
     */
    public function show(LevelModel $level)
    {
        return $level;
    }

    /**
     * Memperbarui resource yang ditentukan di dalam storage.
     */
    public function update(Request $request, LevelModel $level)
    {
        $level->update($request->all());
        return $level;
    }

    /**
     * Menghapus resource yang ditentukan dari storage.
     */
    public function destroy(LevelModel $level)
    {
        $level->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Terhapus',
        ]);
    }
}
