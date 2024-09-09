<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\CPLController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\TahunAkademikController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\MatkulIndController;
use App\Http\Controllers\CpmkController;
use App\Http\Controllers\DashboardMhsController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\RekapMatkulController;
use App\Http\Controllers\RekapMahasiswaController;
use App\Http\Controllers\RekapProdiController;
use App\Http\Controllers\RpsController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// ->middleware('guest')
// ->middleware('auth')
Route::get('/', function () {
    return view('login.index');
})->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');

//--------------------------MAHASISWA-----------------------------//
// Route::group(['middleware' => 'level:mahasiswa'], function () {
//     Route::post('/logout', [LoginController::class, 'logout']);
// Route::get('/home', [HomeController::class, 'index']);
// });

//----------------------------DOSEN-------------------------------//
// Route::group(['middleware' => 'level:dosen'], function () {
//     Route::post('/logout', [LoginController::class, 'logout']);
// Route::get('/home', [HomeController::class, 'index']);
// });

//----------------------------ADMIN-------------------------------//
// Route::group(['middleware' => 'level:admin'], function () {
//     Route::post('/logout', [LoginController::class, 'logout']);
// Route::get('/home', [HomeController::class, 'index']);
// });

//---------------------------KAPRODI------------------------------//
// Route::group(['middleware' => 'level:kaprodi'], function () {
//     Route::post('/logout', [LoginController::class, 'logout']);
// Route::get('/home', [HomeController::class, 'index']);
// });
 
Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/home', [HomeController::class, 'index']);

Route::get('/data-dosen', [DosenController::class, 'index']);
Route::post('/data-dosen/import', [DosenController::class, 'import']);
Route::get('/data-dosen/create', [DosenController::class, 'create']);
Route::post('/data-dosen/create', [DosenController::class, 'store']);
Route::get('/data-dosen/edit/{dosen:id}', [DosenController::class, 'edit']);
Route::post('/data-dosen/edit/{dosen:id}', [DosenController::class, 'update']);
Route::delete('/data-dosen/{dosen:id}', [DosenController::class, 'destroy']);

Route::get('/data-kaprodi', [KaprodiController::class, 'index']);
Route::get('/data-kaprodi/create', [KaprodiController::class, 'create']);
Route::post('/data-kaprodi/create', [KaprodiController::class, 'store']);
Route::get('/data-kaprodi/edit/{kaprodi:id}', [KaprodiController::class, 'edit']);
Route::post('/data-kaprodi/edit/{kaprodi:id}', [KaprodiController::class, 'update']);
Route::delete('/data-kaprodi/{kaprodi:id}', [KaprodiController::class, 'destroy']);

Route::get('/data-admin', [AdminController::class, 'index']);
Route::get('/data-admin/create', [AdminController::class, 'create']);
Route::post('/data-admin/create', [AdminController::class, 'store']);
Route::get('/data-admin/edit/{admin:id}', [AdminController::class, 'edit']);
Route::post('/data-admin/edit/{admin:id}', [AdminController::class, 'update']);
Route::delete('/data-admin/{admin:id}', [AdminController::class, 'destroy']);

Route::get('/data-mahasiswa', [MahasiswaController::class, 'index']);
// Route::get('/cetak', [MahasiswaController::class, 'cetak']);
Route::post('/data-mahasiswa/import', [MahasiswaController::class, 'import']);
Route::get('/data-mahasiswa/create', [MahasiswaController::class, 'create']);
Route::post('/data-mahasiswa/create', [MahasiswaController::class, 'store']);
Route::get('/data-mahasiswa/edit/{mahasiswa:id}', [MahasiswaController::class, 'edit']);
Route::post('/data-mahasiswa/edit/{mahasiswa:id}', [MahasiswaController::class, 'update']);
Route::delete('/data-mahasiswa/{mahasiswa:id}', [MahasiswaController::class, 'destroy']);

Route::get('/cpl-prodi', [CPLController::class, 'index']);
Route::post('/cpl-prodi/import', [CPLController::class, 'import']);
Route::get('/cpl-prodi/create', [CPLController::class, 'create']);
Route::post('/cpl-prodi/create', [CPLController::class, 'store']);
Route::get('/cpl-prodi/edit/{cpl:id}', [CPLController::class, 'edit']);
Route::post('/cpl-prodi/edit/{cpl:id}', [CPLController::class, 'update']);
Route::delete('/cpl-prodi/{cpl:id}', [CPLController::class, 'destroy']);

Route::get('/cpmk', [IndikatorController::class, 'index']);
Route::post('/cpmk/import', [IndikatorController::class, 'import']);
Route::get('/cpmk/create/{indikator:id}', [IndikatorController::class, 'create']);
Route::post('/cpmk/create/{indikator:id}', [IndikatorController::class, 'store']);
Route::get('/cpmk/edit/{indikator:id}', [IndikatorController::class, 'edit']);
Route::post('/cpmk/edit/{indikator:id}', [IndikatorController::class, 'update']);
Route::delete('/cpmk/{indikator:id}', [IndikatorController::class, 'destroy']);

Route::get('/data-tahun-akademik', [TahunAkademikController::class, 'index']);
Route::get('/data-tahun-akademik/create', [TahunAkademikController::class, 'create']);
Route::post('/data-tahun-akademik/create', [TahunAkademikController::class, 'store']);
Route::get('/data-tahun-akademik/edit/{tahunakademik:id}', [TahunAkademikController::class, 'edit']);
Route::post('/data-tahun-akademik/edit/{tahunakademik:id}', [TahunAkademikController::class, 'update']);
Route::delete('/data-tahun-akademik/{tahunakademik:id}', [TahunAkademikController::class, 'destroy']);

Route::get('/data-mata-kuliah', [MatkulController::class, 'index']);
Route::post('/data-mata-kuliah/import', [MatkulController::class, 'import']);
Route::get('/data-mata-kuliah/create', [MatkulController::class, 'create']);
Route::post('/data-mata-kuliah/create', [MatkulController::class, 'store']);
Route::get('/data-mata-kuliah/edit/{matkul:id}', [MatkulController::class, 'edit']);
Route::post('/data-mata-kuliah/edit/{matkul:id}', [MatkulController::class, 'update']);
Route::delete('/data-mata-kuliah/{matkul:id}', [MatkulController::class, 'destroy']);
Route::get('/data-mata-kuliah/{matkul:id}/koordinator-dan-pengampu/create', [MatkulController::class, 'create_pengampu']);
Route::post('/data-mata-kuliah/{matkul:id}/koordinator-dan-pengampu/create', [MatkulController::class, 'store_pengampu']);
Route::get('/data-mata-kuliah/{matkul:id}/koordinator-dan-pengampu/edit', [MatkulController::class, 'edit_pengampu']);
Route::post('/data-mata-kuliah/{matkul:id}/koordinator-dan-pengampu/edit', [MatkulController::class, 'update_pengampu']);

Route::get('/pemetaan-matkul-dan-cpmk', [MatkulIndController::class, 'index']);
Route::post('/pemetaan-matkul-dan-cpmk/import', [MatkulIndController::class, 'import']);
Route::get('/pemetaan-matkul-dan-cpmk/create/{matdin:id}', [MatkulIndController::class, 'create']);
Route::post('/pemetaan-matkul-dan-cpmk/create/{matdin:id}', [MatkulIndController::class, 'store']);
Route::get('/pemetaan-matkul-dan-cpmk/edit/{matdin:id}', [MatkulIndController::class, 'edit']);
Route::post('/pemetaan-matkul-dan-cpmk/edit/{matdin:id}', [MatkulIndController::class, 'update']);
// Route::delete('/pemetaan-matkul-dan-cpmk', [MatkulIndController::class, 'destroy']);

Route::get('/sub-cpmk', [CpmkController::class, 'index']);
Route::get('/sub-cpmk/{matkul:id}', [CpmkController::class, 'detail']);
Route::get('/sub-cpmk/{matkul:id}/create/{cpmk:id}', [CpmkController::class, 'create']);
Route::post('/sub-cpmk/{matkul:id}/create/{cpmk:id}', [CpmkController::class, 'store']);
Route::get('/sub-cpmk/{matkul:id}/edit/{cpmk:id}', [CpmkController::class, 'edit']);
Route::post('/sub-cpmk/{matkul:id}/edit/{cpmk:id}', [CpmkController::class, 'update']);
Route::get('/sub-cpmk/{matkul:id}/create_bobot/{cpmk:id}', [CpmkController::class, 'create_bobot']);
Route::post('/sub-cpmk/{matkul:id}/create_bobot/{cpmk:id}', [CpmkController::class, 'store_bobot']);
Route::get('/sub-cpmk/{matkul:id}/edit_bobot/{cpmk:id}', [CpmkController::class, 'edit_bobot']);
Route::post('/sub-cpmk/{matkul:id}/edit_bobot/{cpmk:id}', [CpmkController::class, 'update_bobot']);
Route::delete('/sub-cpmk/{matkul:id}/{cpmk:id}', [CpmkController::class, 'destroy']);

Route::get('/rps', [RpsController::class, 'index']);
Route::get('/rps/{matkul:id}', [RpsController::class, 'detail']);
Route::get('/rps/{matkul:id}/create_info_rps', [RpsController::class, 'create_info_rps']);
Route::post('/rps/{matkul:id}/create_info_rps', [RpsController::class, 'store_info_rps']);
Route::get('/rps/{matkul:id}/edit_info_rps', [RpsController::class, 'edit_info_rps']);
Route::post('/rps/{matkul:id}/edit_info_rps', [RpsController::class, 'update_info_rps']);
Route::get('/get-bobot-cpmk/{id}', [RpsController::class, 'getBobotCpmk']);
Route::get('/rps/{matkul:id}/create_rincian_rps', [RpsController::class, 'create_rincian_rps']);
Route::post('/rps/{matkul:id}/create_rincian_rps', [RpsController::class, 'store_rincian_rps']);
Route::get('/rps/{matkul:id}/edit_rincian_rps', [RpsController::class, 'edit_rincian_rps']);
Route::post('/rps/{matkul:id}/edit_rincian_rps', [RpsController::class, 'update_rincian_rps']);
Route::get('/cetak-rps/{matkul:id}', [RpsController::class, 'cetak']);

Route::get('/data-kelas', [KelasController::class, 'index']);
Route::get('/data-kelas/create/{akademik:id}', [KelasController::class, 'create']);
Route::post('/data-kelas/create/{akademik:id}', [KelasController::class, 'store']);
Route::get('/data-kelas/edit/{kelas:id}', [KelasController::class, 'edit']);
Route::post('/data-kelas/edit/{kelas:id}', [KelasController::class, 'update']);
Route::delete('/data-kelas/{kelas:id}', [KelasController::class, 'destroy']);
Route::get('/data-peserta-kelas/{kelas:id}', [KelasController::class, 'peserta_index']);

Route::post('/data-peserta-kelas/import', [PesertaController::class, 'import']);
Route::get('/data-peserta-kelas/create/{peserta:id}', [PesertaController::class, 'create']);
Route::post('/data-peserta-kelas/create/{peserta:id}', [PesertaController::class, 'store']);
Route::get('/data-peserta-kelas/edit/{peserta:id}', [PesertaController::class, 'edit']);
Route::post('/data-peserta-kelas/edit/{peserta:id}', [PesertaController::class, 'update']);
Route::delete('/data-peserta-kelas/{peserta:id}', [PesertaController::class, 'destroy']);

Route::get('/data-penilaian', [PenilaianController::class, 'index']);
Route::get('/data-penilaian/{kelass:id}', [PenilaianController::class, 'detail']);
Route::get('/data-penilaian/{kelass:id}/create/{penilaian:id}', [PenilaianController::class, 'create']);
Route::post('/data-penilaian/{kelass:id}/create/{penilaian:id}', [PenilaianController::class, 'store']);
Route::get('/data-penilaian/{kelass:id}/edit/{penilaian:id}', [PenilaianController::class, 'edit']);
Route::post('/data-penilaian/{kelass:id}/edit/{penilaian:id}', [PenilaianController::class, 'update']);
// Route::delete('/data-penilaian/{persentase:id}', [PenilaianController::class, 'destroy']);

Route::get('/rekap-mata-kuliah', [RekapMatkulController::class, 'index']);
Route::get('/rekap-mata-kuliah/{kelass:id}', [RekapMatkulController::class, 'detail']);
Route::get('/rekap-nilai-mahasiswa', [RekapMahasiswaController::class, 'index']);
Route::get('/cetak-rekap-mahasiswa/{mahasiswa:id}', [RekapMahasiswaController::class, 'cetak']);
Route::get('/rekap-program-studi', [RekapProdiController::class, 'index']);

Route::get('/Dashboard', [DashboardMhsController::class, 'index']);
});
