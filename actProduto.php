<?php
include("connect.php");

$Action        = isset($_POST["Action"]) ? $_POST["Action"] : "";
$idProduto     = isset($_POST["idProduto"]) ? $_POST["idProduto"] : "";
$descricao     = isset($_POST["descricao"]) ? $_POST["descricao"] : "";
$quantidade    = isset($_POST["quantidade"]) ? $_POST["quantidade"] : "";
$unidade       = isset($_POST["unidade"]) ? $_POST["unidade"] : "";
$preco         = isset($_POST["preco"]) ? $_POST["preco"] : "";
$observacao    = isset($_POST["observacao"]) ? $_POST["observacao"] : "";

if ($Action == "saveProduto") {
    $strSQL = "";
    $strSQL .= " INSERT INTO tbProduto";
    $strSQL .= " ( ";
    $strSQL .= " 	sDescricao, ";
    $strSQL .= " 	iQuantidade, ";
    $strSQL .= " 	sUnidade, ";
    $strSQL .= " 	fpreco, ";
    $strSQL .= " 	sObservacao, ";
    $strSQL .= " 	dataCadastro ";
    $strSQL .= " ) ";
    $strSQL .= " VALUES ";
    $strSQL .= " ( ";
    $strSQL .= " 	'$descricao', ";
    $strSQL .= " 	'$quantidade', ";
    $strSQL .= " 	'$unidade', ";
    $strSQL .= " 	'$preco', ";
    $strSQL .= " 	'$observacao',";
    $strSQL .= " 	NOW()";
    $strSQL .= " ) ";
    $retornoQuery = $MySQLi->query($strSQL);
    $idUltimoInserido = $MySQLi->insert_id;
} else if ($Action == "updateProduto") {
    $strSQL = "";
    $strSQL .= " UPDATE tbProduto SET sDescricao='$descricao', iQuantidade='$quantidade', sUnidade='$unidade', fpreco='$preco', sObservacao='$observacao' WHERE id=$idProduto ";
    $retornoQuery = $MySQLi->query($strSQL);
} else if ($Action == "removeProduto") {
    $strSQL = "";
    $strSQL .= " UPDATE tbProduto SET fDeletado='1' WHERE id=$idProduto ";
    $retornoQuery = $MySQLi->query($strSQL);
} else if ($Action == "editProduto") {
    $strSQL = "";
    $strSQL .= " SELECT ";
    $strSQL .= " 	id, ";
    $strSQL .= " 	sDescricao, ";
    $strSQL .= " 	iquantidade, ";
    $strSQL .= " 	fPreco, ";
    $strSQL .= " 	sUnidade, ";
    $strSQL .= " 	sObservacao, ";
    $strSQL .= " 	dataCadastro ";
    $strSQL .= " FROM tbProduto ";
    $strSQL .= " WHERE IFNULL(fDeletado, 0) = 0 AND tbProduto.id=$idProduto";
    if ($retornoQuery = $MySQLi->query($strSQL)) {
        while ($rsListagem = $retornoQuery->fetch_object()) {
            echo $rsListagem->id . "*" .  $rsListagem->sDescricao . "*" . $rsListagem->iquantidade . "*" . $rsListagem->sUnidade . "*" . $rsListagem->fPreco . "*" . $rsListagem->sObservacao;
        }
    } else {
        echo trigger_error($MySQLi->error, E_USER_ERROR);
    }
}
