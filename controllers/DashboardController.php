<?php 
namespace Controllers;

use MVC\Router;
use Model\Evento;
use Model\Usuario;
use Model\Registro;

class DashboardController {

    public static function index(Router $router) {

        is_admin('/login');

        // Obtener los últimos registros
        $registros = Registro::getNoNull('usuario_id', 5);
    
        if(sizeof($registros) > 0) {
            foreach($registros as $registro) {

                if(isset($registro->usuario_id)) {
                    $registro->usuario = Usuario::find($registro->usuario_id);
                }
            }
        }

        // Calcular los ingresos
        $virtuales = Registro::total('paquete_id', 2);
        $presenciales = Registro::total('paquete_id', 1);

        $ingresos = ($virtuales * 46.41) + ($presenciales * 189.54);

        //Obtener evento socn más y menos lugares disponibles
        $menos_disponibles = Evento::ordenarLimite('disponibles', 'ASC', 5);
        $mas_disponibles = Evento::ordenarLimite('disponibles', 'DESC', 5);

        $router->render('admin/dashboard/index', [
            'titulo' => 'Panel de administración.',
            'registros' => $registros,
            'ingresos' => $ingresos,
            'menos_disponibles' => $menos_disponibles,
            'mas_disponibles' => $mas_disponibles
        ]);
    }
}