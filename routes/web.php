<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RiwayatTanamController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\LaporanPanenController;
use App\Http\Controllers\HelpDeskController;
use App\Http\Controllers\PerawatanHPTController;
use App\Http\Controllers\BibitController;
use App\Http\Controllers\InventarisBibitController;

// Rute Default
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', function () {
    return view('login'); 
})->name('login');

Route::post('/login', function (Request $request) {
    
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        // Login Berhasil
        $request->session()->regenerate();
        return redirect()->intended('/dashboard'); 
    }

    // Login Gagal
    return back()->withInput()->with('loginError', 'E-mail atau password yang Anda masukkan salah.');

})->name('login.post');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/monitoring-cuaca', [WeatherController::class, 'index'])->name('weather.monitoring');

Route::get('/riwayat-tanam', function () {
    return view('riwayat_tanam');
});

Route::get('/perawatan', function () {
    return view('perawatan');
});

Route::get('/input-hasil-panen', function () {
    return view('input_panen');
})->name('panen.create');

Route::get('/prediksi-panen', function () {
    return view('prediksi_panen');
})->name('panen.prediksi');

Route::get('/helpdesk', function () {
    return view('help_desk');
})->name('helpdesk');

//post get
Route::get('/riwayat_tanam', [RiwayatTanamController::class, 'index'])->name('riwayat.index');       // Read
Route::post('/riwayat-tanam', [RiwayatTanamController::class, 'store'])->name('riwayat.store');      // Create
Route::get('/riwayat-tanam/{id}', [RiwayatTanamController::class, 'show'])->name('riwayat.show');    // Read detail
Route::put('/riwayat-tanam/{id}', [RiwayatTanamController::class, 'update'])->name('riwayat.update'); // Update
Route::delete('/riwayat-tanam/{id}', [RiwayatTanamController::class, 'destroy'])->name('riwayat.destroy'); // Delete

Route::get('/perawatan', [PerawatanHPTController::class, 'index'])->name('hpt.index');
Route::post('/perawatan-hpt', [PerawatanHPTController::class, 'store'])->name('hpt.store');
Route::put('/perawatan-hpt/{id}', [PerawatanHPTController::class, 'update'])->name('hpt.update');
Route::delete('/perawatan-hpt/{id}', [PerawatanHPTController::class, 'destroy'])->name('hpt.destroy');
Route::get('/perawatan-hpt', [PerawatanHPTController::class, 'index'])->name('hpt.index');
Route::post('/perawatan-hpt', [PerawatanHPTController::class, 'store'])->name('hpt.store');

Route::get('/laporan-panen', [LaporanPanenController::class, 'index'])->name('laporan.index');
Route::post('/input-panen', [App\Http\Controllers\LaporanPanenController::class, 'store'])->name('panen.store');

Route::get('/beli-bibit', [BibitController::class, 'index'])->name('bibit.index');
Route::post('/checkout-bibit', [BibitController::class, 'checkout'])->name('bibit.checkout');
Route::post('/midtrans-callback', [BibitController::class, 'callback']); 
Route::get('/tambah-bibit', [BibitController::class, 'create'])->name('bibit.create');
Route::post('/tambah-bibit', [BibitController::class, 'store'])->name('bibit.store');   
Route::get('/bibit/{id}/edit', [BibitController::class, 'edit'])->name('bibit.edit');
Route::put('/bibit/{id}', [BibitController::class, 'update'])->name('bibit.update');
Route::delete('/bibit/{id}', [BibitController::class, 'destroy'])->name('bibit.destroy');

Route::get('/admin/bibit-auth', [BibitController::class, 'enterCode'])->name('bibit.auth');
Route::post('/admin/bibit-verify', [BibitController::class, 'verifyCode'])->name('bibit.verify');

Route::get('/inventaris-bibit', [InventarisBibitController::class, 'index'])->name('inventaris.index');
Route::get('/inventaris-bibit/tambah', [InventarisBibitController::class, 'create'])->name('inventaris.create');
Route::post('/inventaris-bibit', [InventarisBibitController::class, 'store'])->name('inventaris.store');
Route::get('/inventaris-bibit/{id}/edit', [InventarisBibitController::class, 'edit'])->name('inventaris.edit');
Route::put('/inventaris-bibit/{id}', [InventarisBibitController::class, 'update'])->name('inventaris.update');
Route::delete('/inventaris-bibit/{id}', [InventarisBibitController::class, 'destroy'])->name('inventaris.destroy');
