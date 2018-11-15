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
$idOrigem=$_POST['idorigem'];
$idCategoria=$_POST['idcategoria'];
$idClassificacao=$_POST['idclassificacao'];
$idTipoMidia=$_POST['IDMidia'];
#$capa=$_POST['capa'];
$Ano=$_POST['ano'];
$Sinopse=$_POST['sinopse'];

$tmpName = $_FILES['capa']['name'];
$imagetmp=addslashes (file_get_contents($_FILES['capa']['tmp_name']));
	
	
Insert_Movie ("INSERT INTO MyMovies.Des_Movies (Name,Sinopse,ID_Source,ID_Category,ID_Classific,ID_Midia,Capa,Year,Status) VALUES('$name','$Sinopse','$idOrigem','$idCategoria','$idClassificacao','$idTipoMidia','$imagetmp','$Ano','E');");

#printf("\n<b>Name:</b> $name \n");
#printf("<br><\br>\n<b>Origem:</b> $idOrigem \n");
#printf("\n<br><\br><b>Categoria:</b> $idCategoria \n");
#printf("\n<br><\br><b>Classificacao:</b> $idClassificacao \n");
#printf("\n<br><\br><b>Tipo Midia:</b> $idTipoMidia \n");
#printf("\n<br><\br><b>Capa:</b> $_FILES['capa'] \n");
#printf("\n<br><\br><b>Ano:</b> $Ano \n");
#printf("\n<br><\br><b>Sinopse:</b> $Sinopse \n");

echo "<script>alert('Inclusão executada com sucesso!');window.location.href='form_cad_DESfilmes.php';</script>";
#printf("\n<a href=\"index.php\">Home</a>\n");
?>