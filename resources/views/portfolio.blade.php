@extends('layout')

<!--en casos en que solo queremos enviar una cadena de caracteres  para evitar que nos agregen estos 
  espacios de mas podemos pasarle el contenido como segundo parametro de la directiva seccion 
  y podemos quitar la directiva de cierre-->
@section('title','Portfolio')

<!--section que por parametro resive el nombre donde vamos a insertar esta seccion lo vamos hacer en el yield('content') -->
@section('content')
<h1>Portfolio</h1>
 <ul>
        <!--haci se usa un if en blade if y cierras la directiva endif -->
        @isset($projects)
           <!-- vamos a recorrer todos los elementos de array con un foreach -->                               {{----}}
           <!--esta es la forma que hacemos un foreach-->                                                    {{--  updated_at->diffForHumans() este metodo nos muestra la diferecia de tiempo en lenguaje humano --}} 
            @foreach ($projects as $project)      
                {{--para saber que proyecto queremos mostrar debemos pasarle un identificador
                como segundo parametro de la identificacion route en este caso le vamos a pasar el objecto project
                y laravel automaticamente va a obtener el id atravez de el y nos va generar un links para cada projecto--}}
                                                                            <!--format para darle formato('Y-m-d')-->
                <li><a href="{{ route('portfolio.show', $project) }}">{{ $project->title }}</a></li> <!--no podemos acceder al titulo como propiedad si no como un metodo en la base de datos-->
                {{--<small>{{$projectsItem->description }}</small> <br>{{$projectsItem->created_at->format('Y-m-d') }}--}}
            @endforeach
        @else
            <li>No hay proyectos para mostrar</li>
        @endisset
 {{--aqui podemos imprimir los links de paginacion llamando al metodo links() atravez del objeto portafolio--}}
        {{ $projects->links()}}

   </ul> 

<ul>
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
</ul>


<!--y debemos indicarle el final de la seccion hasta aqui vamos a incluir en el yield('contect')-->
@endsection