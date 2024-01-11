<?php 

namespace Controllers;

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Regalo;
use Model\Paquete;
use Model\Usuario;
use Model\Registro;
use Model\Categoria;
use Model\Influencer;

class RegistroController {

    public static function crear(Router $router) {
        (is_auth()) ? '' : header('Location: /login');

        // Verificar si ya eligió un plan
        $registro = Registro::where('usuario_id', $_SESSION['id']);

        // Si ya eligió un plan redirigimos al usuario
        if(isset($registro)) {
            if($registro->paquete_id === "3") { // Paquete gratis
                header('Location: /boleto?id='. urlencode($registro->token));
            }
    
            if($registro->paquete_id === "1") { //paquete presencial
                header('Location: /finalizar-registro/conferencias');
            }
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

    public static function conferencias(Router $router) {
        (is_auth()) ? '' : header('location: /login');

        $usuario_id = $_SESSION['id'];
        $registro = Registro::where('usuario_id', $usuario_id);

        (isset($registro->paquete_id)) ? '' : header('Location: /login');
        ($registro->paquete_id === "1") ? 'Tiene el paquete presencial' : header('Location: /login');

        $eventos = Evento::ordenar('hora_id', 'ASC');
        $eventos_formateados = [];

        foreach ($eventos as $evento) {
            $evento->categoria = Categoria::find($evento->categoria_id); 
            $evento->dia = Dia::find($evento->dia_id); 
            $evento->hora = Hora::find($evento->hora_id); 
            $evento->influencer = Influencer::find($evento->influencer_id); 
            
            switch ($evento->dia_id) {
                case "1":
                    $eventos_formateados = categoriaEvento("_v", $evento, $eventos_formateados);
                    break;
                    
                case "2":
                    $eventos_formateados = categoriaEvento("_s", $evento, $eventos_formateados);
                    break;
                        
                case "3":
                    $eventos_formateados = categoriaEvento("_d", $evento, $eventos_formateados);
                    break;
            }
        }

        $regalos = Regalo::all('ASC');

        $router->render('registro/conferencias', [
            'titulo' => 'Elige Workshops y Conferencias',
            'eventos' => $eventos_formateados,
            'regalos' => $regalos
        ]);
    }
}
