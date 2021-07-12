@extends('layout')

<!--en casos en que solo queremos enviar una cadena de caracteres  para evitar que nos agregen estos 
  espacios de mas podemos pasarle el contenido como segundo parametro de la directiva seccion 
  y podemos quitar la directiva de cierre-->
@section('title','Portfolio')

<!--section que por parametro resive el nombre donde vamos a insertar esta seccion lo vamos hacer en el yield('content') -->
@section('content')
<div class="container">

<div class="d-flex justify-content-between align-items-center mb-3">    
    <h1 class="display-4 mb-0">@lang('Projects')</h1>

    {{--solo va aparecer cuando estemos autenticados si no no va aparecer este botton de crear proyectos--}}
    @auth
        <a class="btn btn-primary" href="{{ route('projects.create')}}">Crear proyectos</a>
    @endauth 

</div>

<p class="lead text-secondary">Proyectos realizados Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>

                       
 <div class="d-flex flex-wrap justify-content-between align-items-start">
    <!--haci se usa un if en blade if y cierras la directiva endif -->
    @isset($projects)
       <!-- vamos a recorrer todos los elementos de array con un foreach -->                               {{----}}
       <!--esta es la forma que hacemos un foreach-->                                                    {{--  updated_at->diffForHumans() este metodo nos muestra la diferecia de tiempo en lenguaje humano --}} 
        @foreach ($projects as $project)      
            {{--para saber que proyecto queremos mostrar debemos pasarle un identificador
            como segundo parametro de la identificacion route en este caso le vamos a pasar el objecto project
            y laravel automaticamente va a obtener el id atravez de el y nos va generar un links para cada projecto--}}
         <div class="card border-0 shadow-sm mt-4 mx-auto" style="width: 18rem">                                                                <!--format para darle formato('Y-m-d')-->
            

               <!--creamos una etiqueta img la direccion sera la raiz  luego accedemos al  
                   symlik /storage y luego de esto queremos imprimir lo que tenemos en la base de datos
                  detro de project->image y en el texto alt alternativo podemos agragar el titulo-->
                  {{--preguntamos si el proyecto contiene la imagen y no muestra la imagen en caso de no tenerla--}}
                @if($project->image)  
                    {{--le indicamos que todas la imagenes tenga un alto de 150px 
                      para evitar que la imgen se vea aplastada utilizamos
                       object-fit: cover de esa forma la imagen mantiene la relacion entre el alto y el ancho
                       pero solo me mustra la parte del centro sin inportar el alto que tenga --}}                
                   <img class="card-img-top" style="height:150px; object-fit: cover" src="/storage/{{ $project->image }}" alt="{{ $project->title }}" />
                @endif

                <div class="card-body">
                  <h5 class=" font-weight-bold">
                    <a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
                  </h5>
                    <h6 class="card-subtitle">{{ $project->created_at->format('d/m/Y')}}</h6> 
                  <p class="card-text text-truncate">{{ $project->description }}</p> 
                  <a href="{{ route('projects.show', $project) }}"
                      class="btn btn-primary btn-sm"
                  >Ver mas...</a>    
            </div>
         </div>   
                <!--no podemos acceder al titulo como propiedad si no como un metodo en la base de datos-->
                {{--<small>{{$projectsItem->description }}</small> <br>{{$projectsItem->created_at->format('Y-m-d') }}--}}
            @endforeach
        @else
          <div class="card">  
             <div class="card-body"
             >No hay proyectos para mostrar
             </div>
          </div>

        @endisset
 {{--aqui podemos imprimir los links de paginacion llamando al metodo links() atravez del objeto portafolio--}}
    
   <div class="mt-4">    
      {{ $projects->links() }}
   </div> 

{{--<ul>
    <!--forelse lo que va hacer es recorrer el array y mostrarnos el titulo del portafolio
         resive otra directiva llamada empty -->
    @forelse ($projects as $project) 
                                                <!--es un objeto con la informacion sobre el loop--> 
        <li>{{ $project->title }} <pre>{{var_dump($loop) }}</pre></li>
    @empty 
        <!-- empty pero cuando este vacio el portafolio vamos  a mostrar esta linea
        aqui adentro vamos a mostrar el msj q queramos cuando la variable este vacia-->
        <li>No hay proyectos para mostrar</li>
    @endforelse 
</ul>--}}

</div>

<!--y debemos indicarle el final de la seccion hasta aqui vamos a incluir en el yield('contect')-->
@endsection