<?php 

namespace Controllers;

use Model\Regalo;
use Model\Registro;

class ApiRegalos {

    public static function index() {

        if(!is_admin2()) {
            echo json_encode([]);
            return;
        }
        
        $regalos = Regalo::all();
        
        if($regalos[9]->id === "0"){
            unset($regalos[9]);
        }
        
        foreach($regalos as $regalo) {
            $regalo->total = Registro::totalArray(['regalo_id' => $regalo->id, 'paquete_id' => "1"]);
        }
        
        echo json_encode($regalos);
        return; 
    }
}