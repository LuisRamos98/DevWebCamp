<?php 

namespace Controllers;

use MVC\Router;
use Model\Ponente;
use Intervention\Image\ImageManagerStatic as Image;

class PonentesController {

    public static function index(Router $router) {

        $ponentes = Ponente::all();

        $router->render('admin/ponentes/index',[
            'titulo' => 'Ponentes / Conferencistas',
            'ponentes' => $ponentes
        ]);
    }

    public static function crear(Router $router) {

        $alertas = [];
        $ponente = new Ponente();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Leer Imagen
            if(!empty($_FILES['imagen']['tmp_name'])) {
                // debuguear('SI HAY IMAGEN');
                $carpeta_imagen = '../public/img/speakers';

                if(!is_dir($carpeta_imagen)) {
                    mkdir($carpeta_imagen,0755,true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png',80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp',80);

                $nombre_imagen = md5( uniqid( rand() ,true) );

                $_POST['imagen'] = $nombre_imagen;
            }

            $_POST['redes'] = json_encode($_POST['redes'],JSON_UNESCAPED_SLASHES);
            $ponente->sincronizar($_POST);
            
            //VALIDAR
            $alertas = $ponente->validar();
            
            //Guardar el registro
            if(empty($alertas)) {
                
                //Guardar las imagenes
                $imagen_png->save($carpeta_imagen . '/'. $nombre_imagen . '.png');
                $imagen_webp->save($carpeta_imagen . '/'. $nombre_imagen . '.webp');
                
                //Guardar en la BD
                $resultado = $ponente->guardar();

                if($resultado) {
                    header('Location: /admin/ponentes');
                }
            }
        }

        $router->render('admin/ponentes/crear',[
            'titulo' => 'Registrar Ponentes',
            'alertas' => $alertas,
            'ponente' => $ponente
        ]);
    }
}