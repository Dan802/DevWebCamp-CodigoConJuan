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