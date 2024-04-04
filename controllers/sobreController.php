<?php
class sobreController extends controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $array = array();
        $this->loadTemplate("sobre", $array);
    }

    public function laiz(){
        echo "pág laiz";
    }
}
?>