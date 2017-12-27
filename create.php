<?php
    require 'banco.php';
    
    if(!empty($_POST))
    {  
        $descricaoErro = null;
        $imagemErro = null;
        $precoErro = null;
        $categoriaErro = null;
        $tipoErro = null;
        $tamnhoErro = null;

        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $origem = $_POST['origem'];
        $categoria = $_POST['categoria'];
        $tamanho = $imagem['imagem'];
        
        if (isset($_FILES['imagem']))
        {
            $arquivo = $_FILES['caminho_'];
            $pasta_dir = "arquivos/";
            if(!file_exists($pasta_dir)){
                mkdir($pasta_dir);
            }
  
        $arquivo_nome = $pasta_dir . $arquivo["name"];
        
        move_uploaded_file($arquivo['tmp_name'], $arquivo_nome);
        //$imagem = $_FILES['imagem']['tmp_name'];          
        }
         $imagem = $_FILES['imagem']['tmp_name'];
         $nome_foto = $_FILES['imagem']['name'];
         $caminho = $_GET['imagem']['tmp_dir'];
       
        //Validaçao dos campos:
        $validacao = true;
        if(empty($descricao))
        {
            $nomeErro = 'Por favor digite a descrição do produto!';
            $validacao = false;
        }
         // Verificando se selecionou alguma imagem
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
        
        if (!(file_exists('C:/Img/'))){
            // cria diretório
            mkdir("C:/Img/") or die ("Erro ao criar diretório");          
        }

        //move imagem
         move_uploaded_file($imagem, 'C:/Img/' .$nome_foto.'.jpg');
        //abre o arquivo
        
        $abreArq = fopen('C:/Img/' .$nome_foto. '.jpg', "rb");
        
        //percorre o arquivo
         $dados = addslashes(fread($abreArq, filesize('C:/Img/' .$nome_foto. '.jpg')));

        //Inserindo no Banco:
        if($validacao)
        {  
            $dataHora = date('Y-m-d'); 
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO produto(descricao, data_cadastro, imagem , origem, tp_img, preco,categoria) VALUES(?,?,?,?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($descricao,$dataHora ,$dados, $origem, $arquivo_nome, $preco, $categoria));

            Banco::desconectar();
            header("Location: index.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link href="css/bootstrap.min.css" rel="stylesheet">
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
                <form class="form-inline" style="background-color: white" action="create.php" method="post">
                        <div class="form-group <?php echo !empty($descricaoErro)?'error ' : '';?>">
                            <label class="control-label">Descrição</label>
                            <div class="controls">
                                <input class="form-control" size= "50" name="descricao" type="text" 
                                       placeholder="Descricao" required="" value="<?php echo !empty($descricao)?$descricao: '';?>">
                                <?php if(!empty($descricaoErro)): ?>
                                    <span class="help-inline"><?php echo $descricaoErro;?></span>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="form-group <?php echo !empty($imagemErro)?'error ': '';?>">
                              <label class="control-label">Imagem</label>
                            <div class="controls">
                                <input id="file" class="form-control" name='imagem' type='file' value="imagem"/>
                                    <?php if(!empty($imagemErro)): ?>
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
                                <input  type="checkbox" name="origem" value="Nacional"/>
                                <label class="text-info" >Importado</label>
                                <input  type="checkbox" name="origem" value="Importado"/>
                            </div>
                        </div>
                        
                        <div class="form-group  <?php echo !empty($categoriaErro)?'error ': '';?>">
                            <label class="control-label" >Categoria</label>
                            <div class="controls">
                                <select class="form-control" name="categoria" size="1" type='' value="<?php echo !empty($categoria)?$categoria: '';?>">
                                    <option class="form-control" value='Categoria Padrão'>Categoria Padrão</option> 
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
                        <div class="form-actions">      
                            <br/>
                            </br>
                            <button onclick='mensagemCadastro()' type="submit" class="btn btn-success" data-loading-text="Salvando...">Adicionar</button>
                            <a href="index.php" type="btn" class="breadcrumb">Voltar</a>                       
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>


