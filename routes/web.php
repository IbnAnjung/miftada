<?php

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

Auth::routes();

Route::middleware('auth')->group(function(){

    Route::get('/', 'HomeController@index')->name('home');
    
    /**
     * Kelas Route
     */
    Route::prefix('kelas')->name('kelas')->group(function(){
        Route::get('nonaktif', 'KelasController@indexNonAktif')->name('.nonaktif');
        Route::get('nonaktif/data', 'KelasController@dataNonAktif');
        Route::get('data', 'KelasController@data');
        Route::get('data/siswa/{idKelas}', 'KelasController@dataSiswa');
        Route::post('restore/{id}', 'KelasController@restore')->name('.restore');
    });
    Route::resource('kelas', 'KelasController');

    /**
     * Siswa Route
     */
    Route::prefix('siswa')->name('siswa.')->group(function(){
        Route::post('restore/{siswa}', 'SiswaController@restore')->name('restore');
        Route::get('data', 'SiswaController@data')->name('data');
        Route::get('tagihans/{id}', 'SiswaController@tagihans')->name('tagihans');
        /**
         * Status Route
         */
        Route::prefix('status')->name('status')->group(function(){
            Route::get('data', 'StatusSiswaController@data');
        });
        Route::resource('status', 'StatusSiswaController');
        
    });
    Route::resource('siswa', 'SiswaController');
    
    /**
     * Tagihan Route
     */
    Route::prefix('tagihan')->name('tagihan.')->group(function(){
        Route::get('data', 'TagihanController@data');
        Route::get('data/{tagihan}', 'TagihanController@dataTagihanSiswa');
        Route::prefix('potongan')->name('potongan.')->group(function(){
            Route::post('rubah/siswa/{id}', 'TagihanController@rubahPotonganPerSiswa')->name('siswa');
            Route::post('rubah/status-siswa/{id}', 'TagihanController@rubahPotonganPerStatusSiswa')->name('status-siswa');
            Route::get('{tagihan}', 'TagihanController@potongan')->name('index');
        });

        Route::prefix('pembayaran')->name('pembayaran.')->group(function(){
            
            Route::prefix('baru')->name('baru.')->group(function(){
                Route::get('/', 'BayarTagihanController@baru');
                Route::get('per-siswa', 'BayarTagihanController@siswa')->name('per-siswa');
                Route::get('per-tagihan', 'BayarTagihanController@tagihan')->name('per-tagihan');
                Route::post('/', 'BayarTagihanController@bayar');
            });
            Route::get('rekap', 'BayarTagihanController@rekap')->name('rekap');
            Route::get('data', 'BayarTagihanController@data')->name('data');
            Route::get('total', 'BayarTagihanController@total')->name('total');
            Route::put('/{id}', 'BayarTagihanController@rubahBayar');
            Route::delete('/{id}', 'BayarTagihanController@hapusBayar');

            Route::resource('pembayaran', 'BayarTagihanController');
        });
    });
    Route::resource('tagihan', 'TagihanController');

});

