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

if ($_POST['idusuario']){

	$sql = "DELETE FROM usuarios WHERE idusuario=:idusuario";

	$stmt = DB::prepare($sql);
	$stmt->bindParam("idusuario",$_POST['idusuario']);
	$stmt->execute();

	setMessage("Usuário excluido com sucesso.");
	redirect("usuariosListar.php");

}



?>

<div class="col-md-4 col-md-offset-4">
	<form method="post" action="usuariosExcluir.php" class="form-horizontal" role="form">
		<input type="hidden" id="idusuario" name="idusuario" value="<?php echo $idusuario?>"/>
		<div class="panel panel-default">
			<div class="panel-heading">

				<h3 class="panel-title">Nome: <strong><?php echo $usuario->nome ?></strong>
					<a href="usuariosListar.php"  class="pull-right "><span class="glyphicon glyphicon-remove"></span></a>
				</h3></div>
				<div class="panel-body">
					<?php echo $erro ?>


					
					<p class="text-danger">Deseja excluir o usuário?</p>
					



				</div>
				<div class="panel-footer">
					<input type="submit" class="btn btn-danger" value="Sim"></input>
					<a href="usuarioslistar.php"  class="btn btn-info pull-right">Não</a>
				</div>
			</div>
		</div>
	</form>
</div>

<?php
include './includes/rodape.php';
?>