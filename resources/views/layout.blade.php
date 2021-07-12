<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--si queremos mostrar un valor por defecto le podemos pasar un segundo parametro a titulo-->
    <title>@yield('title','Aprendible')</title> <!--Aprendible sera el titulo por defecto-->
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/app.js" defer></script>
    <style>
      
    </style>
</head>
<body>
    <div id="app" class="d-flex flex-column h-screen justify-content-between">
        <!--si no esta definida esta variable  le decimos que es opcional y nos muestre la cadena invitado-->
        <!--Bienvenid@  $nombre ?? "Invitado" con corchetes doble llaves-->
        <!--podemos utilizar un slash  o un punto tambien sirve para entrar en esa carpeta luego el nombre del archivo que vamos a incluir-->
        <header>
            @include('partials/nav')
        
            <!--la directiva yield permite colocar contenido diferente-->     
            <!--cada vista tendra un contenido diferente-->
            <!--aqui abajo queremos que el contenido se agrege dinamicamente para permitirlo utilizamos la directiva yield-->
            <!--resive como parametro un nombre para diferenciarla ya que podemos utilizar varios yield en la misma pagina-->
            @include('partials.session-status'){{--aqui vamos a incluir los mesajes de sessiones--}}
        </header>    

        <main class="py-4">    
            @yield('content')
        </main>
        
        <footer class="bg-white text-center text-black-50 py-3 shadow">
            {{--nombre de la aplicacion--}}
            {{ config('app.name') }} | Copyright @ {{ date('Y') }}
        </footer>

   </div>
</body>
</html>
