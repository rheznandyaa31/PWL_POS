<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    // Menampilkan halaman awal level
    public function index() { 
        $breadcrumb = (object)[
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];

        $page = (object)[
            'title' => 'Daftar level yang terdaftar dalam sistem'
        ];

        $activeMenu = 'level'; //set menu yang sedang aktif

        return view('level.index',['breadcrumb'=>$breadcrumb, 'page' => $page, 'activeMenu'=>$activeMenu]);
    }

    //Ambil data level dalam bentuk json untuk datables
    public function list(Request $request) {
        $levels = LevelModel::select('level_id', 'level_kode', 'level_nama');

        return DataTables::of($levels)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
            ->addIndexColumn()
            ->addColumn('aksi', function ($level) {  // menambahkan kolom aksi 
                $btn  = '<a href="' . url('/level/' . $level->level_id) . '" class="btn btn-info btn sm">Detail</a> ';
                /* $btn  = '<a href="' . url('/level/' . $level->level_id) . '" class="btn btn-info btn sm">Detail</a> ';
                $btn .= '<a href="' . url('/level/' . $level->level_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/level/' . $level->level_id) . '">'
                    . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                    . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>'; */
                $btn = '<button onclick="modalAction(\''.url('/level/' . $level->level_id . 
                '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/level/' . $level->level_id . 
                '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/level/' . $level->level_id . 
                '/confirm_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
            ->make(true);
    }

    // Menampilkan halaman form tambah level
    public function create() {
        $breadcrumb = (object) [
            'title' => 'Tambah Level',
            'list' => ['Home', ' Level', 'Tambah'],
        ];

        $page = (object) [
            'title' => 'Tambah Level baru'
        ];

        $activeMenu = 'level'; // set menu yang sedang aktif

        return view('level.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan data level baru
    public function store(Request $request) {
        $request->validate([
            // level_kode harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel m_level kolom level_kode
            'level_kode'    => 'required|string|min:2|max:10|unique:m_level,level_kode',
            'level_nama'    => 'required|string|max:100',   // level_nama harus diisi, berupa string, dan maksimal 100 karakter
        ]);

        LevelModel::create([
            'level_kode'    => $request->level_kode,
            'level_nama'    => $request->level_nama,
        ]);

        return redirect('/level')->with('success', 'Data level berhasil disimpan');
    }

    // Menampilkan detail level
    public function show(String $id) {
        $level = LevelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Level',
            'list' => ['Home', ' Level', 'Detail'],
        ];

        $page = (object) [
            'title' => 'Detail level'
        ];

        $activeMenu = 'level'; // set menu yang sedang aktif

        return view('level.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // Menampilkan halaman form edit level
    public function edit(String $id) {
        $level = LevelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Level',
            'list' => ['Home', ' Level', 'Edit'],
        ];

        $page = (object) [
            'title' => 'Edit level'
        ];

        $activeMenu = 'level'; // set menu yang sedang aktif

        return view('level.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }


    // Menyimpan perubahan data level
    public function update(Request $request, String $id) {
        $request->validate([
            // level_kode harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel m_level kolom level_kode kecuali untuk level dengan id yang sedang diedit
            'level_kode'    => 'required|string|min:2|max:10|unique:m_level,level_kode,'.$id.',level_id',
            'level_nama'    => 'required|string|max:100',   // level_nama harus diisi, berupa string, dan maksimal 100 karakter
        ]);

        LevelModel::find($id)->update([
            'level_kode'    => $request->level_kode,
            'level_nama'    => $request->level_nama,
        ]);

        return redirect('/level')->with('success', 'Data level berhasil diubah');
    }

    // Menghapus data level
    public function destroy(String $id) {
        $check = LevelModel::find($id);
        if(!$check) {   // untuk mengecek apakah data level dengan id yang dimaksud ada atau tidak
            return redirect('/level')->with('error', 'Data level tidak ditemukan');
        }

        try{
            LevelModel::destroy($id);    // Hapus data level

            return redirect('/level')->with('success', 'Data level berhasil dihapus');
        }catch (\Illuminate\Database\QueryException $e){
            // Jika terjadi error ketika menghapus data, redirect kembali kehalaman dengan membawa pesan error
            return redirect('/level')->with('error', 'Data level gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
    // Menampilkan halaman form tambah level ajax
    public function create_ajax() {
        return view('level.create_ajax');
    }
    // Menyimpan data level baru ajax
    public function store_ajax(Request $request){
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_kode'  => 'required|string|min:3|unique:m_level,level_kode',
                'level_nama'      => 'required|string|max:100'
            ];
            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,  // response status , false: error/gagal, true: berhasil
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(), // pesan error validasi
                ]);
            }
            LevelModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data level berhasil disimpan'
            ]);
        }
        redirect('/');
    }
    // Menampilkan detail level ajax
    public function show_ajax(String $id) {
        $level = LevelModel::find($id);
    
        return view('level.show_ajax', ['level' => $level]);
    }
    // Menampilkan halaman form edit level ajax
    public function edit_ajax(String $id) {
        $level = LevelModel::find($id);
        return view('level.edit_ajax', ['level' => $level]);
    }
    
    // Menyimpan perubahan data level ajax
    public function update_ajax(Request $request, $id){
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_kode'  => 'required|string|min:3|unique:m_level,level_kode',
                'level_nama'      => 'required|string|max:100'
            ];
            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // respon json, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // menunjukkan field mana yang error
                ]);
            }
            $check = LevelModel::find($id);
            if ($check) {
                if(!$request->filled('password') ){ // jika password tidak diisi, maka hapus dari request
                    $request->request->remove('password');
                }
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else{
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }
    // Menampilkan hapus data level ajax
    public function confirm_ajax(string $id) {
        $level = LevelModel::find($id);
        
        return view('level.confirm_ajax', ['level' => $level]);
    }
    // Menghapus data level ajax
    public function delete_ajax(Request $request, $id) {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $level = LevelModel::find($id);
            if ($level) {
                $level->delete();
                return response()->json([
                    'status'    => true,
                    'message'   => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }
}