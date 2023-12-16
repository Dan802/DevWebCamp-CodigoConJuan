<?php 

namespace Model;

class Influencer extends ActiveRecord {
    protected static $tabla = 'influencers';
    protected static $columnasDB = ['id', 'firstName', 'lastName', 'city', 'country', 'image', 'tags', 'redes'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->firstName = $args['firstName'] ?? '';
        $this->lastName = $args['lastName'] ?? '';
        $this->city = $args['city'] ?? '';
        $this->country = $args['country'] ?? '';
        $this->image = $args['image'] ?? '';
        $this->tags = $args['tags'] ?? '';
        $this->redes = $args['redes'] ?? '';
    }

    public function validar() {
        if(!$this->firstName) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if(!$this->lastName) {
            self::$alertas['error'][] = 'El Apellido es Obligatorio';
        }
        if(!$this->city) {
            self::$alertas['error'][] = 'La Ciudad es Obligatoria';
        }
        if(!$this->country) {
            self::$alertas['error'][] = 'El País es Obligatorio';
        }
        if(!$this->image) {
            self::$alertas['error'][] = 'La imagen es obligatoria';
        }
        if(!$this->tags) {
            self::$alertas['error'][] = 'El Campo áreas es obligatorio';
        }
    
        return self::$alertas;
    }
}