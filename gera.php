<?php
    require 'banco.php';

    $id = $_GET["id"];
    if(!empty($_POST))
    {   
       try{
         $conn = mysqli_connect('localhost', Banco::$dbUsuario,Banco::$dbSenha, Banco::$dbNome);
       } catch (Exception $ex) {
           echo 'A conexão com o banco de dados falhou!';
       }
      $sql - mysqli_query($conn, "SELECT imagem, tp_img from produto where id =" .$id);
      $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
      
      $foto = $row['imagem'];
      $tipo = $row['tp_img'];    
  
      echo $tipo;
      
    }
