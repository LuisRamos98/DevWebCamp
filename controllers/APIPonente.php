<?php

namespace Controllers;

use Model\Ponente;

class APIPonente {

    public static function index() {

        $ponentes = Ponente::all();
        echo json_encode($ponentes);
    }

    public static function ponente() {

        $id = $_GET['id'];
        $id = filter_var($id,FILTER_VALIDATE_INT);

        $ponente = Ponente::find($id);

        echo json_encode($ponente, JSON_UNESCAPED_SLASHES);
    }
}