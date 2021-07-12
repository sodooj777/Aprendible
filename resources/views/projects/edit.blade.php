@extends('layout')

<!--en casos en que solo queremos enviar una cadena de caracteres  para evitar que nos agregen estos 
  espacios de mas podemos pasarle el contenido como segundo parametro de la directiva seccion 
  y podemos quitar la directiva de cierre-->
@section('title', 'Crear proyecto')

<!--section que por parametro resive el nombre donde vamos a insertar esta seccion lo vamos hacer en el yield('content') -->
@section('content')
<div class="container">  
  <div class="row">
    <div class="col-12 col-sm-10 col-lg-6 mx-auto"> 

     



      @include('partials.validation-errors')
                        
    
      

      {{--las accion del formulario va a ser la ruta 'projects.store'--}}

      <form class="bg-white shadow rounded py-3 px-4" 
          method="POST" 
          action="{{ route('projects.update', $project) }}"
          enctype="multipart/form-data"
      >
      <!-- para poder enviar achivos es nesesario 
            decirle al formulario que acepte enviar archivos para hacer 
            le agregamos al formulario enctype="multipart/form-data"
             y vemos que ahora la imagen es un objeto -->

          @method('PATCH') {{--NOS GENERA UN CAMPO OCULTO CON EL METODO QUE QUERAMOS YA QUE EL FORM NO LO SOPORTA TODOS LOS METODOS SINO EL POST Y GET --}}
          <h1 class="display-4">Editar proyecto</h1>
          <hr>
          {{--le pasamos un array como segundo parametro el texto del botton enviar que diga guardar en este caso
          y de esta forma la variable va a estar disponible en el archivo que incluimos--}}
          @include('projects._form', ['btnText' => 'Actualizar']) 
      

          
      </form>
    </div>
  </div>
</div>    

<!--y debemos indicarle el final de la seccion hasta aqui vamos a incluir en el yield('contect')-->
@endsection