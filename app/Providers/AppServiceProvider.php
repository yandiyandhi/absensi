<?php

namespace App\Providers;

use App\Models\Acara;
use App\Models\Departemen;
use App\Models\Izin;
use App\Models\Jabatan;
use App\Models\JenisIzin;
use App\Models\Kantor;
use App\Models\Presensi;
use App\Models\User;
use App\Observers\AcaraObserver;
use App\Observers\DepartemenObserver;
use App\Observers\IzinObserver;
use App\Observers\JabatanObserver;
use App\Observers\JenisIzinObserver;
use App\Observers\KantorObserver;
use App\Observers\PresensiObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JenisIzin::observe(JenisIzinObserver::class);
        Departemen::observe(DepartemenObserver::class);
        Jabatan::observe(JabatanObserver::class);
        User::observe(UserObserver::class);
        Kantor::observe(KantorObserver::class);
        Izin::observe(IzinObserver::class);
        Presensi::observe(PresensiObserver::class);
        Acara::observe(AcaraObserver::class);

        Gate::before(function ($user, $ability) {
            if ($user->hasRole('admin')) {
                return true;
            }
        });

        if (request()->header(key: 'x-forwarded-proto') === 'https') {
            URL::forceScheme('https');
        }
    }
}
