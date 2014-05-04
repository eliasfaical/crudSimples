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
{
	$erro = setError("Usuário não encontrado. <a href='usuariosListar.php>Voltar</a>");
}
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



?>

<div class="col-md-10 col-md-offset-1">
	<div class="panel panel-default">
		<div class="panel-heading">

			<h3 class="panel-title">Nome: <strong><?php echo $usuario->nome ?></strong>
				<a href="usuariosListar.php"  class="pull-right "><span class="glyphicon glyphicon-remove"></span></a>
			</h3></div>
			<div class="panel-body">
				<?php echo $erro ?>

				<form class="form-horizontal" role="form">
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<p class="form-control-static"><?php echo $usuario->email?></p>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Login</label>
						<div class="col-sm-10">
							<p class="form-control-static"><?php echo $usuario->login?></p>
						</div>
					</div>
					
				</form>


			</div>
			<div class="panel-footer">
				<a href="usuariosEditar.php?idusuario=<?php echo $usuario->idusuario?>" class="btn btn-default" value="Editar">Editar</a>
			</div>
		</div>
		<a href="usuariosExcluir.php?idusuario=<?php echo $usuario->idusuario?>"  class="pull-right">Excluir</a>
	</div>
	
</div>

<?php
include './includes/rodape.php';
?>