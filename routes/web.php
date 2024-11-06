<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\DetailController;
use Illuminate\Support\Facades\Route;


Route::pattern('id', '[0-9]+');

Route::get('/', [LandingController::class, 'index']);

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'store']);

// Keep this route to point to the WelcomeController

// Route::resource('level', LevelController::class);

Route::middleware('auth')->group(function () {
    Route::get('/welcome', [WelcomeController::class, 'index']);
});

Route::group(['prefix' =>'profile','middleware'=>'authorize:ADM,MNG,STF,CUS'],function(){
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/{id}', [ProfileController::class, 'update'])->name('profile.update');

});

Route::group(['prefix' => 'user', 'middleware'=>'authorize:ADM'], function() {
    Route::get('/', [UserController::class, 'index']);          // menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']);      // menampilkan data user dalam json untuk datables
    Route::get('/create', [UserController::class, 'create']);   // menampilkan halaman form tambah user
    Route::post('/', [UserController::class,'store']);          // menyimpan data user baru
    Route::get('/create_ajax', [UserController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
    Route::post('/ajax', [UserController::class, 'store_ajax']); // Menampilkan data user baru Ajax
    Route::get('/{id}', [UserController::class, 'show']);       // menampilkan detail user
    Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']);
    Route::get('/{id}/edit', [UserController::class, 'edit']);  // menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']);     // menyimpan perubahan data user
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // Menampilkan halaman form edit user Ajax
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // Menyimpan perubahan data user Ajax
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete user Ajax
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // Untuk hapus data user Ajax
    Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
    Route::get('/import', [UserController::class, 'import']); // ajax form upload excel
    Route::post('/import_ajax', [UserController::class, 'import_ajax']); // ajax import excel
    Route::get('/export_excel',[usercontroller::class,'export_excel']); // ajax export excel
    Route::get('/export_pdf',[usercontroller::class,'export_pdf']); //ajax export pdf
});

 // Route::group(['prefix' => 'level'], function () {
    Route::middleware(['authorize:ADM'])->group(function () {
        Route::get('/level', [LevelController::class, 'index']); // menampilkan halaman awal level
        Route::post('/level/list', [LevelController::class, 'list']); // menampilkan data level dalam bentuk json untuk datatables
        Route::get('/level/create', [LevelController::class, 'create']); // menampilkan halaman form tambah level
        Route::post('/level', [LevelController::class, 'store']); // menyimpan data level baru
        Route::get('/level/create_ajax', [LevelController::class, 'create_ajax']); // menampilkan halaman form tambah level Ajax
        Route::post('/level/ajax', [LevelController::class, 'store_ajax']); // menyimpan data level baru Ajax
        Route::get('/level/{id}', [LevelController::class, 'show']); // menampilkan detail level
        Route::get('/level/{id}/edit', [LevelController::class, 'edit']); // menampilkan halaman form edit level
        Route::get('/level/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); // menampilkan halaman form edit level Ajax
        Route::put('/level/{id}', [LevelController::class, 'update']); // menyimpan perubahan data level
        Route::put('/level/{id}/update_ajax', [LevelController::class, 'update_ajax']); // menyimpan perubahan data level Ajax
        Route::get('/level/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // untuk tampilkan form confirm delete level Ajax
        Route::delete('/level/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // untuk hapus data level Ajax 
        Route::delete('/level/{id}', [LevelController::class, 'destroy']); // menghapus data level

        Route::get('/level/import', [LevelController::class, 'import']); // ajax form upload excel
        Route::post('/level/import_ajax', [LevelController::class, 'import_ajax']); // ajax import excel
        Route::get('/level/export_excel', [LevelController::class, 'export_excel']); // export excel
        Route::get('/level/export_pdf', [LevelController::class, 'export_pdf']); // export pdf
    });
// Route::group(['prefix' => 'kategori'], function () {
    Route::middleware(['authorize:ADM,MNG'])->group(function () {
        Route::get('/kategori', [KategoriController::class, 'index']); // menampilkan halaman awal kategori
        Route::post('/kategori/list', [KategoriController::class, 'list']); // menampilkan data kategori dalam bentuk json untuk datatables
        Route::get('/kategori/create', [KategoriController::class, 'create']); // menampilkan halaman form tambah kategori
        Route::post('/kategori', [KategoriController::class, 'store']); // menyimpan data kategori baru
        Route::get('/kategori/create_ajax', [KategoriController::class, 'create_ajax']); // menampilkan halaman form tambah kategori Ajax
        Route::post('/kategori/ajax', [KategoriController::class, 'store_ajax']); // menyimpan data kategori baru Ajax
        Route::get('/kategori/{id}', [KategoriController::class, 'show']); // menampilkan detail kategori
        Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit']); // menampilkan halaman form edit kategori
        Route::get('/kategori/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); // menampilkan halaman form edit kategori Ajax
        Route::put('/kategori/{id}', [KategoriController::class, 'update']); // menyimpan perubahan data kategori
        Route::put('/kategori/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // menyimpan perubahan data kategori Ajax
        Route::get('/kategori/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); // untuk tampilkan form confirm delete kategori Ajax
        Route::delete('/kategori/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // untuk hapus data kategori Ajax 
        Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']); // menghapus data kategori

        Route::get('/kategori/import', [KategoriController::class, 'import']); // ajax form upload excel
        Route::post('/kategori/import_ajax', [KategoriController::class, 'import_ajax']); // ajax import excel
        Route::get('/kategori/export_excel', [KategoriController::class, 'export_excel']); // export excel
        Route::get('/kategori/export_pdf', [KategoriController::class, 'export_pdf']); // export pdf
    });
// Route::group(['prefix' => 'barang'], function () {
    Route::middleware(['authorize:ADM,MNG,STF,CUS'])->group(function () {
        Route::get('/barang', [BarangController::class, 'index']);
        Route::post('/barang/list', [BarangController::class, 'list']);
        Route::get('/barang/create', [BarangController::class, 'create']);
        Route::post('/barang', [BarangController::class, 'store']);
        Route::get('/barang/create_ajax', [BarangController::class, 'create_ajax']);
        Route::post('/barang/ajax', [BarangController::class, 'store_ajax']);
        Route::get('/barang/{id}', [BarangController::class, 'show']);
        Route::get('/barang/{id}/edit', [BarangController::class, 'edit']);
        Route::put('/barang/{id}', [BarangController::class, 'update']);
        Route::put('/barang/{id}/update_ajax', [BarangController::class, 'update_ajax']);
        Route::get('/barang/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);
        Route::delete('/barang/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);
        Route::delete('/barang/{id}', [BarangController::class, 'destroy']);
        Route::get('/barang/import', [BarangController::class, 'import']); // ajax form upload excel
        Route::post('/barang/import_ajax', [BarangController::class, 'import_ajax']); // ajax import excel
        Route::get('/barang/export_excel', [BarangController::class, 'export_excel']); // export excel
        Route::get('/barang/export_pdf', [BarangController::class, 'export_pdf']); // export excel
    });
Route::group(['prefix' =>'supplier', 'middleware'=>'authorize:ADM,MNG,STF'],function(){
    Route::get('/', [SupplierController::class, 'index']);          // menampilkan halaman awal supplier
    Route::post('/list', [SupplierController::class, 'list']);      // menampilkan data supplier dalam json untuk datables
    Route::get('/create', [SupplierController::class, 'create']);   // menampilkan halaman form tambah supplier
    Route::post('/', [SupplierController::class,'store']);          // menyimpan data supplier baru
    Route::get('/create_ajax', [SupplierController::class, 'create_ajax']); // Menampilkan halaman form tambah supplier Ajax
    Route::post('/ajax', [SupplierController::class, 'store_ajax']); // Menampilkan data supplier baru Ajax
    Route::get('/{id}', [SupplierController::class, 'show']);       // menampilkan detail supplier
    Route::get('/{id}/show_ajax', [SupplierController::class, 'show_ajax']);
    Route::get('/{id}/edit', [SupplierController::class, 'edit']);  // menampilkan halaman form edit supplier
    Route::put('/{id}', [SupplierController::class, 'update']);     // menyimpan perubahan data supplier
    Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']); // Menampilkan halaman form edit supplier Ajax
    Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']); // Menyimpan perubahan data supplier Ajax
    Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete supplier Ajax
    Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // Untuk hapus data supplier Ajax
    Route::delete('/{id}', [SupplierController::class, 'destroy']); // menghapus data supplier
    Route::get('/import', [SupplierController::class, 'import']); // ajax form upload excel
    Route::post('/import_ajax', [SupplierController::class, 'import_ajax']); // ajax import excel
    Route::get('/export_excel',[suppliercontroller::class,'export_excel']); //ajax export excel
    Route::get('/export_pdf',[suppliercontroller::class,'export_pdf']); //ajax export pdf
});
Route::group(['prefix' => 'stok', 'middleware' => 'authorize:ADM,MNG'], function () {
    Route::get('/', [StokController::class, 'index']);
    Route::post('/list', [StokController::class, 'list']);
    Route::get('/create', [StokController::class, 'create']);      // Menampilkan halaman form tambah stok barang
    Route::get('/create_ajax', [StokController::class, 'create_ajax']); // Menampilkan halaman form tambah stok Ajax
    Route::post('/ajax', [StokController::class, 'store_ajax']);     // Menyimpan data stok baru Ajax
    Route::get('/{id}/show_ajax', [StokController::class, 'show_ajax']); // Menampilkan halaman detail supplier Ajax
    Route::get('/{id}', [StokController::class, 'show']);      // Menampilkan detail stok
    Route::get('/{id}/edit_ajax', [StokController::class, 'edit_ajax']); // Menampilkan halaman form edit stok Ajax
    Route::put('/{id}/update_ajax', [StokController::class, 'update_ajax']); // Menyimpan perubahan data stok Ajax
    Route::get('/{id}/delete_ajax', [StokController::class, 'confirm_ajax']); // Untuk menampilkan form stok barang delete Ajax
    Route::delete('/{id}/delete_ajax', [StokController::class, 'delete_ajax']); // Untuk menghapus stok barang Ajax
    Route::get('/import', [StokController::class, 'import']);      // ajax form upload excel
    Route::post('/import_ajax', [StokController::class, 'import_ajax']);      // ajax import excel
    Route::get('/export_excel', [StokController::class, 'export_excel']);      // export excel
    Route::get('/export_pdf', [StokController::class, 'export_pdf']);      // export pdf
    Route::get('/{id}', [StokController::class, 'show']);
    Route::get('/{id}/edit', [StokController::class, 'edit']);
    Route::put('/{id}', [StokController::class, 'update']);
    Route::delete('/{id}', [StokController::class, 'destroy']);
});

Route::middleware(['authorize:ADM,MNG,STF'])->group(function () {
    Route::get('/penjualan', [PenjualanController::class, 'index']);          // menampilkan halaman awal stok
    Route::post('/penjualan/list', [PenjualanController::class, 'list']);      // menampilkan data stok dalam bentuk json untuk datatables
    Route::get('/penjualan/create', [PenjualanController::class, 'create']);   // menampilkan halaman form tambah stok
    Route::get('/penjualan/create_ajax', [PenjualanController::class, 'create_ajax']);
    Route::post('/penjualan/ajax', [PenjualanController::class, 'store_ajax']);
    Route::get('/penjualan/import', [PenjualanController::class, 'import']);
    Route::post('/penjualan/import_ajax', [PenjualanController::class, 'import_ajax']);
    Route::get('/penjualan/export_excel', [PenjualanController::class, 'export_excel']); // export excel
    Route::get('/penjualan/export_pdf', [PenjualanController::class, 'export_pdf']); // export pdf
    Route::get('/penjualan/{id}', [PenjualanController::class, 'show']);       // menampilkan detail stok
    Route::get('/penjualan/{id}/edit', [PenjualanController::class, 'edit']);  // menampilkan halaman form edit stok
    Route::put('/penjualan/{id}', [PenjualanController::class, 'update']);     // menyimpan perubahan data stok
    Route::get('/penjualan/{id}/edit_ajax', [PenjualanController::class, 'edit_ajax']);
    Route::put('/penjualan/{id}/update_ajax', [PenjualanController::class, 'update_ajax']);
    Route::get('/penjualan/{id}/delete_ajax', [PenjualanController::class, 'confirm_ajax']);
    Route::delete('/penjualan/{id}/delete_ajax', [PenjualanController::class, 'delete_ajax']);
    Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy']); // menghapus data stok
});

Route::middleware(['authorize:ADM,MNG,STF'])->group(function () {
    Route::get('/detail', [PenjualanController::class, 'index']);          // menampilkan halaman awal stok
    Route::post('/detail/list', [DetailController::class, 'list']);  // menampilkan halaman form tambah stok
    Route::get('/detail/create_ajax', [DetailController::class, 'create_ajax']);
    Route::post('/detail/ajax', [DetailController::class, 'store_ajax']);       // menyimpan data stok baru
    Route::get('/detail/import', [DetailController::class, 'import']);
    Route::post('/detail/import_ajax', [DetailController::class, 'import_ajax']);
    Route::get('/detail/export_excel', [DetailController::class, 'export_excel']); // export excel
    Route::get('/detail/export_pdf', [DetailController::class, 'export_pdf']); // export pdf
    Route::get('/detail/{id}', [DetailController::class, 'show']);    // menyimpan perubahan data stok
    Route::get('/detail/{id}/edit_ajax', [DetailController::class, 'edit_ajax']);
    Route::put('/detail/{id}/update_ajax', [DetailController::class, 'update_ajax']);
    Route::get('/detail/{id}/delete_ajax', [DetailController::class, 'confirm_ajax']);
    Route::delete('/detail/{id}/delete_ajax', [DetailController::class, 'delete_ajax']);
});
Route::group(['prefix' => 'profile'], function () {
    Route::get('/edit', [UserController::class, 'profile']);
    Route::post('/update_profile', [UserController::class, 'update_profile']); 
    Route::post('/update_info', [UserController::class, 'update_info']);
});

// use App\Http\Controllers\KategoriController;
// use App\Http\Controllers\LevelController;
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\WelcomeController;
// use Illuminate\Support\Facades\Route;

// Route::get('/', [WelcomeController::class, 'index']);
// Route::get('/user/tambah', [UserController::class, 'tambah']);
// Route::put('user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
// Route::post('user/tambah_simpan', [UserController::class, 'tambah_simpan']);
// Route::get('user/ubah/{id}', [UserController::class, 'ubah']);
// Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/level', [LevelController::class, 'index']);
// Route::get('/kategori', [KategoriController::class, 'index']);
// Route::get('/user', [UserController::class, 'index']);