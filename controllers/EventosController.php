<?php 
namespace Controllers;

use Classes\Paginacion;
use Model\Categoria;
use Model\Dia;
use Model\Evento;
use Model\Hora;
use Model\Influencer;
use MVC\Router;

class EventosController {

    public static function index(Router $router) {
        is_admin('/login');

        $pagina_actual = isset($_GET['page']) ? $_GET['page'] : '';
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/eventos?page=1');
        }

        $por_pagina = 7;
        $total = Evento::total();
        $paginacion = new Paginacion($pagina_actual, $por_pagina, $total);

        $eventos = Evento::paginar($por_pagina, $paginacion->offset());

        foreach($eventos as $evento) {
            // Añadimos nuevos datos en Evento para en la vista presentar solo informacion unicamente
            $evento->categoria = Categoria::find($evento->categoria_id); 
            $evento->dia = Dia::find($evento->dia_id); 
            $evento->hora = Hora::find($evento->hora_id); 
            $evento->influencer = Influencer::find($evento->influencer_id); 
        }
        
        $router->render('admin/eventos/index', [
            'titulo' => 'Eventos',
            'eventos' => $eventos,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router) {
        is_admin('/login');
        $alertas = [];

        $categorias = Categoria::all('ASC');
        $dias = Dia::all('ASC');
        $horas = Hora::all('ASC');
        // $fechaExacta = new FechaExacta();
        $evento = new Evento();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            is_admin('/login');
            
            $evento->sincronizar($_POST);
            // $evento->dia_id = (int)$_POST['dia'];

            $alertas = $evento->validar();

            if(empty($alertas)) {
                $resultado = $evento->guardar();

                if($resultado) {
                    header('Location: /admin/eventos?resultado=guardado');
                }
            }
        }

        $router->render('admin/eventos/crear', [
            'titulo' => 'Crear Evento',
            'alertas' => $alertas,
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas, 
            'evento' => $evento
        ]);
    }

    public static function editar(Router $router) {
        is_admin('/login');
        $alertas = [];

        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) header('Location: /admin/eventos');

        $evento = Evento::find($id);
        if(!$evento) header('Location: /admin/eventos');

        $categorias = Categoria::all('ASC');
        $dias = Dia::all('ASC');
        $horas = Hora::all('ASC');
        // $fechaExacta = new FechaExacta();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            is_admin('/login');
            
            $evento->sincronizar($_POST);
            // $evento->dia_id = (int)$_POST['dia'];

            $alertas = $evento->validar();

            if(empty($alertas)) {
                $resultado = $evento->guardar();

                if($resultado) {
                    header('Location: /admin/eventos?resultado=guardado');
                }
            }
        }

        $router->render('admin/eventos/editar', [
            'titulo' => 'Editar Evento',
            'alertas' => $alertas,
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas, 
            'evento' => $evento
        ]);
    }

    public static function eliminar() {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            is_admin('/login');

            $id = isset($_POST['id']) ? $_POST['id'] : false;  
            $id = filter_var($id, FILTER_VALIDATE_INT); 

            if(!$id) {
                header('Location: /admin/eventos');
            }
            
            $evento = Evento::find($id); 
        
            if(!$evento){
                header('Location: /admin/eventos');
            }

            $resultado = $evento->eliminar() ? header('Location: /admin/eventos?page=1&resultado=1') : false ;
        
            if(!$resultado) {
                debuguearSinExit('no se pudo eliminar :/');
            }

        }
    }
}