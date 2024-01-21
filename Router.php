<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function comprobarRutas()
    {
        $urlActual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $fn = $this->getRoutes[$urlActual] ?? null;
        } else {
            $fn = $this->postRoutes[$urlActual] ?? null;
        }

        if ( $fn ) {
            call_user_func($fn, $this);
        } else {
            header('Location: /404');
        }
    }

    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value; 
        }

        ob_start(); 

        include_once __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); // Limpia el Buffer

        //Utilizar el layout de acuerdo a la url: 
            $urlActual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';

            if(str_contains($urlActual,'admin')) {
                include_once __DIR__ . '/views/admin-layout.php';
            } else {
                include_once __DIR__ . '/views/layout.php';
            }

    }
}
