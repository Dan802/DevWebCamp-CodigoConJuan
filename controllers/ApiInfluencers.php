<?php 

namespace Controllers;

use Model\EventoHorario;
use Model\Influencer;

class ApiInfluencers {

    public static function index() {
        $influencers = Influencer::all();
        echo json_encode($influencers);
    }
}