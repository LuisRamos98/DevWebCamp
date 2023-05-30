<?php 

namespace Controllers;

use Model\Dia;
use MVC\Router;
use Model\Categoria;
use Model\Hora;

class EventosController {

    public static function index(Router $router) {

        $router->render('admin/eventos/index',[
            'titulo' => 'Conferencias / Workshops'
        ]);
    }

    public static function crear(Router $router) {

        $alertas = [];
        $categorias = Categoria::all();
        $dias = Dia::all('ASC');
        $horas = Hora::all('ASC');

        $router->render('admin/eventos/crear',[
            'titulo' => 'Registrar Evento',
            'alertas' => $alertas,
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas
        ]);
    }
}