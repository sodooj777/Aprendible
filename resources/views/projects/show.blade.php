@extends('layout')
                  {{--le cambiamos al titulo del portafolio--}}
@section('title', 'Portafolio | ' . $project->title)


@section('content')
<div class="container">
 <div class="row">  
   <div class="col-12 col-sm-10 col-lg-8 mx-auto">
       @if($project->image)
           <img class="card-img-top"
               src="/storage/{{ $project->image }}"
               alt="{{ $project->title }}">
       @endif        

  <div class="bg-white p-5 shadow rounded">
  {{--mostramos el titulo la descripcion --}}
   <h1>{{ $project->title}}</h1>
   {{--solo va aparecer cuando estemos autenticados si no no va aparecer este botton de crear proyectos--}}
 
  
   
   <p class="text-secondary">
      {{ $project->description }}
   </p>
    {{--FECHA DE CREACION EN FORMATO HUMANO--}}
   <p class="text-black-50">{{ $project->created_at->diffForHumans() }}</p>

    <div class="d-flex justify-content-between align-items-center">
    <a href="{{ route('projects.index') }}">Regresar</a>

         @auth
         <div class="btn-group btn-group-sm">
         <a class="btn btn-primary" href="{{ route('projects.edit', $project) }}">Editar</a>
         <a class="btn btn-danger" href="#" onclick="document.getElementById('delete-project').submit()">Eliminar</a>
         </div>
         {{--creamos un formulario con el metodo delete --}}
         <form id="delete-project" class="d-none" method="POST" action="{{ route('projects.destroy' , $project) }}">
            {{--le decimos a laravel que vamos a intentar a hacer una petion de tipo delete agregamos la directiva method con el parametro delete--}}
            @csrf @method('DELETE')
            
         </form>
         @endauth
   </div>
 </div>
</div>
@endsection   