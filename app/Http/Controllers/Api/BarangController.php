<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage; // Import Storage facade

class BarangController extends Controller
{
    public function index()
    {
        return BarangModel::all();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required',
            'barang_kode' => 'required',
            'barang_nama' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'transaksi' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Add validation for transaksi
        ]);

        // Return validation errors
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Handle file upload
        if ($request->hasFile('transaksi')) {
            $file = $request->file('transaksi');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/posts', $filename);
        }

        // Create new entry with transaksi
        $barang = BarangModel::create([
            'kategori_id' => $request->kategori_id,
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'transaksi' => $filename, // Update the model with transaksi filename
        ]);

        // Return success response
        if ($barang) {
            return response()->json([
                'success' => true,
                'barang' => $barang,
            ], 201);
        }

        return response()->json(['success' => false], 409);
    }

    public function show(BarangModel $barang)
    {
        return response()->json($barang);
    }
    
    public function destroy(BarangModel $barang)
    {
        // Delete transaksi from storage
        if($barang->transaksi) {
            Storage::delete('public/posts/'.$barang->transaksi);
        }

        $barang->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data terhapus'
        ]);
    }public function update(Request $request, BarangModel $barang)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'nullable',
            'barang_kode' => 'nullable',
            'barang_nama' => 'nullable',
            'harga_beli' => 'nullable',
            'harga_jual' => 'nullable',
            'transaksi' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Make transaksi nullable
        ]);
    
        // Return validation errors
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        // Handle file upload
        if ($request->hasFile('transaksi')) {
            // Delete old file if exists
            if ($barang->transaksi) {
                Storage::delete('public/posts/' . $barang->transaksi);
            }
    
            $file = $request->file('transaksi');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/posts', $filename);
            $barang->transaksi = $filename; // Update transaksi
        }
    
        // Update the model with provided fields
        $barang->update($request->only([
            'kategori_id',
            'barang_kode',
            'barang_nama',
            'harga_beli',
            'harga_jual',
            'transaksi'
        ]));
    
        // Return success response
        return response()->json([
            'success' => true,
            'barang' => $barang,
        ]);
    }
    
    
    public function __invoke(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required',
            'barang_kode' => 'required',
            'barang_nama' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'transaksi' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Add validation for transaksi
        ]);

        // Return validation errors
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Handle file upload
        if ($request->hasFile('transaksi')) {
            $file = $request->file('transaksi');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/posts', $filename);
        }

        // Create new entry with transaksi
        $barang = BarangModel::create([
            'kategori_id' => $request->kategori_id,
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'transaksi' => $filename, // Update the model with transaksi filename
        ]);

        // Return success response
        if ($barang) {
            return response()->json([
                'success' => true,
                'barang' => $barang,
            ], 201);
        }

        return response()->json(['success' => false], 409);
    }
}
