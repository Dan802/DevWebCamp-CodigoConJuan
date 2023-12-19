<?php 

namespace Model;

class FechaExacta extends ActiveRecord {
    protected static $tabla = 'dias';
    protected static $columnasDB = ['id', 'dia_inicio', 'dia_fin'];

    public $id;
    public $dia_inicio;
    public $dia_fin;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->dia_inicio = $args['dia_inicio'] ?? null;
        $this->dia_fin = $args['dia_fin'] ?? null;
    }

    public function validar() {
        $date_start = date_parse_from_format('YYYY/m/d', $this->dia_inicio);
        $date_end = date_parse_from_format('YYYY/m/d', $this->dia_fin);

        if(!$this->dia_inicio || checkdate($date_start['month'], $date_start['day'], $date_start['year'])){
            self::$alertas['error'][] = 'La fecha no es correcta';
        }
        
        if(!$this->dia_fin || checkdate($date_end['month'], $date_end['day'], $date_end['year'])){
            self::$alertas['error'][] = 'La fecha no es correcta';
        }
    }
}