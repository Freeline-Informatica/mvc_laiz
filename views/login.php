<html>
<head>
    <title>Login Estoque</title>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/Login.css">
</head>
<body>
    <div class="loginarea">  
        <form method="POST">
            Seu Número: </br>
            <input type="text" name="number" /><br/><br/>
        
            Sua senha:<br/>
            <input type="password" name="password" /><br/><br/>
        
            <input type="submit" value="Entrar" id="but"/>
        </form>
        
        <?php if(!empty($msg)): ?>
        <h2><?php echo $msg; ?></h2>
        <?php endif; ?>
    </div>  
</body>
</html>

