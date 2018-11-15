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

include_once 'head.html';
echo "\n";
include_once 'menu.html';
include_once 'busca_movies.html';
echo"\n</body>\n</html>";
 ?>