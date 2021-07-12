<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JenjangController;
use App\Http\Controllers\TingkatController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\siswasController;
use App\Http\Controllers\JenjangdropController;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\JnsBiayasController;
use App\Http\Controllers\SetsppsController;
use App\Http\Controllers\PotsppsController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\GroupPaymentController;
use App\Http\Controllers\SetoranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::get('/changePassword',[HomeController::class,'showChangePassword']);
    Route::post('/changePassword',[HomeController::class,'changePassword'])->name('changePassword');
    Route::resource('jenjang', JenjangController::class);
    Route::resource('tingkat',TingkatController::class);
    Route::resource('kelas',KelasController::class);
    Route::resource('siswa',SiswasController::class);
    Route::get('getKelas',[JenjangdropController::class,'getKelas']);
    Route::get('getTingkat',[JenjangdropController::class,'getTingkat']);

    Route::get('importSiswa',[SiswasController::class,'importSiswa'])->name('importSiswa');
    Route::post('importSiswa',[SiswasController::class,'importExcel']);
    Route::get('downloadExcel',[SiswasController::class,'downloadExcel']);

    Route::resource('bendahara',BendaharaController::class);
    Route::get('createPermission',[UserController::class,'createPermission']);
    Route::post('storePermission',[UserController::class,'storePermission'])->name('storePermission');

    //bendahara
    Route::get('datasiswa',[SiswasController::class,'dataSiswa'])->name('datasiswa');
    Route::get('kenaikan',[SiswasController::class,'kenaikan'])->name('kenaikan');
    Route::post('kenaikan',[SiswasController::class,'kenaikanSiswa']);
    Route::resource('payment',PaymentsController::class);
    Route::resource('grouppayment',GroupPaymentController::class);
    Route::get('cekSpp',[PaymentsController::class,'cekSpp'])->name('cekSpp');
    Route::get('setoranSpp',[PaymentsController::class,'setoranSpp'])->name('setoranSpp');
    Route::resource('setoran',SetoranController::class);
    Route::get('dataPembayaranSpp',[PaymentsController::class,'dataPembayaranSpp'])->name('dataPembayaranSpp');
    Route::get('dataRangeDate',[PaymentsController::class,'dataRangeDate'])->name('dataRangeDate');

    //Bendahara Umum
    Route::resource('jnsBiaya',JnsBiayasController::class);
    Route::resource('setSpp',SetsppsController::class);
    Route::resource('Potspps',PotsppsController::class);
    Route::get('getSiswa',[JenjangdropController::class,'getSiswa']);
    Route::get('getNama',[JenjangdropController::class,'getNama']);

});