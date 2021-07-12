<?php

namespace App\Http\Requests;

//importamos la clase rule
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;


class SaveProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */ /*este metodo se ejecuta al principio para determinar si el usuario  que realiza la peticion
      en este caso el usuario que envia el formulario para crear un proyecto esta autorizado para hacerlo */
    public function authorize()
    {                
    /*this es una instacia de request y hacemos
    la verificacion con user()a ver si el usuario puede o no  crear un projecto
    y preguntamos si es Administrador  */
        return true; //this->user()->isAdmin()
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() // para verificar las reglas de validacion 
    {   
        //verificamos si el metodo es post y si es verdadero se significa que estamos creando  un nuevo proyecto 
       // if ($this->getMethod() == 'POST')
       //verificamos si el metodo es PATCH en este caso estariamos editando un proyecto
       //if ($this->getMethod() == 'PATCH') {


       //}
        //$this->route('project'); // request Es UNA INSTANCIA ES COMO SI UTILIZaramos la variable request en el controlador atravez del request podemos acceder a los parametros que queramos
        //utilizamos el metodo route podemos acceder a este parametro de aqui portafolio/{project}   

        return [ //retornamos un array con las reglas de validacion
            'title'=> 'required',
            'description'=> 'required',
            'url'=>['required',
            // no olvidemos importar la clase role aqui arriba
            //queremos que verifique q la url sea unica  pero que ignore el projecto que estamos editando
             Rule::unique('projects')->ignore( $this->route('project'))],  //remplazamos esto por esto 'url'=>['required', 'unique:projects'],
             //llamamos el metodo ignore($this->route('project'))para que ignore en este caso el projecto que resivimos como parametro
             
             //le decimos que el campo image sea obligatorio y validamos que solo se puede cargar la imagen
            //'image'=> ['required','image'], //validamos que solo se puede cargar la imagen
            //solamente va apermitir este tipo de imagenes es de tipo jpeg, png, bmp,gif, svg o webp
            
            
            /*si devuelve verdadero quiere decir que estamos editando ?
             en este caso no vamos a devolver ninguna regla de momento cuando estemos editando 
             vamos a permitir que la imagen sea es decir que permita que este vacia 'nullable' y si es falso
             es decir que si estamos creando un nuevo proyecto entonces si que la imagen sea obligatoria  */
            'image'=> [$this->route('project') ? 'nullable' : 'required','mimes:jpeg,png'], 

            //'image'=> ['required','mimes:jpeg,png','dimensions:min_with=400,min_height=200'], 
            //vamos a utilizar la regla mimes:aqui van los tipos de archivo que queremos permitir para tener mas control solo va a cargar de esta forma solo va a permitir jpeg, png
              /*otra regla q tenemos disponible para validar imagenes es la regla dimensions nos sirve para restringir 
              los tamaños de la imagenes por ejemplo podemos decirle que la imagen va a tener un ancho de with=600, 
              y un alto de height=400 de esta forma ma a dejar guardar imagenes solo con estas dimensiones
              estas son las medidas minimas que va a permitir la validacion min_height  */


            /* 'url'=>['required', 'unique:projects'], agregamos la regla unique y debemos especificar en que tabla la url debe ser unica en nuestro caso en la tabla projects para ello 
            le pasamos dos puntos para pasarle un parametro y le damos el nombre de la tabla y como 
            segundo parametro opcional el podemos pasar el nombre del campo que queremos verificar
             en este caso url y ese seria un valor por defecto lo podemos omitir el segundo parametro
              url */ 
            // con esto me valida para cuando el campo url sea repetido diga el campo url ya ha sid registrado
           //una ves valida no va a dejar editar la url para acomodar eso 
        ];
    }

    public function messages()
    {   //pasamos un array con los msj de validacion
        return [
           'title.required' => 'El proyecto nesesita un titulo'
        ];
    }
}
