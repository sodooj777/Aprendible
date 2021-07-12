<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */ //y aqui en la propiedad listen definimos los eventos con su listen
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class, //por defecto laravel nos trae  listen que responde al elemento  register que sirve para verificar el gmail del usuario
        ],
        //aqui definimos el elemento que se va a generar ya decidimos que se va a llamar ProjectSaved
        \App\Events\ProjectSaved::class => [
            //y aqui definimos todos los listen q queremos q respondan a ese evento   
            //esto optimizara la imagen del proyecto   
             \App\Listeners\OptimizeProjectImage::class
             //por defecto laravel va a crear en la carpeta app \App\Events\ y los listeners en la carpeta \App\Listeners 
            //ejecutas para crear las carpetas  $ php artisan event:generate
    
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
