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
$obs=$_POST['obs'];

$tmpName = $_FILES['capa']['name'];
$imagetmp=addslashes (file_get_contents($_FILES['capa']['tmp_name']));

Insert_Movie ("INSERT INTO MyMovies.Midia (Name,Note,Icon) VALUES('$name','$obs','$imagetmp');");

echo "<script>alert('Inclusão executada com sucesso!');window.location.href='form_cad_midia.php';</script>";
#printf("\n<a href=\"index.php\">Home</a>\n");
?>