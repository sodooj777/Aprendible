<?php

namespace App\Listeners;

use App\Events\ProjectSaved;
use Intervention\Image\Facades\Image; //IMPORTAMOS LA IMAGE 
use Illuminate\Support\Facades\Storage; //importamos facades storAGE
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue; //esta interfaz esta vacia  es simplemente para verificar que esta clase OptimizeProjectImagen se debe enviar a las  queue 

//los listener se puede enviar a las colas directamente
// para enviar un listener a las colas de trabajo podemos simplemente implementar SholdQueue
class OptimizeProjectImage implements ShouldQueue
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
     * @param  ProjectSaved  $event
     * @return void
     */
    public function handle(ProjectSaved $event) //este metodo handle es el que se ejcutara automaticamente
    {  //simulamos el error disparando una exception
         //throw new \Exception("Error optimizing the image", 1);

        //atravez del $event-> evento podemos acceder al proyecto
        //aqui vamos a definir la logica de listener que en este caso seria optimizar la imagen
        
         //vamos utilizar el fazades storas para obtener el archivo de esta forma le estamos pasando el contenido de la img 
         $image = Image::make(Storage::get($event->project->image))  
         //aqui utilizamos el metodo widen vamos a redimencionar la imagen a un ancho de 600 px
         //como le pasamos contenido a la img debemos volver codificarla encode() ya sea png o jpge o cualquiera que sea la extencion de la imagen 
         //limitamos la cantidad de colores de la image para reducir su peso utilizando el metodo limitColors(200)
            ->widen(600)
            ->limitColors(255)
            ->encode();
         
         //remplazaremos la img que subio el usuario  por esta nueva version redireccionada

         //sobre escribimos la misma imagen y el contenido sera la imagen que acabamos rediremencionar y vamos omitira como un string para estar seguros
         Storage::put($event->project->image, (string) $image);
    }
}
