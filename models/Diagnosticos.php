<?php

namespace Model;

class Diagnosticos extends ActiveRecord {
    //Base de datos
    protected static $tabla = 'cie10';
    protected static $columnasDB = ['id', 'codigocie', 'diagnostico'];

    public $id;
    public $codigocie;
    public $diagnostico;



    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->codigocie = $args['codigocie'] ?? null;
        $this->diagnostico = $args['diagnostico'] ?? null;

    }

}