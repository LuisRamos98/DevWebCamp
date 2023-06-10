<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AuthController;
use Controllers\AdminController;
use Controllers\APIEvento;
use Controllers\APIPonente;
use Controllers\EventosController;
use Controllers\PaginasController;
use Controllers\RegalosController;
use Controllers\PonentesController;
use Controllers\RegistradosController;
use Controllers\RegistroController;

$router = new Router();


// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

// Confirmación de Cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);

// Zona de Administración
$router->get('/admin/dashboard', [AdminController::class, 'index']);

$router->get('/admin/ponentes', [PonentesController::class, 'index']);
$router->get('/admin/ponentes/crear', [PonentesController::class, 'crear']);
$router->post('/admin/ponentes/crear', [PonentesController::class, 'crear']);
$router->get('/admin/ponentes/editar', [PonentesController::class, 'editar']);
$router->post('/admin/ponentes/editar', [PonentesController::class, 'editar']);
$router->post('/admin/ponentes/eliminar', [PonentesController::class, 'eliminar']);

$router->get('/admin/eventos', [EventosController::class, 'index']);
$router->get('/admin/eventos/crear', [EventosController::class, 'crear']);
$router->post('/admin/eventos/crear', [EventosController::class, 'crear']);
$router->get('/admin/eventos/editar', [EventosController::class, 'editar']);
$router->post('/admin/eventos/editar', [EventosController::class, 'editar']);
$router->post('/admin/eventos/eliminar', [EventosController::class, 'eliminar']);

//API Eventos
$router->get('/api/eventos',[APIEvento::class,'index']);
// FIN API Eventos
//API ponentes
$router->get('/api/ponentes',[APIPonente::class,'index']);
// FIN API ponentes
//API ponente
$router->get('/api/ponente',[APIPonente::class,'ponente']);
// FIN API ponente

$router->get('/admin/registrados', [RegistradosController::class, 'index']);

$router->get('/admin/regalos', [RegalosController::class, 'index']);

//Registros de Usuarios
$router->get('/finalizar-registro',[RegistroController::class,'crear']);
$router->post('/finalizar-registro/gratis',[RegistroController::class,'gratis']);

//Boleto Virtual
$router->get('/boleto',[RegistroController::class,'boleto']);


//ZONA PUBLICA
$router->get('/',[PaginasController::class,'index']);
$router->get('/devwebcamp',[PaginasController::class,'evento']);
$router->get('/paquetes',[PaginasController::class,'paquetes']);
$router->get('/workshop-conferencias',[PaginasController::class,'conferencias']);
$router->get('/404',[PaginasController::class,'error']);


$router->comprobarRutas();