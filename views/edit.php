<html>
    <head>
        <title>Adicionar Produto</title>
    </head>
    <body>
        <h1>Editar Produto</h1>
        <?php if(!empty($warning)): ?>
            <div class="warning">
                <?php echo $warning?>
            </div>
        <?php endif; ?>
        <div>
            <form method="POST" class="form">
                Código de Barras:<br/>
                <input type="text" name="cod" value="<?php echo $info['cod']; ?>" required /><br/><br/>

                Nome do Produto:<br/>
                <input type="text" name="name" value="<?php echo $info['name']; ?>" required /><br/><br/>

                Preço:<br/>
                <input type="text" class="num" name="price" value="<?php echo number_format($info['price'], 2, ',', '.'); ?>" required /><br/><br/>

                Quantidade:<br/>
                <input type="text" class="num" name="quantity" value="<?php echo number_format($info['quantity'], 2, ',', '.') ; ?>" required /><br/><br/>

                Quantidade Miníma:<br/>
                <input type="text" class="num" name="min_quantity" value="<?php echo number_format($info['min_quantity'], 2, ',', '.'); ?>" required/><br/><br/>

                <input type="submit" value="Editar" id="but">
            </form>
        </div>
    </body>
</html>
