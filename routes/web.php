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

# si queremos definir una ruta que responda cuando ingresemos a la raiz de nuestro sitio
//aprendible.com = Route::get('/',function) raiz de la pagina
//aprendible.com/contacto = Route::get('contacto',function) ruta especifica

/*
Route::get('/',function(){ 
    return "Hola desde la pagina de inicio";
});  

*/

Route::get('contacto',function(){
    return "Hola desde la pagina de contactos";

});

# redireciona a la vista saludos con el parametro nombre 
# para que el parametro no sea obligatorio sino opcional se le coloca  el signo ejemplo nombre?
# si no pasamos el nombre como parametro le vamos a pasar com invitado por defecto
Route::get('saludo/{nombre?}', function($nombre = "Invitado") {
    return "Saludos " . $nombre;
});




#Route::get()
#Route::post() // form action ="POST"
#Route::put()
#Route::patch()
#Router::delete() 

/*
//Rutas con nombre
Route::get('contactanos',function(){
    return "Seccion de contactos";

//llamamos el metodo name  y le pasamos el nombre que queremos 
// de esta manera le damos nombres a las rutas de enlaces
})->name('contactos');


Route::get('/',function(){
    
    //cada vez que queramos hacer referencia de la ruta vamos hacerlo mediante el nombre de la ruta y no por la url
    // funcion route  que resive como parametro el nombre q va a redireccionar
    echo "<a href='" . route('contactos') . "'>Contactos 1</a><br>";
    echo "<a href='" . route('contactos') . "'>Contactos 2</a><br>";
    echo "<a href='" . route('contactos') . "'>Contactos 3</a><br>";
    echo "<a href='" . route('contactos') . "'>Contactos 4</a><br>";
    echo "<a href='" . route('contactos') . "'>Contactos 5</a><br>";

});

*/

/*
// como mostrar html con las vistas
Route::get('/',function(){
  # retornamos las vistas con la funcion view de laravel que por parametro resive el nombre de la vista
  # esta funcion asume que las vistas se encuentran en las carpeta  resources /view y tambien asumen una extencion .blade.php
  
    $nombre = "Jorge";   
    # para enviar la variable a la vista podemos utilizar varias formas 
    # podemos llamar el metodo ->with  pasar como primer parametro el nombre de la variable y como segundo parametro el valor           
    return view('home')->with('nombre',$nombre);
    # otra forma de enviar esta informacion es en forma de array    return view('home')->with(['nombre'=> $nombre]);                      
    #return view('home',['nombre'=> $nombre]);
    # return view('home', compact('nombre')); nos va a devolver el mismo array que teniamos antes
})->name('home');
*/


# metodo view 
# le decimos que cuando vaya a la raiz nos devuelva la vista home
# podemos pasarle informacion de la misma forma    #return view('home',['nombre'=> $nombre]); en forma de array
//Route::view('/','home',['nombre' => 'Jorge']);


//estructura de control con blade 
//vamos a pasarle un array de informacion a la vista portafolio
             // array



Route::view('/','home')->name('home');
# pagina ruta /about que nos cargue la vista about con el nombre  de la ruta sera about 
Route::view('/quienes-somos','about')->name('about');

          # url como primer parametro y como segundo parametro el controlador que se va a ejecutar 
          # cuando accedamos a esta url
          #agregamos el nombre del controlador y con eso se va a ejecutar el metodo invoke
          # deberia quedar solamente para declarar ruta
 # debemos especificar q metodo queremos que se ejecute 
 #cuando accedamos a esta ruta para ello podemos agregar un arroba  
 # luego el nombre del metodo que quermos q se ejecute para ello 
 # podemos agregar un arroba y  luego el nombre del metodo que se ejecute       ejemplo @index
 /*
Route::get('/portafolio','ProjectController1@index')->name('projects.index');


Route::get('/portafolio/crear','ProjectController1@create')->name('projects.create');
//ruta tipo post
Route::post('/portafolio','ProjectController1@store')->name('projects.store');

Route::get('/portafolio/{project}','ProjectController1@show')->name('projects.show');

Route::get('/portafolio/{project}/editar','ProjectController1@edit')->name('projects.edit');

//para actualizar un registro se utiliza  metodo put o patch
Route::patch('/portafolio/{project}','ProjectController1@update')->name('projects.update');

Route::delete('/portafolio/{project}','ProjectController1@destroy')->name('projects.destroy');
*/
//Route::resource que resive dos parametros primero es el nombre del recurso      y el segundo el controlador encargado de este recurso
//simplificamos todas las vista que estan comentadas en resource  
// portafolio es el nombre de la ruta y segundo parametro el controlador
//el nombre que le queremos dar a este recurso es projects
// y le pasamos el parametro project
//le psamos el middleware q queramos aplicar en este caso auth ->middleware('auth');
Route::resource('portafolio','ProjectController1')
    ->parameters(['portafolio'=>'project'])
    ->names('projects');



Route::view('/contact','contact')->name('contact');


//para generar rapidamenta las 7 ruta  que nesesitamos para los 7 metodos definidos aqui en el controlador resources
// como primer parametro resive el nombre del recurso o proyectos y el segundo parametro es del controlador resource
//metodo only que resive un array como parametro y aqui podemos elegir cuales de los 7 metodos res queremos que se registren 
Route::resource('projects','ProjectController1')->only(['index','show']);

// lo opuesto  a only podemos lograr si utilizamos el metodo except 

/*para que nos no de error el formulario creamos esta nueva ruta que responda a la misma url 
pero con el metodo post
  la url es contact y vamos a crearle un nuevo controlador para procesar  
 los mensajes de contactos que se va a llamar MessagesController y le indicamos el metodo store*/
Route::post('contact','MessageController@store')->name('messages.store');








Auth::routes(); //['register'=> false] para desabilitar el registro del usuario


