<html>
    <head>
        <meta charset="T-8">
        <title>YtFake</title>
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/template.css">
        <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
    </head>
    <body>
        <div class="header">
            YtFake - <a href="<?php echo BASE_URL; ?>sobre">Sobre</a> - <a href="<?php echo BASE_URL; ?>">Home</a> - - <a href="<?php echo BASE_URL; ?>contato">Contato</a>
        </div> 
        <?php 
        $this->loadViewInTemplate($nomeView, $dadosModel);
        ?>
    </body>
</html>