<?php
//Estes dois includes são obrigatórios para qualquer página PHP
include './includes/config.php';
setMenu("Usuários");
include './includes/cabecalho.php';

// Esta página deve checar se o usuário está logado
checkLogin();

?>

<div class="col-md-10 col-md-offset-1">
	<form action="usuariosNoco.php"  method="post">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><strong>Novo usuário</strong>
						<a href="usuariosListar.php"  class=" pull-right "><span class="glyphicon glyphicon-remove"></span></a>
				</h3></div>
				<div class="panel-body">

					<div class="row">
						<div class="col-md-6">

							<div class="form-group">
								<label for="nome">Nome:</label>
								<input type="input" class="form-control" id="nome"  name="nome" placeholder="Nome do usuário">
							</div>

						</div>
						<div class="col-md-6">

							<div class="form-group">
								<label for="nome">Email:</label>
								<input type="input" class="form-control" id="email"  name="email" placeholder="Email do usuário">
							</div>

						</div>
					</div>

					<div class="row">
						<div class="col-md-6">

							<div class="form-group">
								<label for="nome">Login:</label>
								<input type="input" class="form-control" id="login"  name="login" placeholder="Login do usuário">
							</div>

						</div>
						<div class="col-md-6">

							<div class="form-group">
								<label for="nome">Senha:</label>
								<input type="password" class="form-control" id="senha"  name="senha" placeholder="Senha do usuário">
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

	<?php
	include './includes/rodape.php';
	?>