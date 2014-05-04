<?php
//Estes dois includes são obrigatórios para qualquer página PHP
include './includes/config.php';
setMenu("Usuários");
include './includes/cabecalho.php';

// Esta página deve checar se o usuário está logado
checkLogin();

$sql = "SELECT * FROM usuarios";
$stmt = DB::prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll();

?>

<div class="col-md-10 col-md-offset-1">

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><strong>Usuários</strong>

			</h3></div>
			<div class="panel-body">

				<table class="table table-striped  table-bordered">
					<tr>
						<th>Id</td>
						<th>Nome</td>
						<th>Email</td>
					</tr>
					<?php

						foreach ($usuarios as $u) {
							echo "<tr>";
							echo "<td>{$u->idusuario}</td>";
							echo "<td><a href='usuariosShow.php?idusuario={$u->idusuario}'>{$u->nome}</a></td>";
							echo "<td>{$u->email}</td>";
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


	<?php
	include './includes/rodape.php';
	?>