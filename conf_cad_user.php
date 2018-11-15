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
include_once 'etc/query.php';
include ("etc/config.php");
if (!isset($_SESSION)) { session_start(); }
ValidaLogin();

include_once 'head.html';
echo "\n";
include_once 'menu.html';
if ($_SESSION["Nivel"] == "F"){
	include_once 'conf_cad_user.html';
}else{
	print ("<font color=red><b>VOCÊ NÃO TEM PERMISSÃO PARA USAR ESSE MODULO, CONTATE O ADMINISTRADOR!</b></font>");
}
echo"\n</body>\n</html>";
 ?>