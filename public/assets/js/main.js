function deletarProduto(url,nome){
    var r=confirm("Você tem certeza que deseja deletar o produto "+nome+"?");
 
    if (r==true){
        window.location.href = url;
    }
}

function deletarMovimentacao(url){
    var r=confirm("Você tem certeza que deseja deletar esta movimentação?");
 
    if (r==true){
        window.location.href = url;
    }
}




