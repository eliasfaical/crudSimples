<?php
//Estes dois includes são obrigatórios para qualquer página PHP
include './includes/config.php';
setMenu("Usuários");
include './includes/cabecalho.php';

// Esta página deve checar se o usuário está logado
checkLogin();



$sql = "SELECT * FROM usuarios";

	if ($_POST['busca'])
		$sql .= " WHERE nome LIKE '%{$_POST['busca']}%'"; // <<< WARNING SQL INJECTION

$stmt = DB::prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll();

?>

<div class="col-md-10 col-md-offset-1">

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><strong>Usuários</strong>

			</h3>
		</div>
		<div class="panel-body">

			<form method="post">
				<div class="row">
					<div class="col-md-10 has-success">
						<input type="busca" class="form-control" id="busca" name="busca" value="<?php echo $_POST['busca'] ?>" placeholder="Digite um critério e pressione o botao de busca">
					</div>
					<div class="col-md-2">
						<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
					</div>
				</div>
			</form>


			<br/>

			<table class="table table-striped  table-bordered">
				<tr>
					<th>Id</th>
					<th>Nome</th>
					<th>Email</th>
					<th>Login</th>
				</tr>
				<?php

				foreach ($usuarios as $u) {
					echo "<tr>";
					echo "<td>{$u->idusuario}</td>";
					echo "<td><a href='usuariosShow.php?idusuario={$u->idusuario}'>{$u->nome}</a></td>";
					echo "<td>{$u->email}</td>";
					echo "<td>{$u->login}</td>";
					echo "</tr>";
				}

				?>
			</table>


		</div>
		<div class="panel-footer">
			<a href="usuariosNovo.php"  class="btn btn-default">Novo</a>
		</div>
	</div>
</div>
</div>


<?php
include './includes/rodape.php';
?>