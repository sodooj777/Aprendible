<?php

namespace App\Http\Controllers;

use App\Mail\MessageReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{    /*para acceder a la informacion que el usuario ingreso  en el formulario  
    utilizamos la clase Request que tenemos importada arriba por defecto 
   hay varias formas de utilizarla una de las mas comunes  es inyectarla atravez del metodo store en este caso
   ylaravel va a resorver la clase para nosotros
   y la guardamos en una variable que voy a llamar $request */
    public function store(Request $request)
    {   /*para acceder a un campo especifico podemos utilizar
         metodo get y pasarle el nombre del campo que queremos obtener
         return $request->get('name');  */

         /*para validar  datos en laravel*/
       $request->validate([
             'name' => 'required',
             //para agregar otra regla email de validacion 
             'email' => 'required|email',
             'subject' => 'required',
             //le decimos que tenga un minimo de tres caracteres
             'content' => 'required|min:3'
            
            //para personalizar los msj de validacion
       ],  //podemos pasar un array con los msj que queremos personalizar
       [    // cuando la reglar required falle en el campo name que nos muestre este msj 
            'name.required' => __('I need your name')
       ]); 
       
       //Enviar el email
       //send que contendra el email   
       //le pasamos una nueva instancia
      // Mail::to('sodooj777@hotmail.com')->send(new MessageReceived);
       
       //return "Datos validados";

       //aqui vamos hacer mensajes flash
       //podemos utilizar el helper redirect o back nos va aredireccionar ala ultima peticion que hicimos
       //el metodo with le pasamos dos parametros el primer parametro es la llave con la que almacenamos el msj en la session que seria la llave y como segundo parametro seria el valor
       return back()->with('status','Recibimos tu mensaje te responderemos en menos de 24 horas.');
       /* esta es otra forma de acceder al request y es mas sencilla 
       es con la funcion request que nos devuelve una instancia use Illuminate\Http\Request; 
       aqui accedemos al email y lo pasamos como parametro  de esta forma quitamos 
  esto use Illuminate\Http\Request;    store(lo dejamos vacio)  y quitamos esto return $request->get('name');  
      y mostramos esto 
       return request('email'); */
       
    }
}
