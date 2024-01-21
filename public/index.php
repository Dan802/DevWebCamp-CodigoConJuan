<?php 
debuguearSinExit('desde index.php antes de incluir app.php');

require_once __DIR__ . '/../includes/app.php';
debuguearSinExit('desde index.php despues de incluir app.php');

use MVC\Router;
use Controllers\ApiEventos;
use Controllers\ApiInfluencers;
use Controllers\ApiRegalos;
use Controllers\AuthController;
use Controllers\EventosController;
use Controllers\RegalosController;
use Controllers\DashboardController;
use Controllers\InfluencersController;
use Controllers\PaginasController;
use Controllers\RegistradosController;
use Controllers\RegistroController;

$router = new Router();

// *************** AREA PUBLICA ***************
$router->get('/', [PaginasController::class, 'index']);
$router->get('/tetrisCoders', [PaginasController::class, 'evento']);
$router->get('/paquetes', [PaginasController::class, 'paquetes']);
$router->get('/torneos-conferencias', [PaginasController::class, 'conferencias']);
$router->get('/404', [PaginasController::class, 'error']);

// *************** REGISTRO DE USUARIOS ***************
$router->get('/finalizar-registro', [RegistroController::class, 'crear']);
$router->post('/finalizar-registro/gratis', [RegistroController::class, 'gratis']);
$router->get('/finalizar-registro/conferencias', [RegistroController::class, 'conferencias']);
$router->post('/finalizar-registro/conferencias', [RegistroController::class, 'conferencias']);
$router->post('/finalizar-registro/pagar', [RegistroController::class, 'pagar']);

// *************** BOLETO VIRTUAL ***************
$router->get('/boleto', [RegistroController::class, 'boleto']);

// *************** LOGIN ***************
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);
$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);

// *************** ADMIN ***************
$router->get('/admin/dashboard', [DashboardController::class, 'index']);
$router->get('/admin/influencers', [InfluencersController::class, 'index']);
$router->get('/admin/eventos', [EventosController::class, 'index']);
$router->get('/admin/registrados', [RegistradosController::class, 'index']);
$router->get('/admin/regalos', [RegalosController::class, 'index']);

// *************** ADMIN-INFLUENCERS ***************
$router->get('/admin/influencers/crear', [InfluencersController::class, 'crear']);
$router->post('/admin/influencers/crear', [InfluencersController::class, 'crear']);
$router->get('/admin/influencers/editar', [InfluencersController::class, 'editar']);
$router->post('/admin/influencers/editar', [InfluencersController::class, 'editar']);
$router->post('/admin/influencers/eliminar', [InfluencersController::class, 'eliminar']);

// *************** ADMIN-EVENTOS ***************
$router->get('/admin/eventos/crear', [EventosController::class, 'crear']);
$router->post('/admin/eventos/crear', [EventosController::class, 'crear']);
$router->get('/admin/eventos/editar', [EventosController::class, 'editar']);
$router->post('/admin/eventos/editar', [EventosController::class, 'editar']);
$router->post('/admin/eventos/eliminar', [EventosController::class, 'eliminar']);

// *************** API ***************
$router->get('/api/evento-horario', [ApiEventos::class, 'index']);
$router->get('/api/influencers', [ApiInfluencers::class, 'index']);
$router->get('/api/influencer', [ApiInfluencers::class, 'influencer']);
$router->get('/api/regalos', [ApiRegalos::class, 'index']);

$router->comprobarRutas();