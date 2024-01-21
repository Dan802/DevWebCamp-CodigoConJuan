<?php

echo '6.  Desde funciones.php <br>';

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

    return str_contains($_SERVER['PATH_INFO'] ?? '/', $path) ? true : false;

}

function iniciarsession() {
    if(!isset($_SESSION)){
        session_start();
    }
}

function is_auth() : bool {
    if(!isset($_SESSION)){
        session_start();
    }

    return isset($_SESSION['nombre']) && !empty($_SESSION) ; //$_SESSION de authController
}

function is_admin($location) {
    (isset($_SESSION)) ? '' : session_start();

    if( isset($_SESSION['admin'])) {
        if(empty($_SESSION['admin'])){
            // La persona no es admin
            header('Location: '. $location);
        }
    } else {
        header('Location: '. $location);
    }
}

function is_admin2() {
    if ( !isset($_SESSION) ){
        session_start();
    } 

    if( isset($_SESSION['admin'])) {
        
        if($_SESSION['admin'] === "1"){
            return true;
        } else {
            return false;
        }
    } else {
       return false;
    }
}

/**
 * AOS
 * Agrega un atributo data-aos="" con una animacion aleatoria
 */
function aos_animacion() : void {
    $efectos = ['flip-left', 'flip-right', 'flip-up', 'flip-down', 'zoom-in', 'zoom-in-up', 'zoom-in-down', 'zoom-in-right'];
    $efecto = array_rand($efectos, 1);

    echo ' data-aos="' . $efectos[$efecto] . '" ';
}

function categoriaEvento($letra, $evento, $eventos_formateados) {
        
    if($evento->categoria_id === "1"){
        $eventos_formateados[ 'workshops' . $letra ][] = $evento;
    } else {
        $eventos_formateados[ 'conferencias' . $letra ][] = $evento;
    }
    return $eventos_formateados;
}