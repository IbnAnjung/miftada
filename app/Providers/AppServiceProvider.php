<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Kelas;
use App\Siswa;
use App\StatusSiswa;
use App\Tagihan;
use App\BayarTagihanSiswa;
use App\Observers\KelasObserver;
use App\Observers\SiswaObserver;
use App\Observers\StatusSiswaObserver;
use App\Observers\TagihanObserver;
use App\Observers\BayarTagihanSiswaObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Kelas::observe(KelasObserver::class);
        Siswa::observe(SiswaObserver::class);
        StatusSiswa::observe(StatusSiswaObserver::class);
        Tagihan::observe(TagihanObserver::class);
        BayarTagihanSiswa::observe(BayarTagihanSiswaObserver::class);
    }
}
