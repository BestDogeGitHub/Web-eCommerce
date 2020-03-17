<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Address;
use App\User;
use App\Shipment;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) // elimino ogni settimana gli indirizzi che non hanno più un utente o uno shipment
    {
        $schedule->call( 
            function () 
            {
                $addresses = Address::all();
                $users = User::all();
                $shipments = Shipment::all();
                $add_ids = $addresses->pluck('id');
                $users_ids = $users->pluck('address_id');
                $ship_ids = $shipments->pluck('address_id');

                $add_ids = $add_ids->diff($users_ids);
                $add_ids = $add_ids->diff($ship_ids);

                Address::destroy( $add_ids );

            })->weekly()->timezone('Europe/Rome');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
