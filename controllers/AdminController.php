<?php 

namespace Controllers;

use Model\Registro;
use Model\Usuario;
use MVC\Router;

class AdminController {

    public static function index(Router $router) {

        $registros = Registro::get(5);

        foreach($registros as $registro) {
            $registro->usuario = Usuario::find($registro->usuario_id);
        }

        $virtual = Registro::total('paquete_id', 2);
        $presencial = Registro::total('paquete_id', 3);

        $ingresos = ($virtual * 46.1) + ($presencial * 189.54);

        $router->render('admin/dashboard/index',[
            'titulo' => 'Panel de Administración',
            'registros' => $registros,
            'ingresos' => $ingresos
        ]);
    }
}