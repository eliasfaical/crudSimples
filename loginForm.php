<?php
//Estes dois includes são obrigatórios para qualquer página PHP
include './includes/config.php';
setMenu("Home");
include './includes/cabecalho.php';

$erro = "";

$login = $_POST['login'];
$senha = $_POST['senha'];

if ($login && $senha){

  $sql = "SELECT * FROM usuarios WHERE (login=:login and senha=:senha)";
  $stmt = DB::prepare($sql);
  $stmt->bindParam("login", $login);
  $stmt->bindParam("senha", $senha);
  $stmt->execute();
  $usuario = $stmt->fetch();

  if ($usuario)
  {
      $_SESSION["login_id"] = $usuario->idusuario; 
      setMessage("Login efetuado com sucesso");
      redirect("usuariosListar.php");
  }
  else
  {
    $erro = setError("Login ou senha incorretos.");
  }

}


?>

<div class="col-md-4 col-md-offset-4">
  <div class="panel panel-default">
    <div class="panel-heading"><h3 class="panel-title"><strong>Login:</strong></h3></div>
    <div class="panel-body">
      <?php echo $erro?>
     <form role="form" action="loginForm.php" method="post">
      <div class="form-group">
        <label for="login">Usuário</label>
        <input type="input" class="form-control" style="border-radius:0px" id="login" name="login" value="<?php echo $login?>" placeholder="Entre com o usuário">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Senha: <!--<a href="loginLostPassword.php">(esqueci a senha)</a>--></label>
        <input type="password" class="form-control" style="border-radius:0px" id="senha" name="senha" value="<?php echo $senha?>" placeholder="Digite sua senha">
      </div>
      <input type="submit" class="btn btn-sm btn-default" id="submit" value="Entrar"></button>
    </form>
  </div>
</div>
</div>



<?php
include './includes/rodape.php';
?>