<?php 

namespace Controllers;

use Model\Evento;
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

        //CALCULAR LOS INGRESOS
        $ingresos = ($virtual * 46.1) + ($presencial * 189.54);

        //MAS Y MENOS EVENTOS DISPONIBLES
        $menos_disponibles = Evento::ordenarLimite('disponibles','ASC',5);
        $mas_disponibles = Evento::ordenarLimite('disponibles','DESC',5);
        
        $router->render('admin/dashboard/index',[
            'titulo' => 'Panel de Administración',
            'registros' => $registros,
            'ingresos' => $ingresos,
            'menos_disponibles' => $menos_disponibles,
            'mas_disponibles' => $mas_disponibles
        ]);
    }
}