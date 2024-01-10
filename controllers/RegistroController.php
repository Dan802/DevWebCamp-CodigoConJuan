<?php 

namespace Controllers;

use MVC\Router;
use Model\Paquete;
use Model\Usuario;
use Model\Registro;

class RegistroController {

    public static function crear(Router $router) {
        (is_auth()) ? '' : header('Location: /login');

        // Verificar si ya eligió un plan
        $registro = Registro::where('usuario_id', $_SESSION['id']);

        if(isset($registro) && $registro->paquete_id === "3") {
            header('Location: /boleto?id='. urlencode($registro->token));
        }


        $router->render('registro/crear', [
            'titulo' => 'Finalizar Registro'
        ]);
    }

    public static function gratis(Router $router) {
        (is_auth()) ? '' : header('Location: /login'); 
        
        // Verificar si ya eligió un plan
        $registro = Registro::where('usuario_id', $_SESSION['id']);
            
        if(isset($registro) && $registro->paquete_id === "3") {
            header('Location: /boleto?id='. urlencode($registro->token));
        }
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            (is_auth()) ? '' : header('Location: /login');  
            
            $token = substr( md5(uniqid( rand(), true)), 0, 8);
            // substr: Corta el string

            // Crear registro
            $datos = array(
                'paquete_id' => 3, 
                'pago_id' => '',
                'token' => $token,
                'usuario_id' => $_SESSION['id']
            );

            $registro = new Registro($datos);
            $resultado = $registro->guardar();

            if($resultado) {
                header('Location: /boleto?id='. urlencode($registro->token));
            }
        }

        $router->render('registro/crear', [
            'titulo' => 'Finalizar Registro'
        ]);
    }

    public static function boleto(Router $router) {

        $id = isset($_GET['id']) ? $_GET['id'] : false;
        
        if(strlen($id) !== 8) {
            header('Location: /');
        }

        $registro = Registro::where('token', $id);

        if(!$registro) {
            header('Location: /');
        }

        // Llenar las tablas de referencia
        $registro->usuario = Usuario::find($registro->usuario_id);
        $registro->paquete = Paquete::find($registro->paquete_id);

        $router->render('registro/boleto', [
            'titulo' => 'Boleto',
            'registro' => $registro
        ]);
    }

    public static function pagar() { 
        // ESTA RUTA ACTUARÁ COMO API
        if(!is_auth()) {
            echo json_encode([]);
            return;
        }; 
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            if(empty($_POST)) {
                echo json_encode([]);
                return;
            }
            
            // Crear - Almacenar el registro del pago
            $datos = $_POST;
            $datos['token'] = substr( md5(uniqid( rand(), true)), 0, 8); // substr: Corta el string
            $datos['usuario_id'] = $_SESSION['id'];

            try {
                $registro = new Registro($datos);
                $resultado = $registro->guardar();
                echo json_encode($resultado);
            } catch (\Throwable $th) {
                echo json_encode([
                    'resultado' => 'error'
                ]);
            }
        }
    }
}
