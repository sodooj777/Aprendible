const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
//podemos utilizar sass o less o stylus
// .sass('resources/sass/app.scss', 'public/css');
// .less('resources/less/app.less', 'public/css');
// .stylus('resources/stylus/app.stylus', 'public/css'); 

     // una ves verificada que esta informacion sea correcta 
     //ejecutamos la compilacion 
     // npm install --global yarn // 
     // luego se instala la dependencias de laravel para el front end es decir  la dependencia definidas  en el archivo package.json
     // npm install o yarn
     //la carpeta q se va a crear es node_modules es donde se van a guardar todas las dependencias
     //una ves terminada la instalacion de depedencias vamos a compilar los archivos
     // con
     //npm run dev o yarn dev
     //

   .sass('resources/sass/app.scss', 'public/css');
   
// otra cosa que podemos hacer para evitar resfrescar el navegador manualmente cada vez que hacemos un cambio es utilizar
//mix.browserSync y como parametro le pasamos la url  del proyecto local 
//como no tenemos instalado browesync todavia al momento de ejecutar el comando yarn watch y npm  run dev
//y una ves ejecutado vemos que las esta agregandom por nosostros vemos que nos ha instalado la dependencias
//y nos pide volver a ejecutar laravel mix
//mix.browserSync('http://localhost:8000');   

// le preguntamos si estamos en produccion
//if (mix.inProduction())
//{   // si es cierto llamamos el metodo version 
//    mix.version();
//}