<?php
	$ParametersConnection = array(
	  'servidor' => 'localhost',		// Endereço do servidor
	  'usuario' => 'root',				// Usuário
	  'senha' => 'HydraAccess6341',					// Senha
	  'banco' => 'school'			// Nome do banco de dados
	);

	$MySQLi = new MySQLi($ParametersConnection['servidor'], $ParametersConnection['usuario'], $ParametersConnection['senha'], $ParametersConnection['banco']);

	// Verifica se ocorreu um erro e exibe a mensagem de erro
	if (mysqli_connect_errno())
		trigger_error(mysqli_connect_error(), E_USER_ERROR);
?>