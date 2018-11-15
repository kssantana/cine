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

Insert_Movie ("INSERT INTO MyMovies.Source (Name,NOTE) VALUES('$name','$obs');");

echo "<script>alert('Inclusão executada com sucesso!');window.location.href='form_cad_source.php';</script>";
#printf("\n<a href=\"index.php\">Home</a>\n");
?>