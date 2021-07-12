<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //este controlador invoke lo utilizamos cuando solamente queremos tener un metodo en el controlador
    public function __invoke(Request $request)
    {   //aqui es donde vamos a retornar la vista portafolio en este caso que la tenemos en la carpeta resources/view 
        // y para pasarle los array lo podemos hacemos aca en el controlador como segundo parametros de la funcion view 
        
        $portfolio = [
            ['title' => 'Proyecto #1'],
            ['title' => 'Proyecto #2'],
            ['title' => 'Proyecto #3'],
            ['title' => 'Proyecto #4'] 
        ];
                
        return view('portfolio', compact('portfolio'));
    }
}













