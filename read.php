<?php
    require 'banco.php';
    $id = null;
    if(!empty($_GET['id']))
    {
        $id = $_REQUEST['id'];
    }
    
    if(null==$id)
    {
        header("Location: index.php");
    }
    else 
    {
       $pdo = Banco::conectar();
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $sql = "SELECT * FROM produto where id = ?";
       $q = $pdo->prepare($sql);
       $q->execute(array($id));
       $data = $q->fetch(PDO::FETCH_ASSOC);
       $foto = $data['id'];
       Banco::desconectar();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
       <body>
        <div class="row">
            <div class="navbar-fixed-top">
                <div class="breadcrumb" style="background-color: grey; color: snow">
                   <h2> CRUD de Produtos</h2> 
                </div>
            </div>
            <div class="span10 offset1">
                <div class="container"  >
                    <h3 class="page-header"> Dados do Produto </h3>
                </div>
            </div>
                
           <div class="container">  
               <form class="form-inline">       
                    <label class="control-label">Imagem</label>
                        <div class="controls">
                            <img src=<?php  echo 'gera.php?id=' . $data['id'];?>
                                 width="250" height="250"/>
                            <label class="carousel-inner"></label>
                        </div> 
          
                        <div class='form-control'>
                            <label class="control-label">Nome do Produto: </label>
                                <?php echo $data['descricao'];?> 
                        </div>

                        <div class="form-control">
                            <label class="control-label">Data de Cadastro:</label>
                                    <?php echo $data['data_cadastro'];?>

                        </div>

                        <div class='form-control'>
                            <label class="control-label">Preço:</label>
                                <?php echo number_format($data['preco'], 2, ',', '');?>    
                        </div>

                        <div class='form-control'>
                            <label class="control-label">Origem:</label>
                                 <?php echo $data['origem'];?>
                        </div>

                        <div class='form-control'>
                            <label class="control-label">Categoria:</label>       
                                <?php echo $data['categoria'];?>
                        </div>
                        <br/>
                        </br>
                        <div class="row">
                            <div class="col-md-12">
                                    <a href="index.php"  class="btn btn-primary">Voltar</a>
                            </div>        
                        </div>
                 </form>
            </div>
     
        </div>
    </body>
</html>

