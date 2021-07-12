<?php

namespace App;

use Illuminate\Database\Eloquent\Model; 
//modelos son elocuent 

class Project extends Model
{  
    //agregamos la propiedad fillable y dentro de un array agregar los campos q queremos que se puedan insertar masivamente
   // protected $fillable = ['title','url','description'];
    
     /*en lugar definir los campos que si queremos  que se puedan asignar masivamente  aqui definimos
      los campos que no queremos que se pueda asignar masivamente */
      // $guarded es lo contrario a $fillable
    //protected $guarded = ['id','approved','created_at','updated_at'];
    protected $guarded = [];
    //este es el metodo q laravel utilizar para determinar el campo por el q se va a buscar este modelo
    public function  getRouteKeyName() 
   {    //queremos q busque el campo por el titulo
       return 'url';
   }
}
