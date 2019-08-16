<?php
    INCLUDE("connect.php");
    
    $Action	    = isset($_POST["Action"]) ? $_POST["Action"] : "";
    $idAluno	    = isset($_POST["idAluno"]) ? $_POST["idAluno"] : "";
    $nome	    = isset($_POST["nome"]) ? $_POST["nome"] : "";
    $telefone	= isset($_POST["telefone"]) ? $_POST["telefone"] : "";
    $turma  	= isset($_POST["turma"]) ? $_POST["turma"] : "";
    $sexo     	= isset($_POST["sexo"]) ? $_POST["sexo"] : "";
    $escola    	= isset($_POST["escola"]) ? $_POST["escola"] : "";
    $endereco   = isset($_POST["endereco"]) ? $_POST["endereco"] : "";
    $bairro    	= isset($_POST["bairro"]) ? $_POST["bairro"] : "";
    $numero    	= isset($_POST["numero"]) ? $_POST["numero"] : "";
    $observacao    	= isset($_POST["observacao"]) ? $_POST["observacao"] : "";
    if($Action == "saveAluno"){
        $strSQL = "";
		$strSQL .= " INSERT INTO tbAluno";
		$strSQL .= " ( ";
		$strSQL .= " 	sNome, ";
        $strSQL .= " 	sTelefone, ";
        $strSQL .= " 	sTurma, ";
        $strSQL .= " 	sSexo, ";
        $strSQL .= " 	sEscola, ";
        $strSQL .= " 	sEndereco, ";
        $strSQL .= " 	sBairro, ";
        $strSQL .= " 	iNumero, ";
        $strSQL .= " 	sObservacao, ";
        $strSQL .= " 	dataCadastro ";
		$strSQL .= " ) ";
		$strSQL .= " VALUES ";
		$strSQL .= " ( ";
        $strSQL .= " 	'$nome', ";
        $strSQL .= " 	'$telefone', ";
        $strSQL .= " 	'$turma', ";
        $strSQL .= " 	'$sexo', ";
        $strSQL .= " 	'$escola', ";
        $strSQL .= " 	'$endereco', ";
        $strSQL .= " 	'$bairro', ";
        $strSQL .= " 	'$numero',";
        $strSQL .= " 	'$observacao',";
        $strSQL .= " 	NOW()";
		$strSQL .= " ) ";
        $retornoQuery = $MySQLi->query($strSQL);
		$idUltimoInserido = $MySQLi->insert_id;
    }else if($Action == "updateAluno"){
        $strSQL = "";
		$strSQL .= " UPDATE tbAluno SET sNome='$nome', sTelefone='$telefone', sTurma='$turma', sSexo='$sexo', sEscola='$escola', sBairro='$bairro', iNumero='$numero', sObservacao='$observacao' WHERE id=$idAluno ";
        $retornoQuery = $MySQLi->query($strSQL);
    }else if($Action == "removeAluno"){
        $strSQL = "";
		$strSQL .= " UPDATE tbAluno SET fDeletado='1' WHERE id=$idAluno ";
        $retornoQuery = $MySQLi->query($strSQL);
    }else if($Action == "editAluno"){
        $strSQL = "";
            $strSQL .= " SELECT ";
            $strSQL .= " 	id, ";
            $strSQL .= " 	sNome, ";
            $strSQL .= " 	sTelefone, ";
            $strSQL .= " 	sTurma, ";
            $strSQL .= " 	sSexo, ";
            $strSQL .= " 	sEscola, ";
            $strSQL .= " 	sEndereco, ";
            $strSQL .= " 	sBairro, ";
            $strSQL .= " 	iNumero, ";
            $strSQL .= " 	sObservacao ";
            $strSQL .= " FROM tbAluno ";
            $strSQL .= " WHERE IFNULL(fDeletado, 0) = 0 AND tbAluno.id=$idAluno";
            if ($retornoQuery = $MySQLi->query($strSQL)) {
              while ($rsListagem = $retornoQuery->fetch_object()) {
                echo $rsListagem->sNome ."*".  $rsListagem->sTelefone . "*". $rsListagem->sTurma. "*".$rsListagem->sSexo."*".$rsListagem->sEscola."*".$rsListagem->sEndereco."*".$rsListagem->sBairro."*".$rsListagem->iNumero."*".$rsListagem->sObservacao."*".$rsListagem->id;
              }
            } else {
              echo trigger_error($MySQLi->error, E_USER_ERROR);
            }
    }
