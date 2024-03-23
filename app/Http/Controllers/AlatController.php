<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlatController extends Controller
{
    protected $alatModel;

    public function __construct() {
        $this->alatModel = new Alat();
    }

    public function index() {
        $alat = $this->alatModel->get_alat();

        if(count($alat) === 0){
            return response()->json([
                'msg'=>"Data alat masih kosong!",
                'data'=>$alat
            ],204);
        } else {
            return response()->json([
                'data'=>$alat
            ],200);
        }
    }

    public function show() {

    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'alat_kategori_id'=> 'required|int',
            'alat_nama'=> 'required|string|max:150',
            'alat_deskripsi'=> 'required|string|max:255',
            'alat_hargaperhari'=> 'required|int',
            'alat_stok'=> 'required|int',
        ]);

        if($validator->fails()) {
            return response()->json([
                'msg'=> 'Gagal menambahkan data alat',
                'errors'=> $validator->errors()
            ],422);
        } else {
            $alat = $this->alatModel->create_alat($validator->validated());

            return response()->json([
                'msg' => 'Berhasil menambahkan data alat',
                'data' => $alat
            ],201);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all, [
            'alat_kategori_id'=> 'required|int',
            'alat_nama'=> 'required|string|max:150',
            'alat_deskripsi'=> 'required|string|max:255',
            'alat_hargaperhari'=> 'required|int',
            'alat_stok'=> 'required|int',
        ]);

        if($validator->fails()) {
            return response()->json([
                'msg'=> 'Gagal mengubah data kategori',
                'errors'=> $validator->errors()
            ],422);
        } else {
            $alat = $this->alatModel->update_alat($validator->validated(), $id);

            return response()->json([
                'msg'=> 'Berhasil mengubah data alat',
                'data'=> $alat
            ],200);
        }
    }

    public function destroy($id)
    {
        $alat = $this->alatModel->delete_alat($id);

        if(!$alat) {
            return response()->json([
                'msg' => 'Gagal menghapus data alat',
                'errors' => 'Data tidak ditemukan'
            ],404);
        } else {
            return response()->json([
                'msg'=> 'Berhasil menghapus data alat',
                'data'=> $alat
            ],200);
        }
    }
}
