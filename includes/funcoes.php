<?php 
/**
* Verifica o login. Se nao houver o login na sessao, 
* redireciona para a pagina de login.
*/
function checkLogin()
{
	if ($_SESSION["login_id"] == null)
		redirect("loginForm.php");
}

/**
* Redireciona para uma página qualquer.
*/
function redirect($page)
{
	header( "Location: $page") ;
}

/**
* Diz qual é o item de menu q deve aparecer como ativo
*/
function setMenu($menu)
{
	define("MENU",$menu);
}

/**
* Retorna uma mensagem de erro personalizada do bootstrap
*/
function setError($erro){
	return "<p class='alert alert-danger'><span class='glyphicon glyphicon-warning-sign'></span> $erro</p>";
}

/**
* Adiciona uma mensagem na sessao
* Usado para adicionar uma mensagem e redirecionar para alguma pagina
*/
function setMessage($msg)
{
	$_SESSION['message']=$msg;	
}
