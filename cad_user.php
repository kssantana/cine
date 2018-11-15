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

include_once ("etc/config.php");
include_once ("etc/query.php");
ValidaLogin();
$name=$_POST['name'];
$senha=$_POST['senha'];
$confsenha=$_POST['confsenha'];
$access=$_POST['access'];
$email=$_POST['email'];
$icone=$_POST['image'];
$Disabled=$_POST['disabled'];

if ($senha == $confsenha){
	$SQLCommand="INSERT INTO MyMovies.Users (Name,Pass,EMail,Nivel,cfg_images,DisplayDisabled) VALUES('$name',password('$confsenha'),'$email','$access','$icone','$Disabled');";
	Insert_Movie ($SQLCommand);
	echo "<script>alert('Inclusão executada com sucesso!');window.location.href='conf_cad_user.php';</script>";
} else {
	print ("<font color=red><b>AS SENHAS DIGITADAS NÃO SÃO EQUIVALENTES, VERIFIQUE!</b></font>");
}
?>