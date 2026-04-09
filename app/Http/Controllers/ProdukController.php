<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        return view('produk.index');
    }

    // ✅ FIX DI SINI
    public function getData()
    {
        return response()->json([
            'data' => Produk::all()
        ]);
    }

    public function store(Request $request)
    {
        Produk::updateOrCreate(
            ['id' => $request->id],
            [
                'nama' => $request->nama,
                'harga' => $request->harga,
                'stok' => $request->stok
            ]
        );

        return response()->json(['status' => 'success']);
    }

    public function edit($id)
    {
        return response()->json(Produk::find($id));
    }

    public function destroy($id)
    {
        Produk::destroy($id);
        return response()->json(['status' => 'deleted']);
    }
}