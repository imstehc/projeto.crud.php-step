<?php
    require_once '/banco.php';
    if(!empty($_POST))
     {   
        try{
          $con = mysqli_connect(Banco::$dbHost, Banco::$$dbUsuario,Banco::$dbSenha, Banco::$dbNome);
        } catch (Exception $ex) {
            echo 'A conexão com o banco de dados falhou!';
        }
        
        $categoria = $_POST['categoria'];
        $origem = $_POST['origem'];
        $descricao = $_POST['descricao'];
        
        if (Empty($categoria)){
           $categoria = '%'; 
        }
        if (Empty($descricao)){
           $descricao = '%'; 
        }
         if (Empty($origem )){
           $origem = '%'; 
        }
        
        $sql = "SELECT * FROM produto where categoria LIKE '%" . $categoria . "%' or '%' . $descricao. '%' or '%' .$origem. '%";
       // $q = $pdo->prepare($sql);
        $result = mysqli_query($con, $sql );
         //  foreach($pdo->query($sql)as $row)
        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))    
        {   
            //calcula a taxa do dólar
            $dolar = ($row['preco']  / (3.599));
            echo '<tr>';
            echo '<td>'. $row['id'] . '</td>';
            echo '<td>'. $row['descricao'] . '</td>';
            echo '<td>'. $row['data_cadastro']. '</td>';
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
        
     }

?>
