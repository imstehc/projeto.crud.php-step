<?php
// Incluindo arquivo de conexÃ£o
require_once('banco.php');

$id = (int) $_GET['id'];

// Selecionando fotos
$sql = $pdo->prepare('SELECT imagem FROM produto WHERE id = :id');
$sql->bindParam(':id', $id, PDO::PARAM_INT);

// Se executado
if ($sql->execute())
{
    // Alocando foto
    $foto = $sql->fetchObject();
    
    // Se existir
    if ($foto != null)
    {
        // Definindo tipo do retorno
        header('Content-Type: .jpg');
        
        // Retornando conteudo
        echo $foto->imagem;
    }
}