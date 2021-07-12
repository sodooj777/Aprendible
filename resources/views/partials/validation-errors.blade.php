    {{--preguntamos si hay algun error --}}
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="m-0">   {{--obtenemos todos los errores con el metodo all--}}
          @foreach ($errors->all() as $error)
          {{--nos muestra todos los errores--}}
            <li>{{ $error }}</li>
          @endforeach
      </ul>
   </div>
@endif