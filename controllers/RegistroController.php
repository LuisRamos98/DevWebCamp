<?php 

namespace Controllers;

use MVC\Router;
use Model\Paquete;
use Model\Usuario;
use Model\Registro;

class RegistroController {

    public static function crear(Router $router) {

        if(!is_auth()) {
            header('Location: /');
        }

        $registro = Registro::where('usuario_id', $_SESSION['id']);

        if(isset($registro) && $registro->paquete_id === '3') {            
            header('Location: /boleto?id=' . urlencode($registro->token));
        }
        
        $router->render('registro/crear',[
            'titulo' => 'Finalizar Registro'
        ]);
    }

    public static function gratis(Router $router) {
        

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(!is_auth()) {
                header('Location: /login');
            }

            $token = substr(md5(uniqid(rand(),true)),0,8);

            //Creando los datos del registro
            $datos = [
                'paquete_id' => 3,
                'pago_id' => '',
                'token' => $token,
                'usuario_id' => $_SESSION['id']
            ];

            $registro = new Registro($datos);
            $resultado = $registro->guardar();

            if($resultado) {
                header('Location: /boleto?id=' . urlencode($registro->token));
            }

        }

        $router->render('registro/crear',[
            'titulo' => 'Finalizar Registro'
        ]);
    }

    public static function pagar() {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(!is_auth()) {
                header('Location: /login');
            }

            //Creando los datos del registro
            if(empty($_POST)) {
                echo json_encode([]);
                return;
            }

            $datos = $_POST;
            $datos['token'] = substr(md5(uniqid(rand(),true)),0,8);
            $datos['usuario_id'] = $_SESSION['id'];

            try {
                $registro = new Registro($datos);
                $resultado = $registro->guardar();

                if($resultado) {
                    echo json_encode($resultado);
                }

            } catch (\Throwable $th) {
                //throw $th;
                echo json_encode([
                    'resultado' => 'error'
                ]);
            }

        }

    }

    public static function boleto(Router $router) {

        $id = $_GET['id'];

        if(!$id || strlen($id) !== 8) {
            header('Location: /');
        }

        $registro = Registro::where('token',$id);

        if(!$registro) {
            header('Location: /');
        }

        $registro->usuario = Usuario::find($registro->usuario_id);
        $registro->paquete = Paquete::find($registro->paquete_id);

        $router->render('registro/boleto',[
            'titulo' => 'Asistencia a DevWebCamp',
            'registro' => $registro
        ]);
    }

}