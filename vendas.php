<!DOCTYPE html>
<html>

<head>
  <?php
  include("connect.php");
  session_start();

  if (isset($_SESSION["sEmail"]) == "") {
    header("Location: login.php");
  }

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
          <a><img src="plus.PNG" title="Inserir" data-toggle="modal" data-target="#modalVenda" class="img" alt="Inserir"></a>
          <h6 class="border-bottom border-gray pb-2 mb-0"> &nbsp;&nbsp; Vendas</h6>
        </div>
      </div>

      <div class="modal fade" id="modalVenda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " style="max-width: 950px!important;" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Cadastro / Vendas</h5>
              <button type="button" onclick="sair()" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="col-md-12 order-md-1">
                <form class="needs-validation" novalidate>
                  <div class="row">
                    <input type="hidden" name="id" id="id" value="" />
                    <input type="hidden" name="idVenda" id="idVenda" value="" />
                    <input type="hidden" name="listProdutos" id="listProdutos" value="" />
                    <div class="col-md-3 mb-3">
                      <label for="status">Status:</label>
                      <select class="custom-select d-block w-100" id="status" name="status" required>
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
                      <label for="idAluno">Aluno:</label>
                      <input class="form-control" class="awesomplete" list="mylist" id="idAluno" name="idAluno">
                      <div class="invalid-feedback">
                        Valid first name is required.
                      </div>
                      <datalist id="mylist">
                        <option></option>
                        <?php
                        $strSQL = " SELECT id, CONCAT(snome, ' / ', sTurma) AS nome ";
                        $strSQL .= " FROM tbAluno ";
                        $strSQL .= " WHERE IFNULL(fDeletado, 0) = 0 ";
                        if ($retornoQuery = $MySQLi->query($strSQL)) {
                          while ($rsListagem = $retornoQuery->fetch_object()) {
                            printf('<option>' . $rsListagem->id . " - " . $rsListagem->nome . '</option>');
                          }
                        } else {
                          echo trigger_error($MySQLi->error, E_USER_ERROR);
                        }
                        ?>
                      </datalist>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="condicao">Condição Pagamento:</label>
                      <select class="custom-select d-block w-100" id="condicao" name="condicao" required>
                        <option value=""> </option>
                        <option>A VISTA</option>
                        <option>A PRAZO</option>
                      </select>
                      <div class="invalid-feedback">
                        Please provide a valid state.
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="observacao">Observação:</label>
                    <textarea class="form-control" id="observacao" name="observacao" rows="3"></textarea>
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
                      $strSQL .= "	CONCAT(tbproduto.id, ' * ', tbproduto.sDescricao, ' *' ,tbproduto.fpreco) AS prod, ";
                      $strSQL .= "	CONCAT(tbproduto.sDescricao, ' / QTDE: ',tbproduto.iquantidade) AS CONCAT, ";
                      $strSQL .= "	tbproduto.sDescricao ";
                      $strSQL .= " FROM tbproduto";
                      $retornoQuery = $MySQLi->query($strSQL);
                      echo "<select key='btnFormEncerrar' name='idProduto' id='idProduto' class='form-control' style='display:block;'>";
                      echo "<option value=''></option>";
                      while ($rsDropDown = $retornoQuery->fetch_object())
                        echo "<option value='" . $rsDropDown->prod . "'>" . $rsDropDown->CONCAT . "</option>";
                      echo "</select>";
                      ?>
                    </div>

                    <div class="col-md-1 mb-3">
                      <label for="quantidade">Qtde:</label>
                      <input type="text" class="form-control" id="quantidade" value="" required>
                      <div class="invalid-feedback">
                        Valid first name is required.
                      </div>
                    </div>

                    <script>
                      var listProdutos = [];
                    </script>
                    <div class="form-group col-sm-1" onclick="addProduto()" style="padding-top: 35px; padding-left: 20px;">
                      <a><img src="plus.PNG" title="Adicionar Produto?" class="img" alt="Inserir"></a>
                    </div>
                  </div>

                  <div class="table-responsive">
                    <table id="table-produto" class='table table-striped table-sm'>
                      <thead>
                        <tr>
                          <th style='width: 5%'>ID</th>
                          <th style='width: 40%'>DESCRICAO</th>
                          <th style='width: 10%'>QTD</th>
                          <th style='width: 10%'>PREÇO</th>
                          <th style='width: 20%'>TOTAL</th>
                          <th style='width: 5%'>#</th>
                        </tr>
                      </thead>
                      <tbody id="tbody-produto">
                      </tbody>
                    </table>
                  </div>
                </form>
              </div>
            </div>
            <div style="text-align:center; display: none;" id="carregando">
              <img alt="" src="ajax-loading.gif">
            </div>
            <div class="modal-footer">
              <button type="button" onclick="add()" class="btn btn-success"><i class="fa fa-share-square"></i>&nbsp; Salvar</i></button>
              <button type="button" onclick="sair()" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp; Sair</button>
            </div>
          </div>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th style="width: 5%">ID</th>
              <th style="width: 10%">STATUS</th>
              <th style="width: 20%">ALUNO</th>
              <th style="width: 10%">DATA VENDA</th>
              <th style="width: 10%">TOTAL</th>
              <th style="width: 5%">#</th>
            </tr>
          </thead>
          <tbody id="body-venda">
            <?php
            $strSQL = "";
            $strSQL .= " SELECT ";
            $strSQL .= " 	tbVenda.id, ";
            $strSQL .= " 	tbVenda.istatus, ";
            $strSQL .= " 	tbVenda.sCondicao, ";
            // $strSQL .= " 	(SELECT  format(SUM(ftotal),2,'de_DE') AS ftotal FROM tblistprodutovenda WHERE tblistprodutovenda.idVenda= tbVenda.id) AS fTotal, ";
            $strSQL .= " 	tbVenda.sObservacao, ";
            $strSQL .= " 	tbVenda.dataVenda, ";
            $strSQL .= " 	tbAluno.sNome ";
            $strSQL .= " FROM tbVenda ";
            $strSQL .= " LEFT JOIN tbAluno ON tbAluno.id = tbVenda.idAluno ";
            $strSQL .= " WHERE IFNULL(tbVenda.fDeletado, 0) = 0 ";
            if ($retornoQuery = $MySQLi->query($strSQL)) {
              $total = 0;
              while ($rsListagem = $retornoQuery->fetch_object()) {
                $sql = "SELECT  fTotal FROM tblistprodutovenda WHERE tblistprodutovenda.idVenda= $rsListagem->id AND IFNULL(tblistprodutovenda.fDeletado, 0) = 0";
                $aux = (int) 0;
                $valor = "";
                if ($retorno = $MySQLi->query($sql)) {
                  while ($rs = $retorno->fetch_object()) {
                    $valor = str_replace('R$', '', str_replace('.', '', str_replace(',', '', $rs->fTotal)));
                    $aux = ((int) $aux + (int) $valor);
                  }
                }
                $tam = strlen($aux);
                $final = substr_replace($aux, ".", $tam - 2) . substr($aux, $tam - 2);
                $formatter = new NumberFormatter('pt_BR',  NumberFormatter::CURRENCY);

                echo "<tr ondblclick='edit(" . $rsListagem->id . ")'>";
                printf('<td>%s</td>', $rsListagem->id);
                printf('<td>%s</td>', $rsListagem->istatus);
                printf('<td>%s</td>', $rsListagem->sNome);
                printf('<td>%s</td>', $rsListagem->dataVenda);
                printf('<td>%s</td>', $formatter->formatCurrency($final, 'BRL'));
                printf("<td><i onclick='remove($rsListagem->id)' title='remover aluno?' class='far fa-times-circle'></i></td>");
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
  <script src="assets/js/vendor/popper.min.js"></script>
  <script src="dist/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>


  <script>
    feather.replace()
  </script>

  <script type="text/javascript" src="http://code.jquery.com/jquery-3.0.0.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/qunit/qunit-1.11.0.js"></script>

  <script>
    function sair() {
      window.location.reload();
    }

    function edit(idVenda) {
      document.getElementById("idVenda").value = idVenda;

      jQuery.ajax({
        type: 'POST',
        url: 'actVenda.php',
        data: '&Action=editVenda' +
          '&idVenda=' + idVenda,
        success: function(html) {
          $('#carregando').hide();
          var mySplitResult = html.split("*");
          document.getElementById('id').value = mySplitResult[0];
          document.getElementById('status').value = mySplitResult[1];
          document.getElementById('condicao').value = mySplitResult[2];
          document.getElementById('observacao').value = mySplitResult[3];
          document.getElementById('idAluno').value = mySplitResult[4];
          // document.getElementById('listProdutos').value = mySplitResult[5];

          for (var i = 0; i < mySplitResult[5].length; i++) {
            if (mySplitResult[i] == undefined) {
              // console.log(i, 'indefinido');
            } else {
              var aux = mySplitResult[i].indexOf("#|#") > -1;
              if (aux) {

                var prod = mySplitResult[i].split("-");
                var newRow = $("<tr>");
                var cols = "";
                cols += '<td>' + prod[0] + '</td>';
                cols += '<td>' + prod[1] + '</td>';
                cols += '<td>' + prod[2] + '</td>';
                cols += '<td>' + prod[3] + '</td>';
                cols += '<td>' + prod[4].replace('#|#', '') + '</td>';
                cols += '<td>';
                cols += '<i onclick="deleteProd(' + prod[0] + ')" title="remover produto?" class="far fa-times-circle"></i>';
                cols += '</td>';
                newRow.append(cols);
                $("#table-produto").append(newRow);
                console.log(i, aux); // i é o índice, matriz[i] é o valor
              }

            }
            // console.log(i, mySplitResult[i]); // i é o índice, matriz[i] é o valor
          }


          jQuery.noConflict();
          $("#modalVenda").modal({
            show: true
          });
        }
      });
    }

    function remove(idVenda) {
      Swal.fire({
        title: 'Deseja realmente remover Venda?',
        text: "Dados será atualizados na base de dados!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, remover!'
      }).then((result) => {
        if (result.value) {
          jQuery.ajax({
            type: 'POST',
            url: 'actVenda.php',
            data: '&Action=removeVenda' +
              '&idVenda=' + idVenda,
            beforeSend: function(html) {
              $('#carregando').show();
            },
            success: function(html) {
              $('#carregando').hide();
              $('#body-venda').html(html);
              Swal.fire(
                'Deletado!',
                'Removido com sucesso.',
                'success'
              )
              setTimeout(function() {
                window.location.reload(1);
              }, 2000);
            }
          });
        }
      })
    }

    function add() {
      var action = "";
      if (document.getElementById("id").value == "")
        action = "saveVenda";
      else
        action = "updateVenda";
      jQuery.ajax({
        type: 'POST',
        url: 'actVenda.php',
        data: '&Action=' + action +
          '&idVenda=' + document.getElementById("id").value +
          '&idAluno=' + document.getElementById("idAluno").value +
          '&status=' + document.getElementById("status").value +
          '&condicao=' + document.getElementById("condicao").value +
          '&listProdutos=' + document.getElementById("listProdutos").value +
          '&observacao=' + document.getElementById("observacao").value,
        beforeSend: function(html) {
          $('#carregando').show();
        },
        success: function(html) {
          $('#carregando').hide();
          $('#body-venda').html(html);
          Swal.fire({
            type: 'success',
            title: 'Venda salva com sucesso!',
            showConfirmButton: false,
            timer: 2000
          })
          setTimeout(function() {
            window.location.reload(1);
          }, 2000);
        }
      });
    }

    function addProduto() {

      var formatter = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 2,
      });

      var result = document.getElementById("idProduto").value.split("*");
      var total = parseInt(document.getElementById("quantidade").value) * parseFloat(result[2].replace('.', '').replace(',', '.'));
      var formatado = formatter.format(total);

      var newRow = $("<tr>");
      var cols = "";
      cols += '<td>' + result[0] + '</td>';
      cols += '<td>' + result[1] + '</td>';
      cols += '<td>' + document.getElementById("quantidade").value + '</td>';
      cols += '<td>' + result[2] + '</td>';
      cols += '<td>' + formatado + '</td>';
      cols += '<td>';
      cols += '<i onclick="removeProd(this.parentNode.parentNode.rowIndex)" title="remover produto?" class="far fa-times-circle"></i>';
      cols += '</td>';
      newRow.append(cols);
      $("#table-produto").append(newRow);

      listProdutos.push(result[0] + '*' + result[1] + '*' + document.getElementById("quantidade").value + '*' + result[2] + '*' + formatado + '#|#');
      document.getElementById('listProdutos').value = listProdutos;

      return false;
    }

    removeProd = function(i) {
      document.getElementById('table-produto').deleteRow(i);
    }

    deleteProd = function(idProd) {
      if (idProd != "") {
        jQuery.ajax({
          type: 'POST',
          url: 'actVenda.php',
          data: '&Action=deleteProd' +
            '&idProd=' + idProd +
            '&idVenda=' + document.getElementById('idVenda').value,
          beforeSend: function(html) {
            $('#carregando').show();
          },
          success: function(html) {
            $('#carregando').hide();
            $('#tbody-produto').html(html);

          }
        });
      }
    }
  </script>
</body>

</html>
