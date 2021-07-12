<?php

namespace App\Http\Controllers;


use App\Project; //importamos este modelo project
use App\Events\ProjectSaved; //importamos este modelo projectSaved
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Http\Requests\SaveProjectRequest; //importamos la clase del formulario
use PHPUnit\Framework\MockObject\Stub\ReturnSelf;

class ProjectController1 extends Controller
{   
    public function __construct()
        //le psamos el middleware q queramos aplicar en este caso auth ->middleware('auth');
    {   //colocamos el middleware
        //utilizamos el metodo only(y le pasamos el metodo create) para proteger esa rutas para que unusuario no autenticado no pueda modificar eliminar sin registrarse
       // $this->middleware('auth')->only('create','edit');

      /*el metodo except hace lo contrario del meto only   en este caso de va a aplicar el middleware('auth')
       a todos los metodos del controlar excepto a los que se defina por aqui except('index','show') */
       $this->middleware('auth')->except('index','show');
    }
    /**
     * Display a listing of the proyectos.
     *
     * @return \Illuminate\Http\Response
     */ // el metodo index se utiliza par listar  proyectos
    public function index()
    {                //aqui llamamos nuestro modelo  Q esta importado en 
                     // ordenamos lo s datos en ordenamos descendentes 
                     //latest('updated_at')    lo ordena por la fecha de actualizacion
                     // me arroja los datos  y los ordena en orden descendente  Project::orderBy('created_at','DESC')->get();
     //le cambiamos el nombre a la variable portfolio a projects
     // paginate() por defecto muestra 15 por pagina si le pasamos un parametro como el numero 2 me va a mostrar 2 por pagina
        $projects = Project::latest()->paginate(6);//Project::get(); esto es lo mismo que  DB::table('projects')->get(); pero depende de que utilicemos hay que llamar la clase con el metodo table le indicamos que tabla queremos consultar luego de indicarle el nombre de la tabla llamamos a el metodo get para obtener todos los datos

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new proyecto.
     *
     * @return \Illuminate\Http\Response
     */ //en el metodo create mostramos el formulario para crear un nuevo proyecto
    public function create()
    {
        return view('projects.create',[
          
            'project' => new Project //le pasamos una nueva instancia del modelo project es decir vamos a pasarle un proyecto vacio
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */  //el metodo store se utiliza para guardar el nuevo proyecto en la base de datos
    public function store(SaveProjectRequest $request)
    {     //  return request();  vemos los datos del formulario en tipo json 
        
       // $title = request('title');
       // $description = request('description');
        /*para guardar estos datos en la base de datos podemos utilizar el modelo Project y llamamos
        al metodo create que resive un array como parametro con los campos nesesarios para insertar
         en la base de datos*/           
        /*
         //validacion
         $fiels = request()->validate([
             'title'=> 'required',
             'description'=> 'required',
         ]); */
         // de esta forma vamos a estar protegidos de la asignacion masiva
        
        //pero si hacemos un domp vemos que tenemos una instancia de la clase uplodefile con tada la informacion del archivo
        //dd($request->file('image'));

        //ahora que tenemos la ubicacion temporal del archivo  debemos mover este archivo al servidor para poder utilizarlo despues utilizzando el metodo store(y por parametro le decimos en que carpeta lo queremos guardar)
        //nos devuelve la ubicacion del archivo pero en nuestro servidor es decir esta es la ubicacion permanente del archivo
          /* y como segundo parametro le podemos pasar los discos en el que queremos almacenar el archivo
           store('images','public'); disco public va a utilizar public si no le pasamos el segundo parametro por defecto va a utilizar el disco local store('images','local); */   
        //return $request->file('image')->store('images'); /*retornamos el request para aceder al archivo utilimos el metodo file(y luego el nombre del campo que es el nombre que le dimos en el formulario )
        
        // creamos una nueva instancia del modelo project
        $project = new Project( $request->validated() );
       
        //luego asignamos la imagen 
        $project->image = $request->file('image')->store('images');

        //Aqui guardamos todo en una sola consulta
        $project->save();
        //si ejecutamos solo nos devuelve la ubicacion temporal del archivo */
        ProjectSaved::dispatch($project); 
         
        return redirect()->route('projects.index')->with('status','El proyecto fue creado con exito');
        //ProjectSaved
         //ahora que te tenemos creado el evento el lisntener ahora debemos definir cuando se va a disparar el evento
        
       /*disparamos el evento directamente con el emtodo dispath y todo lo que pasemos por parametro de este mtodo
         estara disponible a travez del constructor de esta forma nesesitamos el objeto project de esta forma se lo enviamos de esta forma vamos a recibirlo  */
        // y con esto estamos disparando el evento en ambos metodos
      
        //Project::create($request->validated());

        // Project::create(request()->all()); //['title','description', 'approved' => true]  solo se va  a publicar si approved es verdadero
         //de esta forma tendriamos el mismo resultado de insertar los datos en bd
        /*Project::create([
          'title' => $title,
          'description' => $description

        ]);*/
        
        /* remplazamos todo esto 

        //vamos utilizar el fazades storas para obtener el archivo de esta forma le estamos pasando el contenido de la img 
        $image = Image::make(Storage::get($project->image))  
        //aqui utilizamos el metodo widen vamos a redimencionar la imagen a un ancho de 600 px
        //como le pasamos contenido a la img debemos volver codificarla encode() ya sea png o jpge o cualquiera que sea la extencion de la imagen 
        //limitamos la cantidad de colores de la image para reducir su peso utilizando el metodo limitColors(200)
            ->widen(600)
            ->limitColors(255)
            ->encode();
            
        //remplazaremos la img que subio el usuario  por esta nueva version redireccionada
        //sobre escribimos la misma imagen y el contenido sera la imagen que acabamos rediremencionar y vamos omitira como un string para estar seguros
        Storage::put($project->image, (string) $image);
         
       reemplazado por esto para evitar la duplicacion de codigo*/
       //para evitar esa duplicacion seria crea un metodo aqui en el controlador vamos a llamarle optimizeImage le pasamos el projecto como parametro
      // $this->optimizeImage($project);       
       


       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ //mostramos un proyecto expecifico encontrado por su identificador
     //al inyectar el modelo por aqui laravel automaticamente  va a buscar el projecto por el id que le pasamos por la ruta
    public function show(Project $project)
    {   //llamamos el metodo find para buscar un registro por su identificador aqui le pasamos el id que resivimos en la url
        //llamamos el metodo findOrFail para que falle en el momento que no encuentre un id que le pasemos
        

       // $project = Project::findOrFail($id);
                  //aqui le pasamos directamente el proyecto
                 //'project' => $id esto es lo que se conoce como route model binding
                                     
        return view('projects.show', [      
            'project' => $project   
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */    //mostramos  el formulario para editar un proyecto q ya existe
    public function edit(Project $project)
    {
        return view('projects.edit', [      
            'project' => $project   
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */   // guardariamos el proyecto en la base de datos
    public function update(Project $project, SaveProjectRequest $request)
    {   //preguntamos si el $request contiene el archivo con el nombre image
        if( $request->hasFile('image')) 
        {   

           //para eliminar la imagen anterior y no se guarde en la carpeta storage/app/public/images
           Storage::delete($project->image);  

            // metodo fill simplemente va a rellenar todos los campos sin guardarlos en la bd
            $project->fill( $request->validated());
        
            //luego asignamos la imagen 
            $project->image = $request->file('image')->store('images');

            //Aqui guardamos todo en una sola consulta
            $project->save();
            
              //optimización de la imagen que se ha guardado
            //creamos la instancia
            //estamos atando al codigo al disco local de esta forma  Image::make(storage_path('app/public/' . $project->image))
           //storage_path ubicacion completa de la  imagen
           
           //reemplazado por esto para evitar la duplicacion de codigo 
           //para evitar esa duplicacion seria crea un metodo aqui en el controlador vamos a llamarle optimizeImage le pasamos el projecto como parametro
           //$this->optimizeImage($project); 
           
           //ahora que te tenemos creado el evento el lisntener ahora debemos definir cuando se va a disparar el evento
           ProjectSaved::dispatch($project); /*disparamos el evento directamente con el emtodo dispath y todo lo que pasemos por parametro de este mtodo
           estara disponible a travez del constructor de esta forma nesesitamos el objeto project de esta forma se lo enviamos de esta forma vamos a recibirlo  */
          // y con esto estamos disparando el evento en ambos metodos
            
        }else{
             //ispeccionamos
        //para quitar el campo image => null
        /*y si reviamos el formulario ya no tenemos el campo llamdo 
        image  por  lo tanto no se va a actualizar en la base de datos 
        y la imagen que teniamos va a prevalecer ahi podemos ver que la imagen se mantiene*/
        //ddd(  ); //buscar en google
         
             //en caso de no tener imagen simplemente actualizamos todo  menos la imagen
             $project->update(array_filter($request->validated()));      //metodo update resive un array asosiativos con los campos que se quieren actualizar

        }
              
       
        /*$project->update([
            'title'=> request('title'),
            'description'=> request('description'),

        ]);*/
                                 //lo enviamos a esta ruta con el proyecto actualizado
        return redirect()->route('projects.show' , $project)->with('status','El proyecto fue actualizado con exito.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ //eliminamos un proyecto por su identificador
    public function destroy(Project $project)
    {   
        //para eliminar la imagen anterior y no se guarde en la carpeta storage/app/public/images
        Storage::delete($project->image); 

        //Project::destroy($id);
        // con esto ya eliminamos el registro en la base de datos 
        $project->delete();

        return redirect()->route('projects.index')->with('status','El proyecto fue eliminado con exito');
    }

   /* protected function optimizeImage($project)
    {
         //vamos utilizar el fazades storas para obtener el archivo de esta forma le estamos pasando el contenido de la img 
         $image = Image::make(Storage::get($project->image))  
         //aqui utilizamos el metodo widen vamos a redimencionar la imagen a un ancho de 600 px
         //como le pasamos contenido a la img debemos volver codificarla encode() ya sea png o jpge o cualquiera que sea la extencion de la imagen 
         //limitamos la cantidad de colores de la image para reducir su peso utilizando el metodo limitColors(200)
            ->widen(600)
            ->limitColors(255)
            ->encode();
         
         //remplazaremos la img que subio el usuario  por esta nueva version redireccionada

         //sobre escribimos la misma imagen y el contenido sera la imagen que acabamos rediremencionar y vamos omitira como un string para estar seguros
         Storage::put($project->image, (string) $image);
    }  */
}
