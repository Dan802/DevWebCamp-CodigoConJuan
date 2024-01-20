<?php 
namespace Controllers;

use MVC\Router;

class RegalosController {

    public static function index(Router $router) {
        is_admin('/login');

        $router->render('admin/regalos/index', [
            'titulo' => 'Lista de regalos'
        ]);
    }
}