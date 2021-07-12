<nav class="navbar navbar-light navbar-expand-lg bg-white shadow-sm">
    <div class="container">
       {{--agregamos un link que vaya a la ruta home--}}
    <a class="navbar-brand" href="{{ route('home') }}">
         {{--aqui mostramos el nombre de la aplicacion --}}        
         {{ config('app.name') }}
    </a>

    <button class="navbar-toggler" type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" 
        aria-expanded="false"
        aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <!--request() request nos devuel una nueva instancia de la clase  illuminate\http\Request-->
    <!--dump() con dump podemos ver toda la informacion con formato json-->
    <!--url() url nos devuelve la ruta -->
    <!--path() nos devuelve  la url interna-->
    <!--routeIs()  QUE NOS VA A DEVOLVER verdadero o falso si la ruta que le pasamos por parametro  es en la que estamos actualmente-->
    <!-- <pre></pre>-->
    <ul class="nav nav-pills"> 
        <!--aqui le preguntamos si estamos en el home utilizamos un operador ternario ? y vamos a imprimir
        active en el caso que sea verdadero 'active' y en caso que sea falso  no agregamos nada ' ' -->
        <!--lo que hace este signo de interrogaccion es evaluar lo que esta detras de el -->

        <!--la funcion lang es lo mismo q  y se va tener el mismo resultado <h1> __('Contact')</h1>-->
        <!--supongamos que tambien  queremos traducir el titulo de la pagina-->
        <!-- __ estas dos rayitas lo que hara es buscar una traduccion  con esta llave
        si no la encuentra simplemente mostrara la cadena de caracteres  que le pasamos por aqui en este caso es
        ('Contact') -->
 
        <li class="nav-item">
            <a class="nav-link {{ setActive('home') }}" 
            href=" {{ route('home') }}">
                @lang('Home')
            
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ setActive('about') }}"
             href="{{ route('about') }}">
             @lang('About')
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ setActive('projects.index') }}"
             href="{{ route('projects.index') }}">
             @lang('Projects')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ setActive('contact') }}" 
            href="{{ route('contact') }}">
            @lang('Contact')
            </a>
       </li>

        {{--directiva guest que hace lo contrario a la directiva of --}}
        @guest {{--guest = invitado si somos un invitado vamos a mostrale el link del login--}}
            {{--que se ejcutara este contenido solamente si no hemos iniciado session --}}
            <li class="nav-item">
                <a class="nav-link {{ setActive('login') }}" 
                href="{{ route('login') }}"
                >Login
            </a>
        </li>
        @else    
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
                >Cerrar sessión</a></li>
        @endguest
         {{--directiva guest que hace lo contrario a la directiva of --}}
        @guest {{--guest = invitado si somos un invitado vamos a mostrale el link del login--}}
         {{--que se ejcutara este contenido solamente si no hemos iniciado session --}}
         <li class="nav-item">
             <a class="nav-link {{ setActive('register') }}" 
             href="{{ route('register') }}"
             >Registrate
            </a>
        </li>
        @endguest

      
        
       
        
    </ul>
 </div>  
</div>  
</nav>

{{--para cerrar la session--}}
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>