# MVC

* mvc = foi feito para separar o que é gráfico e o que é código

* user -> controller -> model -> controller -> view -> user

**view:** parte visual, págs em html

**controler:** intermediário do usuário, entre model e view

**model:** interação com o banco de dados

* apenas o arquivo index é acessado nesse modelo 

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
## núcleo

`l`
