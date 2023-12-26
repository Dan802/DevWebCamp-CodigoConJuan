<?php 

namespace Controllers;

use Model\EventoHorario;
use Model\Influencer;

class ApiInfluencers {

    public static function index() {
        $influencers = Influencer::all();
        echo json_encode($influencers);
    }

    public static function influencer () {
        $id = isset($_GET['id']) ? $_GET['id'] : false;
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id || $id < 1) {
            echo json_encode([]);
            return;
        }

        $influencer = Influencer::find($id);
        echo json_encode($influencer, JSON_UNESCAPED_SLASHES);
    }
}