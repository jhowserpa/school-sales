<?php
include("connect.php");

$Action        = isset($_POST["Action"]) ? $_POST["Action"] : "";
$idVenda       = isset($_POST["idVenda"]) ? $_POST["idVenda"] : "";
$status        = isset($_POST["status"]) ? $_POST["status"] : "";
$idAluno       = isset($_POST["idAluno"]) ? $_POST["idAluno"] : "";
$condicao      = isset($_POST["condicao"]) ? $_POST["condicao"] : "";
$observacao    = isset($_POST["observacao"]) ? $_POST["observacao"] : "";

if ($Action == "saveVenda") {
    $strSQL = "";
    $strSQL .= " INSERT INTO tbVenda";
    $strSQL .= " ( ";
    $strSQL .= " 	istatus , ";
    $strSQL .= " 	idAluno, ";
    $strSQL .= " 	sCondicao, ";
    $strSQL .= " 	sObservacao, ";
    $strSQL .= " 	dataVenda ";
    $strSQL .= " ) ";
    $strSQL .= " VALUES ";
    $strSQL .= " ( ";
    $strSQL .= " 	'$status', ";
    $strSQL .= " 	'$idAluno', ";
    $strSQL .= " 	'$condicao', ";
    $strSQL .= " 	'$observacao',";
    $strSQL .= " 	NOW()";
    $strSQL .= " ) ";
    $retornoQuery = $MySQLi->query($strSQL);
    $idUltimoInserido = $MySQLi->insert_id;
} else if ($Action == "updateVenda") {
    $strSQL = "";
    $strSQL .= " UPDATE tbVenda SET istatus='$status',  sObservacao='$observacao', sCondicao='$condicao' WHERE id=$idVenda ";
    $retornoQuery = $MySQLi->query($strSQL);
} else if ($Action == "removeVenda") {
    $strSQL = "";
    $strSQL .= " UPDATE tbVenda SET fDeletado='1' WHERE id=$idVenda ";
    $retornoQuery = $MySQLi->query($strSQL);
} else if ($Action == "editVenda") {
    $strSQL = "";
    $strSQL .= " SELECT ";
    $strSQL .= " 	id, ";
    $strSQL .= " 	istatus, ";
    $strSQL .= " 	sCondicao, ";
    $strSQL .= " 	fTotal, ";
    $strSQL .= " 	sObservacao, ";
    $strSQL .= " 	dataVenda ";
    $strSQL .= " FROM tbVenda ";
    $strSQL .= " WHERE IFNULL(fDeletado, 0) = 0 AND tbVenda.id=$idVenda";
    if ($retornoQuery = $MySQLi->query($strSQL)) {
        while ($rsListagem = $retornoQuery->fetch_object()) {
            echo $rsListagem->id . "*" .  $rsListagem->istatus . "*" . $rsListagem->sCondicao. "*" .  $rsListagem->sObservacao;
        }
    } else {
        echo trigger_error($MySQLi->error, E_USER_ERROR);
    }
}
