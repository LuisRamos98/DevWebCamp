<?php

namespace Model;

class Regalo extends ActiveRecord {

    protected static $tabla = 'regalos';
    protected static $columnasDB = ['id','nombre'];

    public $id;
    public $nombre;

}