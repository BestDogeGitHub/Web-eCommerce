<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Address;
use App\User;
use App\Shipment;
use App\CreditCard;
use App\Invoice;

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
    protected function schedule(Schedule $schedule) // elimino ogni settimana gli indirizzi che non hanno più un utente o uno shipment, stessa cosa con le carte di credito per utenti e invoices
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


                $invoices = Invoice::all();
                $creditCards = CreditCard::all();
                $cardIds = $creditCards->pluck('id');
                $invIds = $invoices->pluck('credit_card_id');

                $cardIds = $cardIds->diff($invIds);
                
                foreach ($cardIds as $cardId) 
                {
                    $card = CreditCard::find($cardId);
                    if ( $card->user_id == NULL ) $card->delete();
                }
            })->weekly()->timezone('Europe/Rome');//->everyMinute();
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
