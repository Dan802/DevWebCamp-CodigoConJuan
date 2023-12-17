<?php 
namespace Controllers;

use Classes\Paginacion;
use MVC\Router;
use Model\Influencer;
use Intervention\Image\ImageManagerStatic as Image;

class InfluencersController {

    public static function index(Router $router) {

        is_admin('/login');

        // ======================= Paginación =======================
        $pagina_actual = isset($_GET['page']) ? $_GET['page'] : header('Location: /admin/influencers?page=1');
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/influencers?page=1');
        }
        
        $registros_por_pagina = 3;
        $total_registros = Influencer::total();
        
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total_registros);
        
        if($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/influencers?page=1');
        }

        // ======================= End Paginación =======================

        $influencers = Influencer::paginar($registros_por_pagina, $paginacion->offset());

        $router->render('admin/influencers/index', [
            'titulo' => 'Influencers / conferencistas',
            'influencers' => $influencers,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router) {

        is_admin('/login');
        $alertas = [];
        $influencer = new Influencer;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            is_admin('/login');

            if(!empty($_FILES['image']['tmp_name'])){
                $carpeta_imagenes = '../public/img/speakers';

                // Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_png = Image::make($_FILES['image']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['image']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $nombre_imagen = md5( uniqid( rand(), true ) );

                $_POST['image'] = $nombre_imagen;
            }

            // Cuando sanitizamos en guardar>crear>sanitizar, sanitizar espera un arreglo key value
            // Pero actualmente, redes es un arreglo con varios arreglos dentro
            // Es por esto que usamos json enconde para convertirlo en un string
            // Entonces $_POST['redes'] = "{"twitch":"", "twitter":"", "tiktok":""...}"
            $_POST['redes'] = json_encode( $_POST['redes'], JSON_UNESCAPED_SLASHES);
            //JSON_UNESCAPED_SLASHES por que las urls quedan raretes si no se usa
            
            $influencer->sincronizar($_POST);
            $alertas = $influencer->validar();

            if(empty($alertas)) {

                //Guardar las imagenes en la carpeta public/img
                $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');

                $resultado = $influencer->guardar();

                if($resultado) {
                    header('Location: /admin/influencers');
                }
            }
        }


        $router->render('admin/influencers/crear', [
            'titulo' => 'Registrar Influencer', 
            'alertas' => $alertas, 
            'influencer' => $influencer,
            'redes' => json_decode($influencer->redes)
        ]);
    }

    public static function editar(Router $router) {
        
        is_admin('/login');
        $alertas = [];

        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id) {
            header('Location: /admin/influencers');
        }

        $influencer = Influencer::find($id) ?? header('Location: /admin/influencers');
        $influencer->imagen_actual = $influencer->image;
        
        $str_to_object = json_decode($influencer->redes);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            is_admin('/login');
            if(!empty($_FILES['image']['tmp_name'])){
                $carpeta_imagenes = '../public/img/speakers';
                
                if(!is_dir($carpeta_imagenes)) {    // Crear la carpeta si no existe
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_png = Image::make($_FILES['image']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['image']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $nombre_imagen = md5( uniqid( rand(), true ) );

                $_POST['image'] = $nombre_imagen;
            } else {
                $_POST['image'] = $influencer->$imagen_actual;
            }

            $_POST['redes'] = json_encode( $_POST['redes'], JSON_UNESCAPED_SLASHES);
            $influencer->sincronizar($_POST);
            $alertas = $influencer->validar();

            if(empty($alertas)) {
                if(isset($nombre_imagen)) {
                    $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                    $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');
                }

                $resultado = $influencer->guardar();

                if($resultado) {
                    header('Location: /admin/influencers');
                }
            }

        }

        $router->render('admin/influencers/editar', [
            'titulo' => 'Editar Influencer', 
            'alertas' => $alertas, 
            'influencer' => $influencer,
            'redes' => $str_to_object
        ]);
    }

    public static function eliminar(Router $router) {

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            is_admin('/login');
            $id = $_POST['id'];  
            $id = filter_var($id, FILTER_VALIDATE_INT); 

            if(!$id) {
                header('Location: /admin/influencers');
            }
            
            $influencer = Influencer::find($id); 
        
            if(!$influencer){
                header('Location: /admin/influencers');
            }

            $resultado = $influencer->eliminar() ? header('Location: /admin/influencers') : false ;
        
            if(!$resultado) {
                debuguearSinExit('no se pudo eliminar :/');
            }

        }
    }
}