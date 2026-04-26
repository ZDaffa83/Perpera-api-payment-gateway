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
