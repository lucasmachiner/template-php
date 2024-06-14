<?php

require "../Banco.php";

$id = $_GET['id'];

if (deletarProduto($id)) {
    echo "Produto deletado com sucesso.";
} else {
    echo "Erro ao deletar produto: " . $banco->error;
}
header("Location: adm.php");