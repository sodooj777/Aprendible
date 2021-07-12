@extends('layout')

<!--en casos en que solo queremos enviar una cadena de caracteres  para evitar que nos agregen estos 
  espacios de mas podemos pasarle el contenido como segundo parametro de la directiva seccion 
  y podemos quitar la directiva de cierre-->
@section('title','About')

<!--section que por parametro resive el nombre donde vamos a insertar esta seccion lo vamos hacer en el yield('content') -->
@section('content')

<div class="container">
  <div class="row">
    <div class="col-12 col-lg-6">
      <img class="img-fluid mb-4" src="/img/about.svg" alt="Quién soy">
    </div>
    <div class="col-12 col-lg-6">
      <h1 class="display-4 text-primary">Quién soy</h1>
      <p class="lead text-secondary">
         Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
         incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
         exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
         dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
         Excepteur sint occaecat 
         cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
      </p>
      <a class="btn btn-lg btn-block btn-primary" href="{{ route('contact') }}">Contáctame</a>
      <a  class="btn btn-lg btn-block btn-outline-primary" href="{{ route('projects.index') }}">Portafolio</a>
     
    </div>
  </div>
</div>
<!--y debemos indicarle el final de la seccion hasta aqui vamos a incluir en el yield('contect')-->
@endsection