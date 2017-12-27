/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function mensagemCadastro()
{
    alert("Produto Cadastrado com sucesso");
}

function mensagemUpdate()
{
    alert("Produto Alterado com sucesso");
}

function mensagemDelete()
{
    alert("Produto Deletado com sucesso");
}
function search(){
$(function(){
    $("#filtro").keyup(function(){
        var text = $(this).val();
        
        $("#blocos").each(function(){
            var resultado= $(this).text().toUpperCase().indexOf(''+texto.toUpperCase());
            if (resultado < 0) {
                $(this).fadeOut();
            }else{
                $(this).fadeIn();
            }
        });
    });
});

}