<html>
    <head>
        <title>Inicio Estoque</title>
    </head>
    <body>
        <!-- <header>
            <nav>
                <ul>
                    <li><a href="<?php echo BASE_URL;?>home/add">Adicionar Produto</a><br/><br/></li>
                    <li><a href="<?php echo BASE_URL; ?>relatorio">Relatório</a><br/><br/></li>
                    <li><a href="<?php echo BASE_URL; ?>historico">Histórico</a><br/><br/></li>
                    <li><a href="<?php echo BASE_URL; ?>login/sair">Sair</a><br/><br/></li>
                </ul> 
            </nav>
        </header> -->

        <h1>ESTA É A PÁGINA INICIAL</h1>

        <div>
            <form method="GET" action="<?php echo BASE_URL; ?>">
                <input type="text" name="busca" id="busca" value="<?php echo(!empty($_GET['busca']))?$_GET['busca']:''; ?>" class="pesq" placeholder="digite o código de barras ou o nome do produto..." style="width: 100%; height:30px; font-size:18px; " />
        
                <?php echo(!empty($_GET['busca']))?$_GET['busca']:''; ?>
        
            </form>
        </div>
        
        
        <table border="0" width="100%">
            <tr>
                <th>Cod. Bar</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Qtd.</th>
                <th>Ações</th>
            </tr>
            <?php foreach($list as $item): ?>
                <tr>
                    <td><?php echo $item['cod']; ?></td>
                    <td><?php echo $item['name']; ?></td>
                    <td>R$ <?php echo number_format($item['price'], 2, ',', '.'); ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>
                        <a href="<?php echo BASE_URL;?>home/edit/<?php echo $item['id']; ?>" class="edit">Editar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        
        <script type="text/javascript">
            document.getElementById("busca").focus();
        </script>
    </body>
</html>

