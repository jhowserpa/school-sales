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
          <a><img src="plus.PNG" title="Inserir" data-toggle="modal" data-target="#modalProduto" class="img" alt="Inserir"></a>
          <h6 class="border-bottom border-gray pb-2 mb-0"> &nbsp;&nbsp; Produtos</h6>
        </div>
      </div>

      <div class="modal fade" id="modalProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " style="max-width: 950px!important;" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Cadastro / Produtos</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="col-md-12 order-md-1">
                <form class="needs-validation" novalidate>
                  <div class="row">
                    <input type="hidden" name="id" id="id" value="" />
                    <div class="col-md-6 mb-3">
                      <label for="descricao">Descrição:</label>
                      <input type="text" class="form-control" id="descricao" name="descricao" placeholder="" value="" required>
                      <div class="invalid-feedback">
                        Valid first name is required.
                      </div>
                    </div>

                    <div class="col-md-2 mb-3">
                      <label for="quantidade">Qtd:</label>
                      <input type="text" class="form-control" id="quantidade" name="quantidade" placeholder="" value="" required>
                      <div class="invalid-feedback">
                        Valid first name is required.
                      </div>
                    </div>

                    <div class="col-md-2 mb-3">
                      <label for="unidade">Unidade:</label>
                      <select class="custom-select d-block w-100" id="unidade" name="unidade" required>
                        <option value=""> </option>
                        <option>UNIDADE</option>
                        <option>LITRO</option>
                        <option>PEÇA</option>
                        <option>KILO</option>
                        <option>METRO</option>
                        <option>PACOTE</option>
                        <option>METRO</option>
                        <option>OUTROS</option>
                      </select>
                      <div class="invalid-feedback">
                        Please provide a valid state.
                      </div>
                    </div>

                    <div class="col-md-2 mb-3">
                      <label for="preco">Preço:</label>
                      <input type="text" class="form-control simple-field-data-mask-reverse" id="preco" name="preco" type="text" data-mask="#.##0,00" data-mask-reverse="true" data-mask-maxlength="false" placeholder="0" value="">
                      <div class="invalid-feedback">
                        Valid first name is required.
                      </div>
                    </div>
                  </div>
                </form>
                <div class="form-group">
                  <label for="observacao">Observação:</label>
                  <textarea class="form-control" id="observacao" name="observacao" rows="3"></textarea>
                </div>

              </div>
              <div style="text-align:center; display: none;" id="carregando">
                <img alt="" src="ajax-loading.gif">
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" onclick="add();" class="btn btn-success"><i class="fa fa-share-square"></i>&nbsp; Salvar</i></button>
              <button type="button" onclick="sair();" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp; Sair</button>
            </div>
          </div>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th style="width: 5%">ID</th>
              <th style="width: 20%">DESCRICAO</th>
              <th style="width: 5%">QTD</th>
              <th style="width: 10%">PREÇO</th>
              <th style="width: 10%">UNIDADE</th>
              <th style="width: 20%">DATA CADASTRO</th>
              <th style="width: 5%">#</th>
            </tr>
          </thead>
          <tbody id="body-produto">
            <?php
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
            $strSQL .= " WHERE IFNULL(fDeletado, 0) = 0 ";
            if ($retornoQuery = $MySQLi->query($strSQL)) {
              while ($rsListagem = $retornoQuery->fetch_object()) {
                echo "<tr ondblclick='edit(" . $rsListagem->id . ")'>";
                printf('<td>%s</td>', $rsListagem->id);
                printf('<td>%s</td>', $rsListagem->sDescricao);
                printf('<td>%s</td>', $rsListagem->iquantidade);
                printf('<td>R$ %s</td>', $rsListagem->fPreco);
                printf('<td>%s</td>', $rsListagem->sUnidade);
                printf('<td>%s</td>', $rsListagem->dataCadastro);
                printf("<td><i onclick='remove($rsListagem->id)' title='remover produto?' class='far fa-times-circle'></i></td>");
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
  </script>
  <script src="assets/js/vendor/popper.min.js"></script>
  <script src="dist/js/bootstrap.min.js"></script>

  <script type="text/javascript" src="http://code.jquery.com/jquery-3.0.0.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/qunit/qunit-1.11.0.js"></script>

  <script type="text/javascript" src="js/dist/js/jquery.mask.js"></script>
  <script type="text/javascript" src="jquery.mask.test.js"></script>

  <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
  <script>
    feather.replace()
  </script>

  <script>
    function sair() {
      window.location.reload();
    }
    function edit(idProduto) {
      // document.getElementById('nome').value = sNome;
      jQuery.ajax({
        type: 'POST',
        url: 'actProduto.php',
        data: '&Action=editProduto' +
          '&idProduto=' + idProduto,
        success: function(html) {
          $('#carregando').hide();
          var mySplitResult = html.split("*");
          document.getElementById('id').value = mySplitResult[0];
          document.getElementById('descricao').value = mySplitResult[1];
          document.getElementById('quantidade').value = mySplitResult[2];
          document.getElementById('unidade').value = mySplitResult[3];
          document.getElementById('preco').value = mySplitResult[4];
          document.getElementById('observacao').value = mySplitResult[5];
          jQuery.noConflict();
          $("#modalProduto").modal({
            show: true
          });
        }
      });
    }
    function add() {
      var action = "";
      if (document.getElementById("id").value == "")
        action = "saveProduto";
      else
        action = "updateProduto";

      jQuery.ajax({
        type: 'POST',
        url: 'actProduto.php',
        data: '&Action=' + action +
          '&idProduto=' + document.getElementById("id").value +
          '&descricao=' + document.getElementById("descricao").value +
          '&quantidade=' + document.getElementById("quantidade").value +
          '&unidade=' + document.getElementById("unidade").value +
          '&preco=' + document.getElementById("preco").value +
          '&observacao=' + document.getElementById("observacao").value,
        beforeSend: function(html) {
          $('#carregando').show();
        },
        success: function(html) {
          $('#carregando').hide();
          $('#body-produto').html(html);
          Swal.fire({
            type: 'success',
            title: 'Produto salvo com sucesso!',
            showConfirmButton: false,
            timer: 2000
          })
          setTimeout(function() {
            window.location.reload(1);
          }, 2000);
        }
      });
    }
    function remove(idProduto) {
      Swal.fire({
        title: 'Deseja realmente remover produto?',
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
            url: 'actProduto.php',
            data: '&Action=removeProduto' +
              '&idProduto=' + idProduto,
            beforeSend: function(html) {
              $('#carregando').show();
            },
            success: function(html) {
              $('#carregando').hide();
              $('#body-produto').html(html);
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
  </script>
</body>

</html>
