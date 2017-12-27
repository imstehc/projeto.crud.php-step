<?php 	
	require 'banco.php';
	$id = null;
	if ( !empty($_GET['id'])) 
            {
		$id = $_REQUEST['id'];
            }
	
	if ( null==$id ) 
            {
		header("Location: index.php");
            }
	
	if ( !empty($_POST)) 
            {
		//Acompanha os erros de validação
                $descricaoErro = null;
                $imagemErro = null;
                $precoErro = null;
                $categoriaErro = null;
                $tipoErro = null;
                $tamnhoErro = null;

                $descricao = $_POST['descricao'];
                $imagem = $_POST['imagem'];
                $preco = $_POST['preco'];
                $origem = $_POST['origem'];
                $categoria = $_POST['categoria'];
		
		//Validaçao dos campos:
                $validacao = true;
                if(empty($descricao))
                {
                    $descricaoErro = 'Por favor digite a descriação do produto!';
                    $validacao = false;
                }

                if(empty($preco))
                {
                    $enderecoErro = 'Por favor digite o preço do produto';
                    $validacao = false;
                }
                
                if(empty($categoria))
                {
                    $telefoneErro = 'Por favor digite escolha uma categoria para o produto';
                    $validacao = false;
                }
         
		// update data
		if ($validacao) 
                {
                    $pdo = Banco::conectar();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    if (empty($conteudo)) 
                    {
                       $sql = "UPDATE produto  set descricao = ?, preco = ?, origem = ?, categoria = ? WHERE id = ?";
                       $q = $pdo->prepare($sql);
                       $q->execute(array($descricao,$preco,$origem,$categoria,$id));
                   
                    }  else {
                            $sql = "UPDATE produto  set descricao = ?, imagem = ?, preco = ?, origem = ?, categoria = ? WHERE id = ?";
                            $q = $pdo->prepare($sql);
                             $q->execute(array($descricao,$conteudo,$preco,$origem,$categoria,$id));
                    }
                    $sql = "UPDATE produto  set descricao = ?, imagem = ?, preco = ?, origem = ?, categoria = ? WHERE id = ?";
           
                    Banco::desconectar();
                    header("Location: index.php");
		}
	} 
        else 
            {
                $pdo = Banco::conectar();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM produto where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$descricao = $data['descricao'];
                $imagem = $data['imagem'];
                $preco = $data['preco'];
		$origem = $data['origem'];
		$categoria = $data['categoria'];
		Banco::desconectar();
	}
?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link   href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/bootstrap.min.js"></script>
        <script src="js/interacao.js"></script>
    </head>      
    <body>
        <div class="row">
            <div class="navbar-fixed-top">
                <div class="breadcrumb" style="background-color: grey; color: snow">
                   <h2> CRUD de Produtos</h2> 
                </div>
            <div class="span10 offset1">
                <div class="container"  >
                    <h3 class="page-header"> Adicionar Produto </h3>
                </div>
            </div>
                
           <div class="container">
                <form class="form-inline" style="background-color: white" action="update.php?id=<?php echo $id?>" method="post">
                    <div class="form-group <?php echo !empty($descricaoErro)?'error ' : '';?>">
                        <label class="control-label">Descrição</label>
                        <div class="controls">
                            <input class="form-control" size= "50" name="descricao" type="text" placeholder="Descricao" required="" value="<?php echo !empty($descricao)?$descricao: '';?>">
                            <?php if(!empty($descricaoErro)): ?>
                                <span class="help-inline"><?php echo $descricaoErro;?></span>
                            <?php endif;?>
                        </div>
                    </div>

                    <div class="form-group <?php echo !empty($imagemErro)?'error ': '';?>">
                        <label class="control-label">Imagem</label>
                            <div class="controls">
                                <input class="form-control" size='30" name='imagem' type='file' value="<?php echo !empty($imagem)?$imagem: '';?>"/>
                                   <?php if(!empty($descricaoErro)): ?>
                                   <span class="help-inline"><?php echo $imagemErro;?></span>
                                   <?php endif;?>
                            </div>
                        </div>     
                    <div class="form-group <?php echo !empty($precoErro)?'error ': '';?>">
                        <label class="control-label">Preço (em real)</label>
                        <div class="controls">
                            <input class="form-control" size="30" name="preco" type="text" placeholder="Preco" data-mask='0.00' required="" value="<?php echo !empty($preco)?$preco: '';?>">
                                <?php if(!empty($precoErro)): ?>
                                 <span class="help-inline"><?php echo $precoErro;?></span>
                                <?php endif;?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" >Origem</label>
                        <div class="controls">
                            <label class="text-info" >Nacional</label> 
                            <input  type="checkbox" name="origem" value="Nacional" checked="checked"/>
                            <label class="text-info" >Importado</label>
                            <input  type="checkbox" name="origem" value="Importado" checked="" />
                        </div>
                     </div>

                    <div class="form-group <?php echo !empty($categoriaErro)?'error ': '';?>">
                        <label class="control-label" >Categoria:</label>
                        <div class="controls">
                            <select class="form-control" name="categoria" size="1" type='' value="<?php echo !empty($categoria)?$categoria: '';?>">
                                <option class="form-control">Categoria Padrão</option> 
                                <option class="form-control" value="Eletrônico">Eletrônico</option>
                                <option class="form-control" value="Livro">Livro</option>
                                <option class="form-control" value="Música">Música</option>
                                <option class="form-control" value="Brinquedos e Jogos">Brinquedos e Jogos</option>
                                <option class="form-control" value="Informática">Informática</option>
                                <option class="form-control" value="Utilidades Domésticas">Utilidades Domésticas</option>
                            </select>
                            
                            <?php if(!empty($categoriaErro)): ?>
                                <span class="help-inline">
                                    <?php echo $categoriaErro;?>
                                </span>
                           <?php endif;?>
                            </div>
                    </div>
                    <br/>
                    <br/>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary" onclick='mensagemUpdate()' type="submit" >Atualizar</button>
                            <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                        </div>
                    </div>
                </form>
              </div>
            </div>                 
        </div> 
    </body>
</html>

