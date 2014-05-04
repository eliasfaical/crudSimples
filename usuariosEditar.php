<?php
//Estes dois includes são obrigatórios para qualquer página PHP
include './includes/config.php';
setMenu("Usuários");
include './includes/cabecalho.php';

// Esta página deve checar se o usuário está logado
checkLogin();

// Erros que podem acontecer ao salvar o registro
$erro="";

$idusuario = $_GET['idusuario'];

if ($idusuario==null)
	$erro = setError("Usuário não encontrado. <a href='usuariosListar.php>Voltar</a>");
else
{
	$sql = "SELECT * FROM usuarios WHERE (idusuario=:idusuario)";
	$stmt = DB::prepare($sql);
	$stmt->bindParam("idusuario", $idusuario);
	$stmt->execute();
	$usuario = $stmt->fetch();

	if ($usuario==null)
		$erro = setError("Usuário não encontrado. <a href='usuariosListar.php>Voltar</a>");	
}

if ($_POST['salvar']) // usuario clicou no botao salvar
{
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$login = $_POST['login'];
	$idusuario = $_POST['idusuario'];

	/** ATENCAO
	Existem alguns tratamentos a serem realizados aqui. 
		1- Se o usuario mudou o email, checar se o email já nao existe no banco
		2- Se o ususario mudou o login, checar se o login já nao existe no banco
	*/

	$sqlInsert= "UPDATE usuarios SET nome=:nome,login=:login,senha=:senha,email=:email WHERE idusuario=:idusuario";

	$stmt = DB::prepare($sqlInsert);
	$stmt->bindParam("nome", $nome);
	$stmt->bindParam("email", $email);
	$stmt->bindParam("login", $login);
	$stmt->bindParam("senha", $senha);
	$stmt->bindParam("idusuario", $idusuario);
	$stmt->execute();


	setMessage("Usuário salvo com sucesso.");
	redirect("usuariosListar.php");

}


?>

<div class="col-md-10 col-md-offset-1">
	<form action="usuariosEditar.php"  method="post">
		<input type="hidden" name="idusuario"id="idusuario" value="<?php echo $usuario->idusuario ?>"/>
		<div class="panel panel-default">
			<div class="panel-heading">

				<h3 class="panel-title"><strong>Editar usuário</strong>
					<a href="usuariosListar.php"  class="pull-right "><span class="glyphicon glyphicon-remove"></span></a>
				</h3></div>
				<div class="panel-body">
					<?php echo $erro ?>
					<div class="row">

						<div class="col-md-6">

							<div class="form-group">
								<label for="nome">Nome:</label>
								<input type="input" class="form-control" id="nome"  name="nome" value="<?php echo $usuario->nome ?>" placeholder="Nome do usuário" required>
							</div>

						</div>
						<div class="col-md-6">

							<div class="form-group">
								<label for="nome">Email:</label>
								<input type="email" class="form-control" id="email"  name="email"  value="<?php echo $usuario->email?>" placeholder="Email do usuário" required>
							</div>

						</div>
					</div>

					<div class="row">
						<div class="col-md-6">

							<div class="form-group">
								<label for="nome">Login:</label>
								<input type="input" class="form-control" id="login"  name="login"  value="<?php echo $usuario->login?>" placeholder="Login do usuário" required>
							</div>

						</div>
						<div class="col-md-6">

							<div class="form-group">
								<label for="nome">Senha:</label>
								<input type="password" class="form-control" id="senha"  name="senha"  value="<?php echo $usuario->senha?>" placeholder="Senha do usuário" required>
							</div>

						</div>
					</div>


				</div>
				<div class="panel-footer">
					<input type="submit" id="salvar" name="salvar" class="btn btn-default" value="Salvar"></input>
					
				</div>
			</div>
		</div>
	</form>
</div>

<?php
include './includes/rodape.php';
?>