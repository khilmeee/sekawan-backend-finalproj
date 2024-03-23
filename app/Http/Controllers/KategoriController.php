<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    protected $kategoriModel;

    public function __construct(){
        $this->kategoriModel = new Kategori();
    }

    public function index()
    {
        $kategoris = $this->kategoriModel->get_kategori();

        if(count($kategoris) === 0){
            return response()->json([
                'msg'=>"Data kategori masih kosong!",
                'data'=>$kategoris
            ],204);
        } else {
            return response()->json([
                'data'=>$kategoris
            ],200);
        }
    }

    public function show($id)
    {

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'kategori_nama'=> 'required|string|max:100'
        ]);

        if($validator->fails()) {
            return response()->json([
                'msg'=> 'Gagal menambahkan data kategori',
                'errors'=> $validator->errors()
            ],422);
        } else {
            $kategori = $this->kategoriModel->create_kategori($validator->validated());

            return response()->json([
                'msg' => 'Berhasil menambahkan data kategori',
                'data' => $kategori
            ],201);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all, [
            'kategori_nama'=> 'required|string|max:100'
        ]);

        if($validator->fails()) {
            return response()->json([
                'msg'=> 'Gagal mengubah data kategori',
                'errors'=> $validator->errors()
            ],422);
        } else {
            $kategori = $this->kategoriModel->update_kategori($validator->validated(), $id);

            return response()->json([
                'msg'=> 'Berhasil mengubah data kategori',
                'data'=> $kategori
            ],200);
        }
    }

    public function destroy($id)
    {
        $kategori = $this->kategoriModel->delete_kategori($id);

        if(!$kategori) {
            return response()->json([
                'msg' => 'Gagal menghapus data kategori',
                'errors' => 'Data tidak ditemukan'
            ],404);
        } else {
            return response()->json([
                'msg'=> 'Berhasil menghapus data kategori',
                'data'=> $kategori
            ],200);
        }
    }
}
