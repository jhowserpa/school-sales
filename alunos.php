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
          <a><img src="plus.PNG" title="Inserir" data-toggle="modal" data-target="#modalAluno" class="img" alt="Inserir"></a>
          <h6 class="border-bottom border-gray pb-2 mb-0"> &nbsp;&nbsp; Alunos</h6>
        </div>
      </div>

      <div class="modal fade" id="modalAluno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " style="max-width: 950px!important;" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Cadastro / Alunos</h5>
              <button type="button" onclick="sair();" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="col-md-12 order-md-1">
                <form class="needs-validation" novalidate>
                  <div class="row">
                  <input type="hidden" name="id" id="id" value="" />
                    <div class="col-md-5 mb-3">
                      <label for="nome">Nome:</label>
                      <input type="text" class="form-control" id="nome" name="nome" placeholder="" value="" required>
                      <div class="invalid-feedback">
                        Valid first name is required.
                      </div>
                    </div>

                    <div class="col-md-3 mb-3">
                      <label for="telefone">Telefone:</label>
                      <input type="text" class="form-control simple-field-data-mask-reverse" id="telefone" name="telefone" type="text" data-mask="(00) 0000-0000" value="">
                      <div class="invalid-feedback">
                        Valid first name is required.
                      </div>
                    </div>

                    <div class="col-md-2 mb-3">
                      <label for="turma">Turma:</label>
                      <input type="text" class="form-control" id="turma" name="turma" placeholder="" value="" required>
                      <div class="invalid-feedback">
                        Please provide a valid state.
                      </div>
                    </div>

                    <div class="col-md-2 mb-3">
                      <label for="sexo">Sexo:</label>
                      <select class="custom-select d-block w-100" id="sexo" name="sexo" required>
                        <option value=""> </option>
                        <option>M</option>
                        <option>F</option>
                      </select>
                      <div class="invalid-feedback">
                        Please provide a valid state.
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 mb-3">
                      <label for="escola">Escola:</label>
                      <input type="text" class="form-control" id="escola" name="escola" placeholder="" value="" required>
                      <div class="invalid-feedback">
                        Please provide a valid state.
                      </div>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="endereco">Endereço:</label>
                      <input type="text" class="form-control" id="endereco" name="endereco" placeholder="" value="" required>
                      <div class="invalid-feedback">
                        Please provide a valid state.
                      </div>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="bairro">Bairro:</label>
                      <input type="text" class="form-control" id="bairro" name="bairro" placeholder="" value="" required>
                      <div class="invalid-feedback">
                        Please provide a valid state.
                      </div>
                    </div>
                    <div class="col-md-2 mb-3">
                      <label for="numero">Numero:</label>
                      <input type="text" class="form-control" id="numero" name="numero" placeholder="" value="" required>
                      <div class="invalid-feedback">
                        Please provide a valid state.
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
              <th style="width: 20%">NOME</th>
              <th style="width: 10%">TELEFONE</th>
              <th style="width: 5%">TURMA</th>
              <th style="width: 20%">ENDERECO</th>
              <th style="width: 10%">BAIRRO</th>
              <th style="width: 20%">OBSERVACAO</th>
              <th style="width: 5%">#</th>
            </tr>
          </thead>
          <tbody id="body-aluno">
            <?php
            $strSQL = "";
            $strSQL .= " SELECT ";
            $strSQL .= " 	id, ";
            $strSQL .= " 	sNome, ";
            $strSQL .= " 	sTelefone, ";
            $strSQL .= " 	sTurma, ";
            $strSQL .= " 	sEndereco, ";
            $strSQL .= " 	sBairro, ";
            $strSQL .= " 	sObservacao ";
            $strSQL .= " FROM tbAluno ";
            $strSQL .= " WHERE IFNULL(fDeletado, 0) = 0 ";
            if ($retornoQuery = $MySQLi->query($strSQL)) {
              while ($rsListagem = $retornoQuery->fetch_object()) {
                echo "<tr  ondblclick='edit(" . $rsListagem->id . ")'>";
                printf('<td>%s</td>', $rsListagem->id);
                printf('<td>%s</td>', $rsListagem->sNome);
                printf('<td>%s</td>', $rsListagem->sTelefone);
                printf('<td>%s</td>', $rsListagem->sTurma);
                printf('<td>%s</td>', $rsListagem->sEndereco);
                printf('<td>%s</td>', $rsListagem->sBairro);
                printf('<td>%s</td>', $rsListagem->sObservacao);
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
  <!-- <script src="js/dist/jquery.js" type="text/javascript"></script> -->
  <script>
    feather.replace()
  </script>

  <script type="text/javascript" src="http://code.jquery.com/jquery-3.0.0.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/qunit/qunit-1.11.0.js"></script>

  <script type="text/javascript" src="js/dist/js/jquery.mask.js"></script>
  <script type="text/javascript" src="jquery.mask.test.js"></script>

  <script>
    /* add = function() {
      Swal.fire({
        // position: 'top-end',
        type: 'success',
        title: 'Aluno salvo com sucesso!',
        showConfirmButton: false,
        timer: 2000
      })
    }; */
    function sair() {
      window.location.reload();
    }
    function edit(idAluno) {
      // document.getElementById('nome').value = sNome;
      $.ajax({
        type: 'POST',
        url: 'actAluno.php',
        data: '&Action=editAluno' +
          '&idAluno=' + idAluno,
        success: function(html) {
          $('#carregando').hide();
          var mySplitResult = html.split("*");
          document.getElementById('nome').value = mySplitResult[0];
          document.getElementById('telefone').value = mySplitResult[1];
          document.getElementById('turma').value = mySplitResult[2];
          document.getElementById('sexo').value = mySplitResult[3];
          document.getElementById('escola').value = mySplitResult[4];
          document.getElementById('endereco').value = mySplitResult[5];
          document.getElementById('bairro').value = mySplitResult[6];
          document.getElementById('numero').value = mySplitResult[7];
          document.getElementById('observacao').value = mySplitResult[8];
          document.getElementById('id').value = mySplitResult[9];
          jQuery.noConflict();
          $("#modalAluno").modal({
            show: true
          });
        }
      });
    }
    function remove(idAluno) {
      Swal.fire({
        title: 'Deseja realmente remover aluno?',
        text: "Dados será atualizados na base de dados!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, remover!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            type: 'POST',
            url: 'actAluno.php',
            data: '&Action=removeAluno' +
              '&idAluno=' + idAluno,
            beforeSend: function(html) {
              $('#carregando').show();
            },
            success: function(html) {
              $('#carregando').hide();
              $('#body-aluno').html(html);
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

      var action="";
      if(document.getElementById("id").value == "")
        action="saveAluno";
      else
        action="updateAluno";

      jQuery.ajax({
        type: 'POST',
        url: 'actAluno.php',
        data: '&Action='+ action +
          '&idAluno=' + document.getElementById("id").value +
          '&nome=' + document.getElementById("nome").value +
          '&telefone=' + document.getElementById("telefone").value +
          '&turma=' + document.getElementById("turma").value +
          '&sexo=' + document.getElementById("sexo").value +
          '&escola=' + document.getElementById("escola").value +
          '&endereco=' + document.getElementById("endereco").value +
          '&bairro=' + document.getElementById("bairro").value +
          '&numero=' + document.getElementById("numero").value +
          '&observacao=' + document.getElementById("observacao").value,
        beforeSend: function(html) {
          $('#carregando').show();
        },
        success: function(html) {
          $('#carregando').hide();
          $('#body-aluno').html(html);
          Swal.fire({
            type: 'success',
            title: 'Aluno salvo com sucesso!',
            showConfirmButton: false,
            timer: 2000
          })
          setTimeout(function() {
            window.location.reload(1);
          }, 2000);
        }
      });
    }
  </script>
</body>

</html>