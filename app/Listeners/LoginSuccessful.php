<?php

namespace App\Listeners;

//use IlluminateAuthEventsLogin;
use Illuminate\Auth\Events\Login as IlluminateAuthEventsLogin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Session;

class LoginSuccessful
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \IlluminateAuthEventsLogin  $event
     * @return void
     */
    public function handle(IlluminateAuthEventsLogin $event)
    {
        if($event->user->utype === 'ADM'){
            session()->put('utype', 'ADM');   
        }
        if($event->user->utype === 'STU'){
           session()->put('utype', 'STU');    
        }
        
    }
}
