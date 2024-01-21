<?php 

echo '3. Desde app.php <br>';

use Dotenv\Dotenv;
use Model\ActiveRecord;
require __DIR__ . '/../vendor/autoload.php';

echo '4. requerimos el autoload.php <br>';

// Añadir Dotenv
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

echo '5. llamamos a dotenv con su respectiva funcion <br>';

echo '6. requerimos funciones.php<br>';

return;

require '/funciones.php';
require 'database.php';

// Conectarnos a la base de datos
ActiveRecord::setDB($db);