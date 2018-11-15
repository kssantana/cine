<?php
///////////////////////////////////////////////////////////////////////
//===================================================================//
//+-----------------------------------------------------------------+//
//|					PINN NEX Systems	        					|//
//|  Inteligencia de coleta de processamento e coleta de dados 	    |//
//| De gerenciamento de rede de computadores e sistemas			    |//
//+-----------------------------------------------------------------+// 	
//| DATA: 22/02/2016 - KLEBER DA SILVA SANTANA / EDNALDO ROSSI		|//
//| VERSÃO: 1.0														|//
//| ULTIMA MODIFICAÇÃO: 22/02/2016									|//	
//+-----------------------------------------------------------------+//
//===================================================================//	
///////////////////////////////////////////////////////////////////////
# < 1 >Busca_Movies.php >> < 2 >do_search_movies.php >> < 3 >Display_Movie_Data.php >> < 4 > Update_filmes.php
session_start();
include_once ("etc/config.php");
include_once ("etc/query.php");

ValidaLogin();

$Senha = $_POST['senha'];
$ConfSenha = $_POST['confsenha'];
$ID = $_SESSION["ID"];

if( $Senha == $ConfSenha){
	$SQLCommand="UPDATE MyMovies.Users SET Pass=password('$ConfSenha') Where ID='".$ID."';";
	Insert_Movie ($SQLCommand);
	printf("\n<a href=\"index.php\">Home</a>\n");
} else {
	print ("<font color=red><b>AS SENHAS DIGITADAS NÃO SÃO EQUIVALENTES, VERIFIQUE!</b></font>");
}

?>