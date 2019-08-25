<?php
include("connect.php");

$Action        = isset($_POST["Action"]) ? $_POST["Action"] : "";
$idVenda       = isset($_POST["idVenda"]) ? $_POST["idVenda"] : "";
$idProd       = isset($_POST["idProd"]) ? $_POST["idProd"] : "";
$status        = isset($_POST["status"]) ? $_POST["status"] : "";
$idAluno       = isset($_POST["idAluno"]) ? $_POST["idAluno"] : "";
$condicao      = isset($_POST["condicao"]) ? $_POST["condicao"] : "";
$observacao    = isset($_POST["observacao"]) ? $_POST["observacao"] : "";
$listProdutos    = isset($_POST["listProdutos"]) ? $_POST["listProdutos"] : "";

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
    $idUltimoVenda = $MySQLi->insert_id;

    $array = explode("#|#", $listProdutos);

    if ($array[0] != "") {
        foreach ($array as $each) {
            $produto = explode("*", $each);
            if ($produto[0] != "") {
                $total = trim(str_replace('R$', '', $produto[4]));

                if ($produto != 0) {
                    $strSQL = "";
                    $strSQL .= " INSERT INTO tblistProdutoVenda";
                    $strSQL .= " ( ";
                    $strSQL .= " 	idProduto, ";
                    $strSQL .= " 	sDescricao , ";
                    $strSQL .= " 	iQuantidade, ";
                    $strSQL .= " 	fpreco, ";
                    $strSQL .= " 	ftotal, ";
                    $strSQL .= " 	idVenda ";
                    $strSQL .= " ) ";
                    $strSQL .= " VALUES ";
                    $strSQL .= " ( ";
                    $strSQL .= " 	" . str_replace(',', '', $produto[0]) . ", ";
                    $strSQL .= " 	'" . $produto[1] . "', ";
                    $strSQL .= " 	'" . $produto[2] . ", ";
                    $strSQL .= " 	'" . $produto[3] . "', ";
                    $strSQL .= " 	'" . substr($total, 2) . "', ";
                    $strSQL .= " 	'" . $idUltimoVenda . "'";
                    $strSQL .= " ) ";
                    $retornoQuery = $MySQLi->query($strSQL);
                    $idUltimoListproduto = $MySQLi->insert_id;
                }
            }
        }
    }
} else if ($Action == "updateVenda") {
    $strSQL = "";
    $strSQL .= " UPDATE tbVenda SET istatus='$status',  sObservacao='$observacao', sCondicao='$condicao', idAluno='$idAluno' WHERE id=$idVenda ";
    $retornoQuery = $MySQLi->query($strSQL);

    $array = explode("#|#", $listProdutos);

    if ($array[0] != "") {

        foreach ($array as $each) {
            $produto = explode("*", $each);

            if ($produto[0] != "") {
                $total = str_replace('R$', '', $produto[4]);

                if ($produto != 0) {
                    $strSQL = "";
                    $strSQL .= " INSERT INTO tblistProdutoVenda";
                    $strSQL .= " ( ";
                    $strSQL .= " 	idProduto, ";
                    $strSQL .= " 	sDescricao , ";
                    $strSQL .= " 	iQuantidade, ";
                    $strSQL .= " 	fpreco, ";
                    $strSQL .= " 	ftotal, ";
                    $strSQL .= " 	idVenda ";
                    $strSQL .= " ) ";
                    $strSQL .= " VALUES ";
                    $strSQL .= " ( ";
                    $strSQL .= " 	" . str_replace(',', '', $produto[0]) . ", ";
                    $strSQL .= " 	'" . $produto[1] . "', ";
                    $strSQL .= " 	'" . $produto[2] . "', ";
                    $strSQL .= " 	'" . $produto[3] . "', ";
                    $strSQL .= " 	'" . substr($total, 2) . "', ";
                    $strSQL .= " 	'" . $idVenda . "'";
                    $strSQL .= " ) ";
                    $retornoQuery = $MySQLi->query($strSQL);
                    $idUltimoListproduto = $MySQLi->insert_id;
                }
            }
        }
    }
} else if ($Action == "removeVenda") {
    $strSQL = "";
    $strSQL .= " UPDATE tbVenda SET fDeletado='1' WHERE id=$idVenda ";
    $retornoQuery = $MySQLi->query($strSQL);
} else if ($Action == "editVenda") {
    $strSQL = "";
    $strSQL .= " SELECT ";
    $strSQL .= " 	tbVenda.id, ";
    $strSQL .= " 	tbVenda.istatus, ";
    $strSQL .= " 	tbVenda.sCondicao, ";
    $strSQL .= " 	tbVenda.fTotal, ";
    $strSQL .= " 	tbVenda.sObservacao, ";
    $strSQL .= " 	tbVenda.dataVenda, ";
    $strSQL .= " 	CONCAT(tbAluno.id, ' - ', tbAluno.sNome, ' / ', tbAluno.sTurma) AS aluno,  ";
    $strSQL .= " 	CONCAT(tblistprodutovenda.id, ' - ', tblistprodutovenda.sDescricao, ' - ', tblistprodutovenda.iQuantidade, ' - ', tblistprodutovenda.fpreco, ' - ', tblistprodutovenda.ftotal, '#|#') AS produtos ";
    $strSQL .= " FROM tbVenda ";
    $strSQL .= " LEFT JOIN tbAluno ON tbAluno.id = tbVenda.idAluno ";
    $strSQL .= " LEFT JOIN tblistprodutovenda ON tblistprodutovenda.idVenda = tbVenda.id ";
    $strSQL .= " WHERE IFNULL(tbVenda.fDeletado, 0) = 0 AND tbVenda.id=$idVenda";
    if ($retornoQuery = $MySQLi->query($strSQL)) {
        while ($rsListagem = $retornoQuery->fetch_object()) {
            echo $rsListagem->id . "*" .  $rsListagem->istatus . "*" . $rsListagem->sCondicao . "*" .  $rsListagem->sObservacao . "*" . $rsListagem->aluno . "*" . $rsListagem->produtos;
        }
    } else {
        echo trigger_error($MySQLi->error, E_USER_ERROR);
    }
} else if ($Action == "deleteProd") {
    $strSQL = "";
    $strSQL .= " DELETE FROM tblistProdutoVenda WHERE id=$idProd ";
    $retornoQuery = $MySQLi->query($strSQL);

    $strSQL = "";
    $strSQL .= " SELECT ";
    $strSQL .= " 	tblistProdutoVenda.id, ";
    $strSQL .= " 	tblistProdutoVenda.sDescricao, ";
    $strSQL .= " 	tblistProdutoVenda.iQuantidade, ";
    $strSQL .= " 	tblistProdutoVenda.fpreco, ";
    $strSQL .= " 	tblistProdutoVenda.ftotal ";
    $strSQL .= " FROM tblistProdutoVenda ";
    $strSQL .= " WHERE IFNULL(tblistProdutoVenda.fDeletado, 0) = 0 AND tblistProdutoVenda.idVenda=$idVenda ";
    if ($retornoQuery = $MySQLi->query($strSQL)) {
        while ($rsListagem = $retornoQuery->fetch_object()) {
            echo "<tr ondblclick='edit(" . $rsListagem->id . ")'>";
            printf('<td>%s</td>', $rsListagem->id);
            printf('<td>%s</td>', $rsListagem->sDescricao);
            printf('<td>%s</td>', $rsListagem->iQuantidade);
            printf('<td>%s</td>', $rsListagem->fpreco);
            printf('<td>%s</td>', $rsListagem->ftotal);
            printf("<td><i onclick='deleteProd($rsListagem->id)' title='remover produto?' class='far fa-times-circle'></i></td>");
            echo "</tr>";
        }
    } else {
        echo trigger_error($MySQLi->error, E_USER_ERROR);
    }
    die;
}
