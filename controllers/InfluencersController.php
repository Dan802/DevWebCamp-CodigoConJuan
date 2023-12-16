<?php 
namespace Controllers;

use MVC\Router;
use Model\Influencer;
use Intervention\Image\ImageManagerStatic as Image;

class InfluencersController {

    public static function index(Router $router) {

        $influencers = Influencer::all();

        $router->render('admin/influencers/index', [
            'titulo' => 'Influencers / conferencistas',
            'influencers' => $influencers
        ]);
    }

    public static function crear(Router $router) {

        $alertas = [];
        $influencer = new Influencer;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(!empty($_FILES['image']['tmp_name'])){
                $carpeta_imagenes = '../public/img/speakers';

                // Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0777, true);
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
            'influencer' => $influencer
        ]);
    }
}