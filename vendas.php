<!DOCTYPE html>
<html>

<head>
  <?php
  include("connect.php");
  include("header.php");
  ?>
</head>
<style>
  div.container {
    margin-left: 18%;
    /* width: 75em */
    width: auto
  }

  .modal-header {
    padding: 9px 15px;
    border-bottom: 1px solid #eee;
    background-color: #7B7D7D;
    color: white;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
  }
</style>

<body>
  <!-- <div data-include="menu.php"></div> -->
  <?php
  include("menu.php");
  ?>
  <div class="container">
    <div class="row">

      <div class="my-3 p-2 bg-white rounded box-shadow">
        <div class="row">
          <a><img src="plus.PNG" title="Inserir" data-toggle="modal" data-target="#exampleModal" class="img" alt="Inserir"></a>
          <h6 class="border-bottom border-gray pb-2 mb-0"> &nbsp;&nbsp; Vendas</h6>
        </div>
      </div>

      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " style="max-width: 950px!important;" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Cadastro / Vendas</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="col-md-12 order-md-1">
                <form class="needs-validation" novalidate>
                  <div class="row">
                    <div class="col-md-3 mb-3">
                      <label for="state">Status:</label>
                      <select class="custom-select d-block w-100" id="state" required>
                        <option value=""> </option>
                        <option>Aguardando</option>
                        <option>Cancelada</option>
                        <option>Fechada</option>
                      </select>
                      <div class="invalid-feedback">
                        Please provide a valid state.
                      </div>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="firstName">Aluno:</label>
                      <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                      <div class="invalid-feedback">
                        Valid first name is required.
                      </div>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="state">Condição Pagamento:</label>
                      <select class="custom-select d-block w-100" id="state" required>
                        <option value=""> </option>
                        <option>A VISTA</option>
                        <option>A PRAZO</option>
                      </select>
                      <div class="invalid-feedback">
                        Please provide a valid state.
                      </div>
                    </div>
                  </div>
                </form>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Observação:</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>

                <div class="row">
                  <div class="col-md-3 mb-3">
                    <label for="firstName">Pesquisar:</label>
                    <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                    <div class="invalid-feedback">
                      Valid first name is required.
                    </div>
                  </div>

                  <div class="col-md-5 mb-3">
                    <label for="state">Produto:</label>
                    <?php
                    $strSQL = "";
                    $strSQL .= " SELECT ";
                    $strSQL .= "	tbproduto.id, ";
                    $strSQL .= "	CONCAT(tbproduto.sDescricao, ' / QTDE: ',tbproduto.iquantidade) AS CONCAT, ";
                    $strSQL .= "	tbproduto.sDescricao ";
                    $strSQL .= " FROM tbproduto";
                    $retornoQuery = $MySQLi->query($strSQL);
                    echo "<select key='btnFormEncerrar' name='idProduto' id='idProduto' class='form-control' style='display:block;'>";
                    echo "<option value=''></option>";
                    while ($rsDropDown = $retornoQuery->fetch_object())
                      echo "<option value='" . $rsDropDown->id . "'>" . $rsDropDown->CONCAT . "</option>";
                    echo "</select>";
                    ?>
                  </div>

                  <div class="form-group col-sm-1" style="padding-top: 35px; padding-left: 20px;">
                    <a><img src="plus.PNG" title="Adicionar Produto?" class="img" alt="Inserir"></a>
                  </div>
                </div>

                <div class="table-responsive">
                  <table class="table table-striped table-sm">
                    <thead>
                      <tr>
                        <th style="width: 5%">ID</th>
                        <th style="width: 40%">DESCRICAO</th>
                        <th style="width: 10%">QTD</th>
                        <th style="width: 10%">PREÇO</th>
                        <th style="width: 20%">TOTAL</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>001</td>
                        <td>MESA</td>
                        <td>2</td>
                        <td>R$ 5.5</td>
                        <td>R$ 11.0</td>
                      </tr>
                      <tr>
                        <td>002</td>
                        <td>CADEIRA</td>
                        <td>3</td>
                        <td>R$ 35.5</td>
                        <td>R$ 106.5</td>
                      </tr>
                    </tbody>
                  </table>
                </div>


              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success"><i class="fa fa-share-square"></i>&nbsp; Salvar</i></button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp; Sair</button>
            </div>
          </div>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th style="width: 5%">ID</th>
              <th style="width: 20%">ALUNO</th>
              <th style="width: 20%">PRODUTO</th>
              <th style="width: 5%">QTD</th>
              <th style="width: 20%">DATA VENDA</th>
              <th style="width: 10%">PREÇO</th>
              <th style="width: 10%">TOTAL</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $strSQL = "";
            $strSQL .= " SELECT ";
            $strSQL .= " 	id, ";
            $strSQL .= " 	iquantidade, ";
            $strSQL .= " 	fSubtotal, ";
            $strSQL .= " 	fPreco, ";
            $strSQL .= " 	fTotal, ";
            $strSQL .= " 	sObservacao, ";
            $strSQL .= " 	dataVenda ";
            $strSQL .= " FROM tbVenda ";
            $strSQL .= " WHERE IFNULL(fDeletado, 0) = 0 ";
            if ($retornoQuery = $MySQLi->query($strSQL)) {
              while ($rsListagem = $retornoQuery->fetch_object()) {
                echo "<tr>";
                printf('<td>%s</td>', $rsListagem->id);
                printf('<td>%s</td>', "joao");
                printf('<td>%s</td>', "MESA");
                printf('<td>%s</td>', $rsListagem->iquantidade);
                printf('<td>%s</td>', $rsListagem->dataVenda);
                printf('<td>R$ %s</td>', $rsListagem->fPreco);
                printf('<td>R$ %s</td>', $rsListagem->fTotal);
                echo "</tr>";
              }
            } else {
              echo trigger_error($MySQLi->error, E_USER_ERROR);
            }
            $retornoQuery->close();
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
  <script src="assets/js/vendor/popper.min.js"></script>
  <script src="dist/js/bootstrap.min.js"></script>

  <!-- <script src="js/dist/jquery.js" type="text/javascript"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> -->

  <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
  <script>
    feather.replace()
  </script>

  <script>
    add = function() {
      alert("chamou!");
      <?php
      //include("formVenda.php");
      ?>
      /* $(".modal-title").html("Cadastro \\ Vendas");
      $.post("formVenda.php", {idRegistro: 0, Action: 'Add'}, function(retorno){
        $("#popup_modal").modal({backdrop: "static"});
        $(".modal-completa").html(retorno);
      }); */
    };
  </script>
</body>

</html>