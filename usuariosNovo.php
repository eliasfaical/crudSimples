<?php
//Estes dois includes são obrigatórios para qualquer página PHP
include './includes/config.php';
setMenu("Usuários");
include './includes/cabecalho.php';

// Esta página deve checar se o usuário está logado
checkLogin();

// Erros que podem acontecer ao salvar o registro
$erro="";

if ($_POST['salvar']) // usuario clicou no botao salvar
{
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$login = $_POST['login'];

	// Verifica se o email já existe
	$sql = "SELECT * FROM usuarios WHERE (email=:email)";
	$stmt = DB::prepare($sql);
	$stmt->bindParam("email", $email);
	$stmt->execute();
	$usuario = $stmt->fetch();

	if ($usuario)
		$erro=setError("Email existente");
	else
	{
		// Verifica se o login já existe
		$sql = "SELECT * FROM usuarios WHERE (login=:login)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam("login", $login);
		$stmt->execute();
		$usuario = $stmt->fetch();

		if ($usuario)
			$erro=setError("Login existente");
		else
		{
			// pronto para o insert
			$sqlInsert= "INSERT INTO usuarios (nome,email,login,senha) VALUES (:nome,:email,:login,:senha)";
			$stmt = DB::prepare($sqlInsert);
			$stmt->bindParam("nome", $nome);
			$stmt->bindParam("email", $email);
			$stmt->bindParam("login", $login);
			$stmt->bindParam("senha", $senha);
			$stmt->execute();

			if (DB::lastInsertId())
			{
				setMessage("Usuário cadastrado com sucesso.");
				redirect("usuariosListar.php");
			}
			else
			{
				$erro = setError("Algum erro aconteceu");
			}
		}
	}
}


?>

<div class="col-md-10 col-md-offset-1">
	<form action="usuariosNovo.php"  method="post">

		<div class="panel panel-default">
			<div class="panel-heading">

				<h3 class="panel-title"><strong>Novo usuário</strong>
					<a href="usuariosListar.php"  class="pull-right "><span class="glyphicon glyphicon-remove"></span></a>
				</h3></div>
				<div class="panel-body">
					<?php echo $erro ?>
					<div class="row">

						<div class="col-md-6">

							<div class="form-group">
								<label for="nome">Nome:</label>
								<input type="input" class="form-control" id="nome"  name="nome" value="<?php echo $nome?>" placeholder="Nome do usuário" required>
							</div>

						</div>
						<div class="col-md-6">

							<div class="form-group">
								<label for="nome">Email:</label>
								<input type="email" class="form-control" id="email"  name="email"  value="<?php echo $email?>" placeholder="Email do usuário" required>
							</div>

						</div>
					</div>

					<div class="row">
						<div class="col-md-6">

							<div class="form-group">
								<label for="nome">Login:</label>
								<input type="input" class="form-control" id="login"  name="login"  value="<?php echo $login?>" placeholder="Login do usuário" required>
							</div>

						</div>
						<div class="col-md-6">

							<div class="form-group">
								<label for="nome">Senha:</label>
								<input type="password" class="form-control" id="senha"  name="senha"  value="<?php echo $senha?>" placeholder="Senha do usuário" required>
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