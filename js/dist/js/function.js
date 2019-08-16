function fnAddSenha()
{
	$(".modal-title").html("Cadastro \\ Alterar Senha");
	$.post("/formAlterarSenha.php", {Action: 'Update'}, function(retorno){
		$("#popup_modal").modal({backdrop: "static"});
		$(".modal-completa").html(retorno);
	});
}

function fnAddTicketNull()
{
	$(".modal-title").html("Atendimento \\ Ticket ");
	$.post("/atendimento/ticket/formSearch.php", {idRegistro: 0, Action: 'Add'}, function(retorno){
		$("#popup_modal").modal({backdrop: "static"});
		$(".modal-completa").html(retorno);
	});
}

function fnAddTicket(idCliente)
{
	$(".modal-title").html("Atendimento \\ Ticket ");
	$.post("/atendimento/ticket/formTicket.php", {idCliente: idCliente, Action: 'Add'}, function(retorno){
		$("#popup_modal").modal({backdrop: "static"});
		$(".modal-completa").html(retorno);
	});
}

function fnAddOpex()
{
	$(".modal-title").html("Cadastro \\ OPEX ");
	$.post("/cadastro/opex/form.php", {idRegistro: 0, Action: 'Add'}, function(retorno){
		$("#popup_modal").modal({backdrop: "static"});
		$(".modal-completa").html(retorno);
	});
}

function fnAddOS(idRegistro, sOrigem)
{
	if(idRegistro){
		$(".modal-title").html("Atendimento \\ OS ");
		$.post("/atendimento/os/formOS.php", {idOrigem: idRegistro, sOrigem: sOrigem, Action: 'AddOS'}, function(retorno){
			$("#popup_modal").modal({backdrop: "static"});
			$(".modal-completa").html(retorno);
		});
	}
}

function fnAddProjeto(idOS = '')
{
	$(".modal-title").html("Cadastro \\ Projeto");
	$.post("/cadastro/projeto/form.php", {idRegistro: 0, Action: 'Add', idOs: idOS}, function(retorno){
		$("#popup_modal").modal({backdrop: "static"});
		$(".modal-completa").html(retorno);
	});
}

function fnViewRegistroLayout(idNo, sNo = null)
{
	if(idNo){
		$(".modal-title").html("Topologia \\ Layout \\ " + sNo);
		$.post("/topologia/layout/form.php", {idRegistro: idNo, Action: 'Update'}, function(retorno){
			$("#popup_modal").modal({backdrop: "static"});
			$(".modal-completa").html(retorno);
		});
	}
}

function fnViewRegistroArco(idArco)
{
	if(idArco){
		$(".modal-title").html("Cadastro \\ Arco");
		$.post("/cadastro/arco/form.php", {idRegistro: idArco, Action: 'Update'}, function(retorno){
			$("#popup_modal").modal({backdrop: "static"});
			$(".modal-completa").html(retorno);
		});
	}
}

function fnViewRegistroSubArco(idSubArco)
{
	if(idSubArco){
		$(".modal-title").html("Cadastro \\ SubArco");
		$.post("/cadastro/subarco/form.php", {idRegistro: idSubArco, Action: 'Update'}, function(retorno){
			$("#popup_modal").modal({backdrop: "static"});
			$(".modal-completa").html(retorno);
		});
	}
}

function fnViewRegistroNo(idNo, sLatLong = null)
{
	if(typeof fnCentralizar == 'function')
		fnCentralizar(0, 0, sLatLong);
	if(idNo){
		$(".modal-title").html("Cadastro \\ Nó");
		$.post("/cadastro/no/form.php", {idRegistro: idNo, Action: 'Update'}, function(retorno){
			$("#popup_modal").modal({backdrop: "static"});
			$(".modal-completa").html(retorno);
		});
	}
}

function fnViewRegistroArco(idArco, sLatLong = null)
{
	if(typeof fnCentralizar == 'function')
		fnCentralizar(0, 0, sLatLong);
	if(idArco){
		$(".modal-title").html("Cadastro \\ Arco");
		$.post("/cadastro/arco/form.php", {idRegistro: idArco, Action: 'Update'}, function(retorno){
			$("#popup_modal").modal({backdrop: "static"});
			$(".modal-completa").html(retorno);
		});
	}
}
function fnViewRegistroViabilidade(idViabilidade, idUsuario, sLatLong = null)
{
	if(typeof fnCentralizar == 'function')
		fnCentralizar(0, 0, sLatLong);
	if(idViabilidade){
		$(".modal-title").html("Cadastro \\ Viabilidade");
		$.post("/atendimento/projetoespecial/form.php", {idRegistro: idViabilidade, idUsuario: idUsuario, Action: 'updateViabilidade'}, function(retorno){
			$("#popup_modal").modal({backdrop: "static"});
			$(".modal-completa").html(retorno);
		});
	}
}

function fnViewRegistroCliente(idUsuario, fAbaOS = false)
{
	if(idUsuario){
		$(".modal-title").html("Cadastro \\ Cliente");
		$.post("/cadastro/cliente/form.php", {idRegistro: idUsuario, Action: 'Update', fAbaOS: fAbaOS}, function(retorno){
			$("#popup_modal").modal({backdrop: "static"});
			$(".modal-completa").html(retorno);
		});
	}
}

/* function viewRegistroArco(idArco, fAbaOS = false)
{
	if(idUsuario){
		$(".modal-title").html("Cadastro \\ Cliente");
		$.post("/cadastro/arco/form.php", {idRegistro: idArco, Action: 'Update', fAbaOS: fAbaOS}, function(retorno){
			$("#popup_modal").modal({backdrop: "static"});
			$(".modal-completa").html(retorno);
		});
	}
} */

function fnViewRegistroContrato(idContrato, idCliente, idUsuario)
{
	if(idContrato){
		$(".modal-title").html("Atividade \\ ROI");
		$.post("/atendimento/roi/form.php", {idRegistro: idContrato, idCliente: idCliente, idUsuario: idUsuario, Action: 'Update'}, function(retorno){
			$("#popup_modal").modal({backdrop: "static"});
			$(".modal-completa").html(retorno);
		});
	}
}

function fnViewRegistroOS(idOS){
	if(idOS){
		$(".modal-title").html("Atendimento \\ Ordem de Serviço");
		$.post("/atendimento/os/form.php", {idRegistro: idOS, Action: 'Update'}, function(retorno){
			$("#popup_modal").modal({backdrop: "static"});
			$(".modal-completa").html(retorno);
		});
	}
}

function fnViewRegistroROI(idContrato, idCliente, idUsuario)
{
	if(idContrato){
		$(".modal-title").html("Atendimento \\ ROI");
		$.post("/atendimento/roi/form.php", {idRegistro: idContrato, idCliente: idCliente, idUsuario: idUsuario, Action: 'Update'}, function(retorno){
			$("#popup_modal").modal({backdrop: "static"});
			$(".modal-completa").html(retorno);
		});
	}
}

function fnViewRegistroProjeto(idProjeto)
{
	if(idProjeto){
		$(".modal-title").html("Cadastro \\ Projeto \\ Projeto");
		$.post("/cadastro/projeto/form.php", {idRegistro: idProjeto, Action: 'Update'}, function(retorno){
			$("#popup_modal").modal({backdrop: "static"});
			$(".modal-completa").html(retorno);
		});
	}
}

function fnViewRegistroProjetoTarefa(idProjetoTarefa)
{
	if(idProjetoTarefa){
		$(".modal-title").html("Cadastro \\ Projeto \\ Tarefa");
		$.post("/atendimento/tarefa/form.php", {idRegistro: idProjetoTarefa, Action: 'UpdateTarefa'}, function(retorno){
			$("#popup_modal").modal({backdrop: "static"});
			$(".modal-completa").html(retorno);
		});
	}
}

function fnValidaCampoVazio(avarCampos)
{
	for (intI=0; intI<avarCampos.length; intI++)
	{
		if (document.getElementById(avarCampos[intI]).value == '')
		{
			alert("Preencha os campos obrigatórios! ");
			document.getElementById(avarCampos[intI]).focus();
			return false;
		}
	}

	return true;
}

function mascaraInteiro(){
	if (event.keyCode < 48 || event.keyCode > 57){
		event.returnValue = false;
		return false;
	}
	return true;
}

function mascaraDecimal(){
	if (event.keyCode < 48 || event.keyCode > 57)
	{
		if (event.keyCode != 46)
		{
			event.returnValue = false;
			return false;
		}
	}
	return true;
}

// Validador do Email
validarEmail = function(sCampoEmail){
	var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	if(!$(sCampoEmail).val()) return true;
	if(!filter.test($(sCampoEmail).val())){
		alert('Email inválido!');
		$(sCampoEmail).val('');
		return false
	}
}

function MascaraCPF(cpf)
{
	if (mascaraInteiro(cpf) == false)
	{
		event.returnValue = false;
	}
	return formataCampo(cpf, '000.000.000-00', event);
}

function MascaraAnoAno(sCampo)
{
	if (mascaraInteiro(sCampo) == false)
	{
		event.returnValue = false;
	}
	return formataCampo(sCampo, '00/00', event);
}

function MascaraHora(sCampo)
{
	if (mascaraInteiro(sCampo) == false)
	{
		event.returnValue = false;
	}

	if (parseInt(sCampo.value.substring(0,2)) > 23)
	{
		alert("Hora inválida!");
		sCampo.value = "";
		return false;
	}

	if (parseInt(sCampo.value.substring(2,4)) > 59)
	{
		alert("Hora inválida!");
		sCampo.value = "";
		return false;
	}

	return formataCampo(sCampo, '00:00', event);
}


function validarCPFCNPJ(sInputCPFCNPJ)
{
	if (sInputCPFCNPJ.value.length == 18)
		validarCNPJ(sInputCPFCNPJ);
	else if (sInputCPFCNPJ.value.length == 14)
		validarCPF(sInputCPFCNPJ);
	else
	{
		document.getElementById(sInputCPFCNPJ.id).value = "";
		alert("CPF/CNPJ inválido!");
	}
}

// Validador do CPF
validarCPF = function(sInputCPF){
	var cpf = $(sInputCPF).val();

	var filtro = /^\d{3}.\d{3}.\d{3}-\d{2}$/i;
	/*if(!filtro.test(cpf))
	{
		window.alert("CPF inválido. Tente novamente.");
		$(sInputCPF).val('');
		return false;
	}*/
	cpf = cpf.replace(".", "");
	cpf = cpf.replace(".", "");
	cpf = cpf.replace("-", "");
	cpf = cpf.replace("/", "");

	if(!cpf) return true;
	if(cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" ||
		cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" ||
		cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" ||
		cpf == "88888888888" || cpf == "99999999999")
	{
		window.alert("CPF inválido!");
		$(sInputCPF).val('');
		return false;
	}
	soma = 0;
	for(i = 0; i < 9; i++)
	{
		soma += parseInt(cpf.charAt(i)) * (10 - i);
	}
	resto = 11 - (soma % 11);
	if(resto == 10 || resto == 11)
	{
		resto = 0;
	}
	if(resto != parseInt(cpf.charAt(9))){
		window.alert("CPF inválido!");
		$(sInputCPF).val('');
		return false;
	}
	soma = 0;
	for(i = 0; i < 10; i ++)
	{
		soma += parseInt(cpf.charAt(i)) * (11 - i);
	}
	resto = 11 - (soma % 11);
	if(resto == 10 || resto == 11)
	{
		resto = 0;
	}
	if(resto != parseInt(cpf.charAt(10))){
		window.alert("CPF inválido!");
		$(sInputCPF).val('');
		return false;
	}
	return true;
}

function mascaraTelefone2(sTelefone)
{
	if (mascaraInteiro(sTelefone) == false)
	{
		event.returnValue = false;
	}
	return formataCampo(sTelefone, '(00) 00000-0000', event);
}

function mascaraTelefone(campo){
	function trata(valor, isOnBlur){
		valor = valor.replace(/\D/g,"");						//Remove tudo o que não é dígito
		valor = valor.replace(/^(\d{2})(\d)/g,"($1) $2");		//Coloca parênteses em volta dos dois primeiros dígitos
		if(isOnBlur){
			valor = valor.replace(/(\d)(\d{5})$/,"$1-$2");
		}else{
			valor = valor.replace(/(\d)(\d{3})$/,"$1-$2");
		}
		return valor;
	}
	campo.onkeypress = function(evt){
		var code = (window.event)? window.event.keyCode : evt.which;
		var valor = this.value
		if(code > 57 || (code < 48 && code != 8)){
			return false;
		}else{
			this.value = trata(valor, false);
		}
	}
	campo.onblur = function(){
		var valor = this.value;
		if(valor.length < 14){
			this.value = ""
		}else{
			this.value = trata(this.value, true);
		}
	}
	campo.maxLength = 15;
}


//adiciona mascara de cnpj
function MascaraCNPJ(cnpj)
{
	if(mascaraInteiro(cnpj)==false){
		event.returnValue = false;
	}
	return formataCampo(cnpj, '00.000.000/0000-00', event);
}

//Validar CNPJ
function validarCNPJ(sCampoCNPJ)
{
	var cnpj = $(sCampoCNPJ).val();
	cnpj = cnpj.split(".").join("");
	cnpj = cnpj.split("/").join("");
	cnpj = cnpj.split("-").join("");

	if(cnpj == '') return false;

	if (cnpj.length != 14)
	{
		window.alert("CNPJ inválido!");
		$(sCampoCNPJ).val('');
		return false;
	}

	// Elimina CNPJs invalidos conhecidos
	if (cnpj == "00000000000000" ||
		cnpj == "11111111111111" ||
		cnpj == "22222222222222" ||
		cnpj == "33333333333333" ||
		cnpj == "44444444444444" ||
		cnpj == "55555555555555" ||
		cnpj == "66666666666666" ||
		cnpj == "77777777777777" ||
		cnpj == "88888888888888" ||
		cnpj == "99999999999999"){
		window.alert("CNPJ inválido!");
		$(sCampoCNPJ).val('');
		return false;
		}

	// Valida DVs
	tamanho = cnpj.length - 2
	numeros = cnpj.substring(0,tamanho);
	digitos = cnpj.substring(tamanho);
	soma = 0;
	pos = tamanho - 7;
	for (i = tamanho; i >= 1; i--) {
		soma += numeros.charAt(tamanho - i) * pos--;
		if (pos < 2)
			pos = 9;
	}
	resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
	if (resultado != digitos.charAt(0)){
		window.alert("CNPJ inválido!");
		$(sCampoCNPJ).val('');
		return false;
	}

	tamanho = tamanho + 1;
	numeros = cnpj.substring(0,tamanho);
	soma = 0;
	pos = tamanho - 7;
	for (i = tamanho; i >= 1; i--) {
		soma += numeros.charAt(tamanho - i) * pos--;
		if (pos < 2)
			pos = 9;
	}
	resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
	if (resultado != digitos.charAt(1)){
		window.alert("CNPJ inválido!");
		$(sCampoCNPJ).val('');
		return false;
	}

	return true;

}

//formata de forma generica os campos
function formataCampo(campo, Mascara, evento) {
	var boleanoMascara;
	var Digitato = evento.keyCode;
	exp = /\-|\.|\/|\(|\)| /g
	campoSoNumeros = campo.value.toString().replace( exp, "" );
	var posicaoCampo = 0;
	var NovoValorCampo="";
	var TamanhoMascara = campoSoNumeros.length;;
	if (Digitato != 8) { // backspace
		for(i=0; i<= TamanhoMascara; i++) {
			boleanoMascara	= ((Mascara.charAt(i) == "-") || (Mascara.charAt(i) == ".")
													|| (Mascara.charAt(i) == "/") || (Mascara.charAt(i) == ":"))
			boleanoMascara	= boleanoMascara || ((Mascara.charAt(i) == "(")
													|| (Mascara.charAt(i) == ")") || (Mascara.charAt(i) == " "))
			if (boleanoMascara) {
				NovoValorCampo += Mascara.charAt(i);
				TamanhoMascara++;
			}else {
				NovoValorCampo += campoSoNumeros.charAt(posicaoCampo);
				posicaoCampo++;
			}
		}
		campo.value = NovoValorCampo;
		return true;
	}else {
		return true;
	}
}

viewFaq = function(sMenu, sTitulo, sModuloSeguranca){
	$(".modal-title").html(sMenu + " \\ " + sTitulo + " \\ Ajuda");
	$.post("../../formFaq.php", {sModuloSeguranca: sModuloSeguranca}, function(retorno){
		$("#popup_modal").modal({backdrop: "static"});
		$(".modal-completa").html(retorno);
	});
};

function addItemScreen(sTitulo, sUrl, sOrigem, sPermissaoPaginaOrigem)
{
	$(".popUpAuxiliar-title").html(sTitulo);
	$.post(sUrl, {idRegistro: 0, sPaginaOrigem: sOrigem, Action: 'Add', sPermissaoPaginaOrigem: sPermissaoPaginaOrigem}, function(retorno){
		$("#popUpAuxiliar").modal({backdrop: "static"});
		$(".popUpAuxiliar-completa").html(retorno);
	});
}