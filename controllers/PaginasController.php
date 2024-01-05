<?php

namespace Controllers;

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Categoria;
use Model\Influencer;

class PaginasController {

    public static function index(Router $router) {

        $eventos = Evento::ordenar('hora_id', 'ASC');
        $eventos_formateados = new Evento;

        foreach ($eventos as $evento) {
            $evento->categoria = Categoria::find($evento->categoria_id); 
            $evento->dia = Dia::find($evento->dia_id); 
            $evento->hora = Hora::find($evento->hora_id); 
            $evento->influencer = Influencer::find($evento->influencer_id); 

            switch ($evento->dia_id) {
                case "1":
                    $eventos_formateados->terminacion("_v", $evento);
                    break;

                case "2":
                    $eventos_formateados->terminacion("_s", $evento);
                    break;

                case "3":
                    $eventos_formateados->terminacion("_d", $evento);
                    break;
            }
        }

        $influencers_total = Influencer::total();
        $conferencias_total = Evento::total('categoria_id', '1');
        $workshops_total = Evento::total('categoria_id', '2');

        $influencers = Influencer::all();

        $router->render('paginas/index', [
            'titulo' => 'Inicio',
            'eventos' => $eventos_formateados->eventos_formateados,
            'influencers_total' => $influencers_total,
            'conferencias_total' => $conferencias_total,
            'workshops_total' => $workshops_total,
            'influencers' => $influencers
        ]);
    }

    public static function evento(Router $router) {

        $router->render('paginas/devwebcamp', [
            'titulo' => 'Sobre WebDevCamp'
        ]);
    }

    public static function paquetes(Router $router) {

        $router->render('paginas/paquetes', [
            'titulo' => 'Paquetes webdevcamp'
        ]);
    }

    public static function conferencias(Router $router) {

        $eventos = Evento::ordenar('hora_id', 'ASC');
        $eventos_formateados = new Evento;

        foreach ($eventos as $evento) {
            $evento->categoria = Categoria::find($evento->categoria_id); 
            $evento->dia = Dia::find($evento->dia_id); 
            $evento->hora = Hora::find($evento->hora_id); 
            $evento->influencer = Influencer::find($evento->influencer_id); 

            switch ($evento->dia_id) {
                case "1":
                    $eventos_formateados->terminacion("_v", $evento);
                    break;

                case "2":
                    $eventos_formateados->terminacion("_s", $evento);
                    break;

                case "3":
                    $eventos_formateados->terminacion("_d", $evento);
                    break;
            }
        }

        $router->render('paginas/conferencias', [
            'titulo' => 'Conferencias & Workshops',
            'eventos' => $eventos_formateados->eventos_formateados
        ]);
    }

    public static function error(Router $router) {

        $router->render('paginas/error', [
            'titulo' => 'Error'
        ]);
    }
}