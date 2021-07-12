<!--esta directiva extends va a buscar la plantilla en resources/view en este caso -->
@extends('layout')

<!--en casos en que solo queremos enviar una cadena de caracteres  para evitar que nos agregen estos 
  espacios de mas podemos pasarle el contenido como segundo parametro de la directiva seccion 
  y podemos quitar la directiva de cierre-->
@section('title','Contact')

<!--section que por parametro resive el nombre donde vamos a insertar esta seccion lo vamos hacer en el yield('content') -->
@section('content')


<div class="container">  
  <div class="row">
    <div class="col-12 col-sm-10 col-lg-6 mx-auto"> 
              
      <!--la variable errors nos devuelve un objeto y cada campo tiene su array de errores-->
      <!--en larabel tenemos acceso a la variable $errors en todas las vistas -->
      <!-- var_dump($errors->any()) any es para ver si tenemos algun error y el var_dump es para inspeccionarlo -->
      
      {{--preguntamos si existe un msj en la session con el nombre status
         que es nombre que le dimos al msj en el controlador--}}
      
          {{-- 
            @if($errors->any())
            <!--si queremos obtener solamente los errores de todos los campos en un solo array podemos utilizar metodo all()-->
                <ul>
                @foreach ($errors->all() as $error) <!--con este foreach nos va a mostrar 
                                          todos los errores de validacion de todos los campos-->
                      <li>{{ $error }}</li>
                @endforeach 
                </ul>
            @endif

              --}}

            <!--le decimos que la accion sea igual que nuestro caso a la ruta contact-->
            <form class="bg-white shadow rounded py-3 px-4" method="POST" action="{{ route('messages.store') }}">
              <!--todos los formularios que creemos en laravel deberan
                tener un toque para verificar que el formulario es seguro y asi evitar ataques-->
                <!--en pocas palabras sin csrf dara error 419 porque laravel cree que es un ataque  -->
              @csrf <!--lo que hara esta directiva es agregar un campo oculto 
                con el toque del usuario que laravel automaticamento va a verificar -->
              
              <!--supongamos que tambien  queremos traducir el titulo de la pagina-->
              <!-- __ estas dos rayitas lo que hara es buscar una traduccion  con esta llave
              si no la encuentra simplemente mostrara la cadena de caracteres  que le pasamos por aqui en este caso es
              ('Contact') -->  
              <h1 class="display-4">{{ __('Contact') }}</h1>  
              <div class="form-group">
                <label for="name">Nombre</label>
              <input class="form-control bg-light shadow-sm  
                  @error('name') is-invalid @else border-0 @enderror"
                  id="name"
                  name="name"
                  placeholder="Nombre....."
                  value="{{ old('name') }}">
                  @error('name')
                    {{--verificamos si esta directiva tiene errores y incluimos la estrutura de html de msj error--}}
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
              <!--metodo first mostrar el error debajo de cada campo para obtener el primer error de un campo
                y como parametro le pasamos el nombre de un campo le pasamos como segundo parametro una estructura html-->
              <!--supongamos que queramos mostrar una etiqueta small 
              y para imprimir el mensaje podemos utilizar 
              :message 
              laravel automaticamente va a remplazar esta cadena de caracteres con el error corresmpondiente
              en este caso queremos inprimir html ya que es contenido seguro  con { y doble signo de esclamacion 
              -->
               {{-- {!! $errors->first('name','<small>:message</small><br>') !!} --}}
             
              <!--si falla un valor no queremos que usuario vuelva a llenarlos todos campos nuevamente para evitar esto
              en el valor del campo en el value podemos utilizar la funcion old('email') y por parametro pasarle 
              el nombre del campo-->
              <div class="form-group">
                <label for="email">Email</label>  
              <input class="form-control bg-light shadow-sm  
                  @error('email') is-invalid @else border-0 @enderror"
                  id="email"
                  type="text"
                  name="email"
                  placeholder="Email...."
                  value="{{ old('email') }}">
                  @error('email')
                  {{--verificamos si esta directiva tiene errores y incluimos la estrutura de html de msj error--}}
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
              </div>
               {{--{!! $errors->first('email','<small>:message</small><br>') !!} --}}
      
              <div class="form-group">
                <label for="subject">Asunto</label>  
              <input class="form-control bg-light shadow-sm 
                  @error('subject') is-invalid @else border-0 @enderror"
                  id="subject"
                  name="subject"
                  placeholder="Asunto...."
                  value="{{ old('subject') }}"
                  >
                  @error('subject')
                  {{--verificamos si esta directiva tiene errores y incluimos la estrutura de html de msj error--}}
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
              </div>    
             {{-- {!! $errors->first('subject','<small>:message</small><br>') !!} --}}
               <div class="form-group">
                  <label for="content">Contenido</label>
                <textarea class="form-control bg-light shadow-sm   
                    @error('subject') is-invalid @else border-0 @enderror"
                    id="content"
                    name="content"
                    placeholder="Escribe aqui el contenido de tu mensaje...">{{ old('content') }}</textarea>
                @error('content')
                    {{--verificamos si esta directiva tiene errores y incluimos la estrutura de html de msj error--}}
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
               </div>    
              {{--{!! $errors->first('content','<small>:message</small><br>') !!}--}}
               
               <br>
               <button class="btn btn-primary btn-lg btn-block">@lang('Send')</button>
              
          </form>
            <!--y debemos indicarle el final de la seccion hasta aqui vamos a incluir en el yield('contect')-->
    </div>
  </div>
</div>

@endsection