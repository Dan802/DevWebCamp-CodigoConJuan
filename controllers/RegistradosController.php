<?php 
namespace Controllers;

use MVC\Router;
use Model\Paquete;
use Model\Usuario;
use Model\Registro;
use Classes\Paginacion;
use Model\Regalo;

class RegistradosController {

    public static function index(Router $router) {

        is_admin('/login');
        
        // ======================= Paginación =======================
        $pagina_actual = isset($_GET['page']) ? $_GET['page'] : header('Location: /admin/influencers?page=1');
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/registrados?page=1');
        }
        
        $registros_por_pagina = 5;
        $total_registros = Registro::total();
        
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total_registros);
        
        if($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/registrados?page=1');
        }
        
        // ======================= End Paginación =======================

        $registros = Registro::paginar($registros_por_pagina, $paginacion->offset());

        // debuguearConExit($registros);
        
        foreach($registros as $registro) {
            $registro->usuario = Usuario::find($registro->usuario_id);
            $registro->paquete = Paquete::find($registro->paquete_id);
            $registro->regalo = Regalo::find($registro->regalo_id);
        }
    
        $router->render('admin/registrados/index', [
            'titulo' => 'Usuarios Registrados',
            'registros' => $registros,
            'paginacion' => $paginacion->paginacion()
        ]);
    }
}