<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\SupplierModel;
use App\Models\StokModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class StokController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Stok',
            'list' => ['Home', 'Stok']
        ];
        $page = (object) [
            'title' => 'Daftar Stok yang terdaftar dalam sistem'
        ];
        $activeMenu = 'stok'; // set menu yang sedang aktif

        $supplier = SupplierModel::all(); // ambil data supplier untuk filter supplier
        $barang = BarangModel::all(); // ambil data supplier untuk filter supplier
        $user = UserModel::all(); // ambil data supplier untuk filter supplier
        return view('stok.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'supplier' => $supplier, 'barang' => $barang, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    // Ambil data stok dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $stok = StokModel::select('stok_id', 'supplier_id', 'barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah')
            ->with('supplier')
            ->with('barang')
            ->with('user');

        // filter data stok berdasarkan supplier_id
        if ($request->supplier_id) {
            $stok->where('supplier_id', $request->supplier_id);
        }
        if ($request->barang_id) {
            $stok->where('barang_id', $request->barang_id);
        }
        if ($request->user_id) {
            $stok->where('user_id', $request->user_id);
        }

        return DataTables::of($stok)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
            ->addColumn('aksi', function ($stok) { // menambahkan kolom aksi 
                $btn = '<a href="' . url('/stok/' . $stok->stok_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<button onclick="modalAction(\'' . url('/stok/' . $stok->stok_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/stok/' . $stok->stok_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/stok/' . $stok->stok_id . '/show_ajax') . '\')" class="btn btn-primary btn-sm">Detail Ajax</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
            ->make(true);

        // return DataTables::of($stok)
        //     // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        //     ->addIndexColumn()
        //     ->addColumn('aksi', function ($stok) { // menambahkan kolom aksi
        //         $btn = '<a href="' . url('/stok/' . $stok->stok_id) . '" class="btn btn-info btn-sm">Detail</a> ';
        //         $btn .= '<a href="' . url('/stok/' . $stok->stok_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
        //         $btn .= '<form class="d-inline-block" method="POST" action="' .
        //             url('/stok/' . $stok->stok_id) . '">'
        //             . csrf_field() . method_field('DELETE') .
        //             '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm
        //             (\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
        //         return $btn;
        //     })
        //     ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        //     ->make(true);

    }

    // Menampilkan halaman form tambah stok 
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Stok',
            'list' => ['Home', 'Stok', 'Tambah']
        ];
        $page = (object) [
            'title' => 'Tambah Stok baru'
        ];

        $supplier = SupplierModel::all(); // ambil data supplier untuk filter supplier
        $barang = BarangModel::all(); // ambil data supplier untuk filter supplier
        $user = UserModel::all(); // ambil data supplier untuk filter supplier
        $activeMenu = 'stok'; // set menu yang sedang aktif
        return view('stok.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'supplier' => $supplier, 'barang' => $barang, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function create_ajax()
    {
        $supplier = SupplierModel::select('supplier_id', 'supplier_nama')->get();
        $barang = BarangModel::select('barang_id', 'barang_nama')->get();
        $user = UserModel::select('user_id', 'username')->get();

        return view('stok.create_ajax')
            ->with('supplier', $supplier)
            ->with('barang', $barang)
            ->with('user', $user);
    }

    // Menyimpan data stok baru
    public function store(Request $request)
    {
        $request->validate([
            // stokname harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel m_stok kolom stokname
            'supplier_id'   => 'required|integer',
            'barang_id'     => 'required|integer',
            'user_id'       => 'required|integer',
            'stok_tanggal'  => 'required|date', //nama harus diisi, berupa string, dan maksimal 100 karakter
            'stok_jumlah'    => 'required|integer' //nama harus diisi, berupa string, dan maksimal 100 karakter
        ]);
        StokModel::create([
            'supplier_id'   => $request->supplier_id,
            'barang_id'     => $request->barang_id,
            'user_id'       => $request->user_id,
            'stok_tanggal'  => $request->stok_tanggal,
            'stok_jumlah'   => $request->stok_jumlah
        ]);
        return redirect('/stok')->with('success', 'Data stok berhasil disimpan');
    }

    public function store_ajax(Request $request)
    {
        // Cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'supplier_id'   => 'required|integer',
                'barang_id'     => 'required|integer',
                'user_id'       => 'required|integer',
                'stok_jumlah'   => 'required|integer'
            ];

            // Gunakan Validator
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // Respon JSON, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // Menunjukkan field mana yang error
                ]);
            }

            // Ambil data dari request dan tambahkan stok_tanggal
            $data = $request->all();
            $data['stok_tanggal'] = now(); // Set stok_tanggal ke waktu sekarang

            StokModel::create($data); // Simpan data ke model

            return response()->json([
                'status'    => true,
                'message'   => 'Data stok berhasil disimpan'
            ]);
        }

        return redirect('/'); // Redirect jika bukan ajax
    }


    // Menampilkan detail stok
    public function show(string $id)
    {
        $stok = StokModel::with('supplier')->find($id);
        $breadcrumb = (object) ['title' => 'Detail stok', 'list' => ['Home', 'stok', 'Detail']];
        $page = (object) ['title' => 'Detail stok'];
        $activeMenu = 'stok'; // set menu yang sedang aktif
        return view('stok.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stok' => $stok, 'activeMenu' => $activeMenu]);
    }
    public function show_ajax(string $stok_id){
        $supplier = suppliermodel::all();
        $barang = barangmodel::all();
        $user = barangmodel::all();
        $stok = stokmodel::find($stok_id);
        return view('stok.show_ajax', ['supplier' => $supplier, 'stok' => $stok,'barang'=>$barang,'user'=>$user],);
    }

    // // Menampilkan halaman fore edit stok 
    // public function edit(string $id)
    // {
    //     $stok = StokModel::find($id);
    //     $supplier = SupplierModel::all(); // ambil data supplier untuk filter supplier
    //     $barang = BarangModel::all(); // ambil data supplier untuk filter supplier
    //     $user = UserModel::all(); // ambil data supplier untuk filter supplier

    //     $breadcrumb = (object) [
    //         'title' => 'Edit Stok',
    //         'list' => ['Home', 'Stok', 'Edit']
    //     ];

    //     $page = (object) [
    //         "title" => 'Edit Stok'
    //     ];

    //     $activeMenu = 'stok'; // set menu yang sedang aktif
    //     return view('stok.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stok' => $stok, 'supplier' => $supplier, 'barang' => $barang, 'user' => $user, 'activeMenu' => $activeMenu]);
    // }

    public function edit_ajax(string $id)
    {
        $stok = StokModel::find($id);
        $supplier = SupplierModel::select('supplier_id', 'supplier_nama')->get();
        $barang = BarangModel::select('barang_id', 'barang_nama')->get();
        $user = UserModel::select('user_id', 'username')->get();
        return view('stok.edit_ajax', ['stok' => $stok, 'supplier' => $supplier, 'barang' => $barang, 'user' => $user]);
    }

    // // Menyimpan perubahan data stok
    // public function update(Request $request, string $id)
    // {
    //     $request->validate([
    //         'supplier_id'   => 'required|integer',
    //         'barang_id'     => 'required|integer',
    //         'user_id'       => 'required|integer',
    //         'stok_tanggal'  => 'required|date', //nama harus diisi, berupa string, dan maksimal 100 karakter
    //         'stok_jumlah'   => 'required|integer' //nama harus diisi, berupa string, dan maksimal 100 karakter
    //     ]);
    //     StokModel::find($id)->update([
    //         'supplier_id'   => $request->supplier_id,
    //         'barang_id'     => $request->barang_id,
    //         'user_id'       => $request->user_id,
    //         'stok_tanggal'  => $request->stok_tanggal,
    //         'stok_jumlah'   => $request->stok_jumlah
    //     ]);
    //     return redirect('/stok')->with("success", "Data stok berhasil diubah");
    // }

    public function update_ajax(Request $request, $id)
    {
        // Cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'supplier_id'   => 'required|integer',
                'barang_id'     => 'required|integer',
                'user_id'       => 'required|integer',
                'stok_jumlah'   => 'required|integer'
            ];

            // Gunakan Validator
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // Respon JSON, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // Menunjukkan field mana yang error
                ]);
            }

            $check = StokModel::find($id);
            if ($check) {
                // Set stok_tanggal ke waktu sekarang
                $data = $request->all();
                $data['stok_tanggal'] = now(); // Set stok_tanggal ke waktu sekarang

                $check->update($data); // Update data stok

                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/'); // Redirect jika bukan ajax
    }


    public function confirm_ajax(string $id)
    {
        $stok = StokModel::find($id);
        return view('stok.confirm_ajax', ['stok' => $stok]);
    }

    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $stok = StokModel::find($id);
            if ($stok) {
                $stok->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    // // Menghapus data stok 
    // public function destroy(string $id)
    // {
    //     $check = StokModel::find($id);
    //     if (!$check) {      // untuk mengecek apakah data stok dengan id yang dimaksud ada atau tidak
    //         return redirect('/stok')->with('error', 'Data stok tidak ditemukan');
    //     }

    //     try {
    //         StokModel::destroy($id); // Hapus data supplier
    //         return redirect('/stok')->with('success', 'Data stokstok berhasil dihapus');
    //     } catch (\Illuminate\Database\QueryException $e) {
    //         // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error

    //         return redirect('/stok')->with('error', 'Data stok gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
    //     }
    // }

    public function import()
    {
        return view('stok.import');
    }

    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'file_stok' => ['required', 'mimes:xlsx', 'max:1024']
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $file = $request->file('file_stok');
            $reader = IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray(null, false, true, true);

            $insert = [];

            if (count($data) > 1) {
                foreach ($data as $baris => $value) {
                    if ($baris > 1) {
                        // Convert stok_tanggal to date 
                        $stok_tanggal = Date::excelToDateTimeObject($value['D'])->format('Y-m-d');

                        $stok_tanggal_with_time = now()->format('Y-m-d') . ' ' . now()->format('H:i:s'); // Tanggal saat ini dengan waktu saat ini

                        $insert[] = [
                            'supplier_id' => $value['A'],
                            'barang_id' => $value['B'],
                            'user_id' => $value['C'],
                            'stok_tanggal' => $stok_tanggal_with_time, // Simpan dengan waktu sekarang
                            'stok_jumlah' => $value['E'],
                            'created_at' => now(),
                        ];
                    }
                }

                if (count($insert) > 0) {
                    StokModel::insertOrIgnore($insert);
                }
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diimport'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak ada data yang diimport'
                ]);
            }
        }
        return redirect('/');
    }
    public function export_excel()
    {
        // Ambil data stok yang akan diekspor
        $stok = StokModel::select('supplier_id', 'barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah')->get();

        // Load library excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet(); // Ambil sheet yang aktif

        // Set header untuk tabel
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Supplier ID');
        $sheet->setCellValue('C1', 'Barang ID');
        $sheet->setCellValue('D1', 'User ID');
        $sheet->setCellValue('E1', 'Stok Tanggal');
        $sheet->setCellValue('F1', 'Stok Jumlah');

        $sheet->getStyle('A1:F1')->getFont()->setBold(true); // Bold header
        $no = 1;  // Nomor data dimulai dari 1
        $baris = 2; // Baris data dimulai dari baris ke 2

        foreach ($stok as $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->supplier_id);
            $sheet->setCellValue('C' . $baris, $value->barang_id);
            $sheet->setCellValue('D' . $baris, $value->user_id);
            $sheet->setCellValue('E' . $baris, $value->stok_tanggal); // Pastikan ini dalam format yang tepat
            $sheet->setCellValue('F' . $baris, $value->stok_jumlah);
            $baris++;
            $no++;
        }

        // Set auto size untuk kolom
        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $sheet->setTitle('Data Stok'); // Set title sheet

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Stok ' . date('Y-m-d H:i:s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');

        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');

        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer->save('php://output');
        exit;
    }

    public function export_pdf()
    {
        $stok = StokModel::select('supplier_id', 'barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah')
            ->get();

        // use Barryvdh\DomPDF\Facade\Pdf;
        $pdf = Pdf::loadView('stok.export_pdf', ['stok' => $stok]);

        $pdf->setPaper('a4', 'portrait'); // set ukuran kertas dan orientasi
        $pdf->setOption("isRemoteEnabled", true); // set true jika ada gambar dari url
        $pdf->render();

        return $pdf->stream('Data stok ' . date('Y-m-d H:i:s') . '.pdf');
    }
}