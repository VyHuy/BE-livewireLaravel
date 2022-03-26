<?php

namespace App\Http\Controllers;

use App\Models\ProductManage;
use Illuminate\Http\Request;

class ListProduct extends Controller
{
    public function edit($id)
    {
        $p = ProductManage::find($id);
        if ($p) {
            return response()->json([
                $p
            ]);
        }
    }
    public function updateProduct(Request $req, $id)
    {
        $up = ProductManage::find($req->id);
        $up->update([
            'title'       => $req->title,
            'description' => $req->description,
            'img'         => $req->img->store('bota-product','public'),
            'price'       => $req->price,
            'user_id'     => 16,
        ]);
        return response()->json([
            $req->title,
            $req->description,
            $req->img->store('bota-product','public'),
            $req->price
        ]);
    }
    public function addProduct(Request $req)
    {

        $req = ProductManage::create([
            'title'       => $req->title,
            'description' => $req->description,
            'img'         => $req->img->store('bota-product','public'),
            'price'       => $req->price,
            'user_id'     => 12,
        ]);
        return response()->json([
            $req->title,
            $req->description,
            $req->img,
            $req->price
        ]);

    }
    public function deleteProduct(Request $req, $id){
        $del = ProductManage::find($req->id);
        $del->delete();
    }
    function list() {
        return ProductManage::all();
    }
}
