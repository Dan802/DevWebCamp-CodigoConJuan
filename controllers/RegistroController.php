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
use Model\EventosRegistros;
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
                return;
            }
            
            if($registro->paquete_id === "2") { //paquete virtual
                header('Location: /boleto?id='. urlencode($registro->token));
                return;
            }
            
            if($registro->paquete_id === "1") { //paquete presencial
                header('Location: /finalizar-registro/conferencias');
                return;
            }
            
            return;
        }

        $router->render('registro/crear', [
            'titulo' => 'Finalizar Registro'
        ]);
    }

    public static function gratis() {
        (is_auth()) ? '' : header('Location: /login'); 
        
        // Verificar si ya eligió un plan
        $registro = Registro::where('usuario_id', $_SESSION['id']);
            
        if(isset($registro) && $registro->paquete_id === "3") {
            header('Location: /boleto?id='. urlencode($registro->token));
            return;
        }
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            (is_auth()) ? '' : header('Location: /login');  
            
            $token = substr( md5(uniqid( rand(), true)), 0, 8);
            // substr: Corta el string

            // Crear registro
            $datos = [
                'paquete_id' => 3, 
                'pago_id' => '',
                'token' => $token,
                'usuario_id' => $_SESSION['id'],
                'regalo_id' => 0
            ];

            $registro = new Registro($datos);
            $resultado = $registro->guardar();

            if($resultado) {
                header('Location: /boleto?id='. urlencode($registro->token));
            } else {
                header('Location: /finalizar-registro?error=DontSaveDB');
            }
        }
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
        $registro = Registro::where('usuario_id', $usuario_id) ?? header('Location: /login');
        
        (isset($registro->paquete_id)) ?? header('Location: /login');
        
        if($registro->paquete_id === "2" || $registro->paquete_id === "3") {
            header('Location: /boleto?id='. urlencode($registro->token));  
            return;
        } 

        if($registro->paquete_id !== "1"){
            header(('Location: /'));
            return;
        } 
        
        if(isset($registro->regalo_id)) {
            
            if($registro->regalo_id !== '0') {
                header('Location: /boleto?id='. urlencode($registro->token));
                return;
            }
        }

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

        // Manejando el registro mediante post

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            (is_auth()) ? '' : header('location: /login');

            $eventos = explode(',', $_POST['eventos']); // Viene los id de los eventos

            if(empty($eventos)) {
                echo json_encode(['resultado' => false]);
                return;
            }

            $registro = Registro::where('usuario_id', $_SESSION['id']);
            if(!isset($registro) || $registro->paquete_id !== "1") {
                echo json_encode(['resultado' => false]);
                return;
            }

            $eventos_array = [];

            // Validar disponibilidad de los eventos seleccionados
            foreach($eventos as $evento_id) {
                $evento = Evento::find($evento_id);

                // comprobar que el evento exista
                if(!isset($evento) || $evento->disponibles === '0') {
                    echo json_encode(['resultado' => false]);
                    return;
                }

                $eventos_array[] = $evento;
            }
            
            foreach($eventos_array as $evento){
                $evento->disponibles -= 1;
                $evento->guardar();

                // Almacenar el registro 
                // id del registro + evento de interes

                $datos = [
                    'evento_id' => (int) $evento->id,
                    'registro_id' => (int) $registro->id
                ];

                $registro_usuario = new EventosRegistros($datos);
                $registro_usuario->guardar();
            }

            // Almacenar el regalo
            $registro->sincronizar(['regalo_id' => $_POST['regalo_id']]);
            $resultado = $registro->guardar();

            if($resultado) {
                echo json_encode([
                    'resultado' => $resultado,
                    'token' => $registro->token
                ]);
            }else {
                echo json_encode(['resultado' => $resultado]);
            }

            return;
        }

        $router->render('registro/conferencias', [
            'titulo' => 'Elige los Torneos y Conferencias',
            'eventos' => $eventos_formateados,
            'regalos' => $regalos
        ]);
    }
}
