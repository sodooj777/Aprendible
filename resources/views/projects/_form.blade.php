{{-- _form.blade.php esto nos indicaria que no es un archivo completo y que no deberia 
    ser retornado completamente como una vista--}}
@csrf

@if($project->image)
{{--le indicamos que todas la imagenes tenga un alto de 150px 
 para evitar que la imgen se vea aplastada utilizamos
 object-fit: cover de esa forma la imagen mantiene la relacion entre el alto y el ancho
 pero solo me mustra la parte del centro sin inportar el alto que tenga --}}      
<img class="card-img-top mb-2"
    style="height:250px; object-fit: cover"
    src="/storage/{{ $project->image }}"
    alt="{{ $project->title }}">
@endif

<div class="custom-file mb-2">
    <!--input de tipo archivo-->
    <!--y segundo debemos darle un nombre al input que se va a llamar image
         para poder resivirlo en el controlador-->
    <input name="image" type="file" class="custom-file-input" id="customFile">
    <label class="custom-file-label" for="customFile">Choose file</label>
</div>

<div class="form-group">
    <label for="title">Titulo del proyecto</label>     {{--old('title' esto nos va a imprimir el contenido de campo title 
        que exitia antes   de que la validacion haya fallado y si no hay error de validacion nos 
        muestra  $project->title--}}
    <input class="form-control border-0 bg-light shadow-sm"
        type="text"
        name="title"
        value="{{ old('title', $project->title) }}">
 
</div>
<br>

<div class="form-group">
    <label for="url">URL del proyecto</label>     {{--old('title' esto nos va a imprimir el contenido de campo title 
        que exitia antes   de que la validacion haya fallado y si no hay error de validacion nos 
        muestra  $project->title--}}
    <input class="form-control border-0 bg-light shadow-sm"
        type="text"
        name="url"
        value="{{ old('url', $project->url) }}">
 
</div>
<br>

<div class="form-group">
    <label for="description">Descripción del proyecto</label> 
    <textarea class="form-control border-0 bg-light shadow-sm"
        type="text"
        name="description"
        >{{  old('description',$project->description) }}</textarea>
</div>

<br>    
<button class="btn btn-primary btn-lg btn-block">{{ $btnText }}</button>


<a class="btn btn-link btn-block" href="{{ route('projects.index') }}">Cancelar</a>













