<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AuthController;
use Controllers\EventosController;
use Controllers\RegalosController;
use Controllers\DashboardController;
use Controllers\InfluencersController;
use Controllers\RegistradosController;

$router = new Router();

// Login
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

//Admin
$router->get('/admin/dashboard', [DashboardController::class, 'index']);
$router->get('/admin/influencers', [InfluencersController::class, 'index']);
$router->get('/admin/eventos', [EventosController::class, 'index']);
$router->get('/admin/registrados', [RegistradosController::class, 'index']);
$router->get('/admin/regalos', [RegalosController::class, 'index']);

//Admin - Influences
$router->get('/admin/influencers/crear', [InfluencersController::class, 'crear']);
$router->post('/admin/influencers/crear', [InfluencersController::class, 'crear']);
$router->get('/admin/influencers/editar', [InfluencersController::class, 'editar']);
$router->post('/admin/influencers/editar', [InfluencersController::class, 'editar']);
$router->post('/admin/influencers/eliminar', [InfluencersController::class, 'eliminar']);
$router->comprobarRutas();