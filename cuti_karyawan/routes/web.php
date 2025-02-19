<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\JenisCutiController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\HistoryCutiController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\RekapShiftController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('karyawans', KaryawanController::class);

Route::resource('jenis_cuti', JenisCutiController::class);
Route::resource('cuti', CutiController::class);

Route::resource('history_cuti', HistoryCutiController::class);
Route::get('/rekap-cuti', [HistoryCutiController::class, 'index'])->name('history_cuti.index');
Route::get('rekap_cuti/{id}/pdf', [HistoryCutiController::class, 'generatePdf'])->name('rekap_cuti.generatePdf');


Route::resource('shifts', ShiftController::class);
Route::delete('/shifts/{id}', [ShiftController::class, 'destroy'])->name('shifts.destroy');

Route::get('/rekap-shift', [RekapShiftController::class, 'index'])->name('rekap.shift.index');

Route::get('/test-pdf', function () {
    $pdf = PDF::loadHTML('<h1>Hello World!</h1>');
    return $pdf->stream('test.pdf');
});
// Route::delete('/shift/{id}', [ShiftController::class, 'destroy'])->name('shift.destroy');
// // Menampilkan daftar cuti
// Route::get('cuti', [CutiController::class, 'index'])->name('cutis.index');

// // Menampilkan form untuk menambah cuti
// Route::get('cuti/create', [CutiController::class, 'create'])->name('cuti.create');

// // Menyimpan data cuti baru
// Route::post('cuti', [CutiController::class, 'store'])->name('cuti.store');

// // Menampilkan form untuk mengedit cuti
// Route::get('cuti/{cuti}/edit', [CutiController::class, 'edit'])->name('cuti.edit');

// // Memperbarui data cuti
// Route::put('cuti/{cuti}', [CutiController::class, 'update'])->name('cuti.update');

// // Menghapus data cuti
// Route::delete('cuti/{cuti}', [CutiController::class, 'destroy'])->name('cuti.destroy');
// Route::get('/dashboard', function () {
//     return view('dashboardd');
// });

// Route::get('/dashboard', function () {
//     return view('masterdata');
// });
