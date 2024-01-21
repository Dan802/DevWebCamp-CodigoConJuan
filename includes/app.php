<?php 

echo '3. Desde app.php <br>';

use Dotenv\Dotenv;
use Model\ActiveRecord;

echo '4. Use dotenv y activerecord bien <br>';

echo '5. requerimos el autoload.php <br>';
echo 'la ruta es: '. __DIR__ . '/../vendor/autoload.php <br>';

require __DIR__ . '/../vendor/autoload.php';

echo '6. Autoload.php requerido correctamente <br>';

// Añadir Dotenv
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

echo '7. Llamamos a dotenv con su respectiva funcion <br>';

echo '8. Requerimos funciones.php<br>';
require __DIR__ . '/funciones.php';
echo '9. funciones.php bien <br>';

echo '10. Requerimos databse.php<br>';
require 'database.php';
echo '11. databse.php bien <br>';

// Conectarnos a la base de datos
ActiveRecord::setDB($db);

echo '12. conexion a la bd bien<br>';
