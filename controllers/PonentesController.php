<?php 

namespace Controllers;

use Classes\Paginacion;
use GuzzleHttp\Psr7\Header;
use MVC\Router;
use Model\Ponente;
use Intervention\Image\ImageManagerStatic as Image;

class PonentesController {

    public static function index(Router $router) {

        if(!is_admin()) {
            header('Location: /login');
        }

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual,FILTER_VALIDATE_INT);
        if(!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/ponentes?page=1');
        }

        $registros_por_pagina = 5;
        $total_registros = Ponente::total();
        $paginacion = new Paginacion($pagina_actual,$registros_por_pagina,$total_registros);

        debuguear($paginacion->total_paginas() . ' / '. $paginacion->pagina_siguiente());

        $ponentes = Ponente::all();

        $router->render('admin/ponentes/index',[
            'titulo' => 'Ponentes / Conferencistas',
            'ponentes' => $ponentes
        ]);
    }

    public static function crear(Router $router) {

        if(!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];
        $ponente = new Ponente();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(!is_admin()) {
                header('Location: /login');
            }

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
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)
        ]);
    }

    public static function editar (Router $router) {

        if(!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];
        
        $id = $_GET['id'];
        $id = filter_var($id,FILTER_VALIDATE_INT);
        
        if(!$id) {
            header('Location: /admin/ponentes');
        }

        $ponente = Ponente::find($id);

        if(!$ponente) {
            header('Location: /admin/ponentes');
        }

        $imagen_actual = $ponente->imagen;
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(!is_admin()) {
                header('Location: /login');
            }

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
            } else {
                $_POST['imagen'] = $imagen_actual;
            }
            
            $_POST['redes'] = json_encode($_POST['redes'],JSON_UNESCAPED_SLASHES);

            $ponente->sincronizar($_POST);
            
            if(empty($alertas)) {
                
                if(isset($nombre_imagen)) {
                    //Guardar las imagenes
                    $imagen_png->save($carpeta_imagen . '/'. $nombre_imagen . '.png');
                    $imagen_webp->save($carpeta_imagen . '/'. $nombre_imagen . '.webp');
                }

                $resultado = $ponente->guardar();

                if($resultado) {
                    header('Location: /admin/ponentes');
                }
            }
        }

        $router->render('admin/ponentes/editar',[
            'titulo' => 'Actualizar Ponentes',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'imagen_actual' => $imagen_actual,
            'redes' => json_decode($ponente->redes)
        ]);
    }

    public static function eliminar() {


        if($_SERVER['REQUEST_METHOD']) {
            
            if(!is_admin()) {
                header('Location: /login');
            }

            $id = $_POST['id'];

            $ponente = Ponente::find($id);

            if(!isset($ponente)) {
                header('Location: /admin/ponentes');
            }

            $resultado = $ponente->eliminar();

            if($resultado) {
                header('Location: /admin/ponentes');
            }
        }
    }
}