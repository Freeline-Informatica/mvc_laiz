# MVC

* mvc = foi feito para separar o que é gráfico e o que é código

* user -> controller -> model -> controller -> view -> user

**view:** parte visual, págs em html

**controler:** intermediário do usuário, entre model e view

**model:** interação com o banco de dados

* apenas o arquivo index é acessado nesse modelo 

#

# SEG

* assets
  * css
    * style.css
  * imgs
  * js
    * script.js
      
* controllers
  * homeController.php
  * notFoundController.php
    
* core
  * Controller.php
  * Core.php
  * Model.php
 
* helpers
   * ExHelper.php

* models
  * User.php

* views
  * login.php
  * home.php
  * template.php
 
.htaccess, config.php, enviornmenti.php, index.php... na raíz do projeto

#

# BASE

#

## .htacess

* para afunilar tudo que o usuário acessa para o index, é necessário o .htacess

`RewriteEngine On` 		-> ativa o rewrite

`RewriteCond %{REQUEST_FILENAME} !-f`	-> condiciona: se acessar o nome de um arquivo real, ele vai ser acessado

`RewriteCond %{REQUEST_FILENAME} !-d`	-> condiciona: se acessar o nome de um diretório real, ele vai ser acessado

`RewriteRule ^(.*)$ /mvc/index.php/$1 [L]`	-> caso não seja acessado nada

`RewriteRule ^(.*)$ /mvc/index.php/$1 [L]`	-> se a condição for falsa, ele ira redirecionar para o index

#

## config.php
### configuração do banco de dados
    * `<?php 
        require 'environment.php';                                    // constante explicada abaixo
        
        global $config;
        global $db;
        
        $config = array();
        if (ENVIRONMENT == 'development'){                            // onde é utilizada a constante
            define('BASE_URL', "http://localhost/php7/mvc_laiz/");
            $config['dbname'] = 'estoque_laiz';                       // nome do banco
            $config['host'] = '192.168.1.200';                        // host... localhost ou o ip
            $config['dbuser'] = 'root';                               // usuário do banco
            $config['dbpass'] = '';                                   // senha do banco
        } else {
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $config['dbname'] = 'nova_loja';
            $config['host'] = '192.168.1.200';
            $config['dbuser'] = 'root';
            $config['dbpass'] = '';
        }
        
        $db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);`

#

 ## environment.php
  * constante que se refere ao ambiente de execução no qual o código está sendo executado.
    * **ambiente de desenvolvimento:** é onde os desenvolvedores escrevem e testam o código antes de disponibilizá-lo ao público.
    * **ambiente de produção:** é onde o aplicativo está disponível para os usuários finais.
   
    `<?php
        define("ENVIRONMENT", "development");`

#

## index.php
### onde tudo é acessado
    `<?php
        session_start();                                                  // esta linha inicia uma nova sessão ou resume a sessão existente, permitindo o uso de variáveis de sessão
        require 'config.php';                                             // requer o arquivo config.php, citado anteriomente
        
        spl_autoload_register(function ($class){                          // um autoload esté sendo carregado, isso permite carregar automaticamente as classes necessárias do aplicativo quando elas são instanciadas
            if(file_exists('controllers/'.$class.'.php')) {               // basicamente chamando todos autoloads e carregando eles, para que tudo que está dentro deles funione
                    require_once 'controllers/'.$class.'.php';
            } elseif(file_exists('models/'.$class.'.php')) {
                    require_once 'models/'.$class.'.php';
            } elseif(file_exists('core/'.$class.'.php')) {
                    require_once 'core/'.$class.'.php';
            } elseif(file_exists('helpers/'.$class.'.php')) {
                    require_once 'helpers/'.$class.'.php';
            }
        });
        
        $core = new Core();                                              // isso instancia um objeto da classe Core. esta classe é parte do núcleo que está sendo desenvolvido.
        $core->run();                                                    // inicia o roteamento e controla o fluxo do aplicativo, redirecionando as solicitações para os controladores apropriados com base nos URLs solicitados.`            

#

## Core.php
### núcleo
é responsável por controlar o roteamento das requisições HTTP em um aplicativo web baseado em PHP, determinando qual controlador e ação deve ser executado com base na URL requisitada

         <?php
         class Core {                                                         // a classe Core é responsável por inicializar e executar a lógica central
         
         	public function run() {                                           // obtém a URL requisitada, ou define como '/' caso não seja especificada
                 $url = '/'.(isset($_GET['url'])?$_GET['url']:'');
         
         		$params = array();                                             // inicializa um array para os parâmetros da URL
           
         		if(!empty($url) && $url != '/') {                              
         			$url = explode('/', $url);
         			array_shift($url);
         
         			$currentController = $url[0].'Controller';                  //o primeiro segmento da URL é considerado o nome do controlador
         			array_shift($url);
         
         			if(isset($url[0]) && $url[0] != '/') {                      // se houver um próximo segmento na URL, ele é considerado a ação do controlador
         				$currentAction = $url[0];
         				array_shift($url);
         			} else {
         				$currentAction = 'index';                                // a ação padrão é 'index'
         			}
                                                            
         			if(count($url) > 0) {                                       // qualquer segmento restante na URL é considerado como parâmetros  
         				$params = $url;      
         			}
                                                                              // como: /home/edit/3
                                                                              o número 3 é parâmetro, edit é a ação do controlador e home é o nome do controlador
         		} else {
         			$currentController = 'homeController';                     // URL vazia = controlador padrão definido como 'homeController' e a ação padrão como 'index'
         			$currentAction = 'index';
         		}
                     
         		if(!file_exists('controllers/'.$currentController.'.php')) {  // se o controlador não existir, define o controlador de erro padrão
         			$currentController = 'notFoundController'; 
         			$currentAction = 'index';
         		}
         
         		$c = new $currentController();                                // fornece o controlador apropriado
         
         		if(!method_exists($c, $currentAction)) {                      // ve se a ação especificada dentro do controlador existe, senão, utiliza a ação padrão
         			$currentAction = 'index';
         		}
         		call_user_func_array(array($c, $currentAction), $params);     // puxa a ação do controlador com os parâmetros fornecidos
         	}

         }

#

## Controller.php
### controlador principal
é uma classe base para outros controladores no aplicativo

         <?php
         class Controller {                                                      // setar a classe Controler 
         
         	protected $db;                                             // criação de uma propriedade protegida chamada $db, se refere a uma conexão com o banco de dados.                                                     
         	public function __construct() { '                          // essa função "construtora" recebe a configuração global
         		global $config;
         	}
         	
         	public function loadView($viewName, $viewData = array()) {         // essa função é utilizada dentro dos controllers (mostrados mais a frente)... a função é responsável por carregar na view e passar dados para ela
         		extract($viewData);                                             // extrai os dados da view para que possam ser acessados
         		include 'views/'.$viewName.'.php';                              // inclue os dados da view especificada
         	}
         
         	public function loadTemplate($viewName, $viewData = array()) {      // essa função é responsável por carregar um template que contém a estrutura da página
         		include 'views/template.php';                                    // basicamente inclui o arquivo do template que contém a estrutura HTML básica
         	}
         
         	public function loadViewInTemplate($viewName, $viewData) {           // essa função é responsável por carregar uma view dentro de um template
               extract($viewData);                                               // essa linha extrai os dados da view para que possam ser acessados
         		include 'views/'.$viewName.'.php';                                // inclui o arquivo da view especificada dentro do template
         	}
         
         }

#

## Model
### modelo base
é uma classe base para outros modelos no aplicativo

         <?php
         class Model {                            // setar a classe Model
         	
         	protected $db;                        
         
         	public function __construct() {
         		global $db;                       // a função construtor recebe uma instância do objeto de conexão com o banco de dados global
         		$this->db = $db;                  // define a propriedade protegida $db como o pedido do objeto de conexão com o banco de dados global
         	}
         }

#

## homeContrller
### exemplo de controller

         <?php
         class homeController extends Controller {
         
             private $user;
         
             public function __construct(){
                 parent::__construct();
         
                 $this->user = new Users();
                 if(!$this->user->checkLogin()){                     
                     header("Location: ".BASE_URL."login");
                     exit;
                 }
             }
         
             public function index() {
                 $data = array(
         
                     'menu' => array(
                         BASE_URL.'home/add' => 'Adcionar Produto',
                         BASE_URL.'home/relatorio' => 'Relatório',
                         BASE_URL.'login/sair' => 'Sair'
                     )
         
                 );
                 $p = new Products();
         
                 $s = '';
         
                 if(!empty($_GET['busca'])){
                     $s = $_GET['busca'];
                 }
         
                 $data['list'] = $p->getProducts($s);
         
                 $this->loadTemplate('home', $data);
             }
         
             public function add(){
                 $data = array(
                     'menu' => array (
                         BASE_URL => 'Voltar'
                     )
                 );
                 $p = new Products();
                 $filters = new FiltersHelper();
         
                 if(!empty($_POST['cod'])){
                     $cod = filter_input(INPUT_POST, 'cod', FILTER_VALIDATE_INT);
                     $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                     $price = $filters->filter_post_money('price');
                     $quantity = $filters->filter_post_money('quantity');
                     $min_quantity = $filters->filter_post_money('min_quantity');
         
         
                     if($cod && $name && $price && $quantity && $min_quantity) {
                         $p->addProduct($cod, $name, $price, $quantity, $min_quantity);
         
                         header("Location: ".BASE_URL);
                         exit;
                     } else {
                         $data['warning'] = 'digite os campos corretamente';
                     }
                 }
         
                 $this->loadTemplate('add', $data);
         
             }
         
         
         
             public function edit($id){
                 $data = array(
                     'menu' => array (
                         BASE_URL => 'Voltar'
                     )
                 );
                 $p = new Products();
                 $filters = new FiltersHelper();
         
                 if(!empty($_POST['cod'])){
                     $cod = filter_input(INPUT_POST, 'cod', FILTER_VALIDATE_INT);
                     $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                     $price = $filters->filter_post_money('price');
                     $quantity = $filters->filter_post_money('quantity');
                     $min_quantity = $filters->filter_post_money('min_quantity');
         
         
                     if($cod && $name && $price && $quantity && $min_quantity) {
                         $p->editProduct($cod, $name, $price, $quantity, $min_quantity, $id);
                      
                         header("Location: ".BASE_URL);
                     exit;
                     } else {
                         $data['warning'] = 'digite os campos corretamente';
                     }
         
                 }
         
                 $data['info'] = $p->getProduct($id);
         
                 $this->loadTemplate('edit', $data);
         
             }
         
}
