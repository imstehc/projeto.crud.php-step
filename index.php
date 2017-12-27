<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/bootstrap.min.js"></script>
    </head>
    
    <body>
        <div class="jumbotron">
        <div class="control-label">
            <div class="navbar-fixed-top">
                <div class="breadcrumb" style="background-color: grey; color: snow">
                   <h2> CRUD de Produtos</h2> 
                </div>
             </div>
            </br>
            <div class="row">
                <p>     
                </p>   
                <div class="well"> 
                    <form class="form-group" action="index.php" method="post">                
                        <label><input type="text" placeholder="Filtrar por Categoria" name="categoria"/></label>
                        <button  type="submit" class="tn btn-info" name='ok'>Filtrar</button>
                        <a class="navbar-right" href="create.php" class="tn btn-primary">Adicionar Produto</a>      
                    </form>
                </div>
             </div>
                <div class="navbar-right">    
                    
                </div>
              <div class="blocos">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr align='center'>
                            <th  style="background-color:whitesmoke">Código</th>
                            <th style="background-color:whitesmoke">Descrição</th>
                            <th style="background-color:whitesmoke">Data de Cadastro</th>
                            <th style="background-color:whitesmoke">Imagem</th>
                            <th style="background-color:whitesmoke">Preço (Real)</th>
                            <th style="background-color:whitesmoke">Preço (Dolár)</th>
                            <th style="background-color:whitesmoke">Origem</th>
                            <th style="background-color:whitesmoke">Categoria</th>
                            <th style="background-color:whitesmoke">Ações</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <!-- lista os itens da tabela produt -->
                    <?php
                       include 'banco.php';
     
                       try{
                         $con = mysqli_connect('localhost', Banco::$dbUsuario,Banco::$dbSenha, Banco::$dbNome);
                       } catch (Exception $ex) {
                           echo 'A conexão com o banco de dados falhou!';
                       }
                         
                       if(!empty($_POST)) 
                       {
                            $categoria = $_POST['categoria'];
                       }

                       if (empty($categoria))
                       {
                            $sql = "SELECT * FROM produto";

                       }else{
                            $sql = "SELECT * FROM produto where categoria LIKE '%" . $categoria . "%'";
                       }
                       $result = mysqli_query($con, $sql );
                        //  foreach($pdo->query($sql)as $row)
                       while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))    
                       {   
                           //calcula a taxa do dólar
                           $dolar = ($row['preco']  / (3.599));
                           $mime = "image/jpg"; 
                           $img = 'data:' . $mime . ';base64,' . base64_encode(($row['imagem']));
                           echo '<tr>';
                           echo '<td>'. $row['id'] . '</td>';
                           echo '<td>'. $row['descricao'] . '</td>';
                           echo '<td>'. $row['data_cadastro']. '</td>';
                           echo '<td>'. '<a href='.'gera.php?id='. $row['id']. "/>Visualizar</td>";
                           echo '<td>'. number_format($row['preco'], 2, ',',''). '</td>';
                           echo '<td>'. number_format($dolar, 2,',', '').'</td>';

                           echo '<td>'. $row['origem'] . '</td>';
                           echo '<td>'. $row['categoria'] . '</td>';
                           echo '<td width=250>';
                           echo '<a class="btn btn-primary" href="read.php?id='.$row['id'].'">Listar</a>';
                           echo ' ';
                           echo '<a class="btn btn-warning" href="update.php?id='.$row['id'].'">Atualizar</a>';
                           echo ' ';
                           echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Excluir</a>';
                           echo '</td>';
                           echo '<tr>';
                     }
                   ?>         
                    </tbody>                   
                </table>   
              </div>
            </div>
        </div>
        </div>
    </body>
</html>
