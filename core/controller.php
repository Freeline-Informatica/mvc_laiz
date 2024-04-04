<?php
class controller {
    public function __construct() {
		global $config;
	}

    public function loadView($view, $viewData = array()){
        extract($viewData);
        require_once 'views/' . $view . '.php';
    }

    public function loadTemplate($nomeView, $dadosModel = array()) {
        require 'views/template.php';
    }

    public function loadViewInTemplate($nomeView, $dadosModel = array()) {
        extract($dadosModel);
        require 'views/'.$nomeView.'.php';
    }

}


?>