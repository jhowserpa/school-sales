  $("#idEnderecoInstalacao").change(function(){
        avarEnderecoInstalacao = $("#idEnderecoInstalacao").val().split("#|#");
        var enderecoCoordenada = avarEnderecoInstalacao[1];
        carregarNoMapa(avarEnderecoInstalacao[1]);
        $('#idPortfolio').prop('disabled', false);
        $('#idPortfolio :nth-child(0)').prop('selected', true);
        $('#idPortfolioTecnologia :nth-child(0)').prop('selected', true);
        $('#idPortfolioVelocidade :nth-child(0)').prop('selected', true);
        $('#idPortfolioValor :nth-child(0)').prop('selected', true);
    });