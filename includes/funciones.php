<?php

function debuguearConExit($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
function debuguearSinExit($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
}
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

/**
 * @return bool si la ruta contiene el string que se le pasa
 */
function pagina_actual($path) {
    return str_contains($_SERVER['PATH_INFO'], $path) ? true : false;
}

function is_auth() : bool {
    session_start();
    return isset($_SESSION['nombre']) && !empty($_SESSION) ; //$_SESSION de authController
}

function is_admin($location) {
    session_start();

    if( isset($_SESSION['admin'])) {
        if(empty($_SESSION['admin'])){
            header('Location: '. $location);
        }

        // Else: La persona es admin
    } else {
        header('Location: '. $location);
    }
}