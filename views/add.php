<html>
    <head>
        <title>Adicionar Produto</title>
    </head>
    <body>
    <h1>Adicionar Produto</h1>
    <?php if(!empty($warning)): ?>
            <div class="warning">
                <?php echo $warning?>
            </div>
        <?php endif; ?>
    <div>
        <form method="POST" class="form">
            Código de Barras:<br/>
            <input type="text" name="cod" required /><br/><br/>

            Nome do Produto:<br/>
            <input type="text" name="name" required /><br/><br/>

            Preço:<br/>
            <input type="text" class="num" name="price" required /><br/><br/>

            Quantidade:<br/>
            <input type="text" class="num" name="quantity" required /><br/><br/>

            Quantidade Miníma:<br/>
            <input type="text" class="num" name="min_quantity" required/><br/><br/>

            <input type="submit" value="Adicionar" id="but">
        </form>
</div>
    </body>
</html>

