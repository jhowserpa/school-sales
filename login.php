<!doctype html>
<html lang="pt-br">

<?php
session_start(); //iniciamos a sessão que foi aberta
$logado = isset($_SESSION["email"]);
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="favicon.ico">

  <title>Login</title>

  <!-- Bootstrap core CSS -->
  <link href="dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="floating-labels.css" rel="stylesheet">
</head>

<body>
  <form class="form-signin text-center">
    <div class="text-center mb-4">
      <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Login</h1>
    </div>

    <div align="center">
      <div class="form-label-group col-md-3">
        <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputEmail">Email</label>
      </div>

      <div class="form-label-group col-md-3">
        <input type="password" id="senha" name="senha" class="form-control" placeholder="Password" required>
        <label for="inputPassword">Senha</label>
      </div>

      <div style="text-align:center; display: none;" id="carregando">
        <img alt="" src="ajax-loading.gif">
      </div>

      <button onclick="logar()" class="btn btn-lg btn-primary btn-block col-md-3" type="submit">Entrar</button>
    </div>
    <p class="mt-5 mb-3 text-muted text-center">&copy; 2019</p>
  </form>

  <script type="text/javascript" src="http://code.jquery.com/jquery-3.0.0.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/qunit/qunit-1.11.0.js"></script>

  <script type="text/javascript" charset="utf-8">
    function logar() {
      jQuery.ajax({
        type: 'POST',
        url: 'actLogin.php',
        data: '&Action=logar' +
          '&email=' + document.getElementById("email").value +
          '&senha=' + document.getElementById("senha").value,
        beforeSend: function(html) {
          $('#carregando').show();
          //document.getElementById('msg').style.display = "none";
        },
        success: function(html) {
          $('#carregando').hide();
          if (html.trim() == "false") {
            alert("login incorreto...");
            //location.href = "404.html";
          } else {
            location.href = "index.php";
          }
        }
      });
    }
  </script>
</body>

</html>
