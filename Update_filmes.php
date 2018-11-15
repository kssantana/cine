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

#printf("\n<b>Name:</b> $name \n");
#printf("<br><\br>\n<b>Origem:</b> $idOrigem \n");
#printf("\n<br><\br><b>Categoria:</b> $idCategoria \n");
#printf("\n<br><\br><b>Classificacao:</b> $idClassificacao \n");
#printf("\n<br><\br><b>Tipo Midia:</b> $idTipoMidia \n");
#printf("\n<br><\br><b>Capa:</b> $_FILES['capa'] \n");
#printf("\n<br><\br><b>Ano:</b> $Ano \n");
#printf("\n<br><\br><b>Sinopse:</b> $Sinopse \n");

if (isset($_POST['action_button'])){
	$submitted_array = array_keys($_POST['action_button']);
	$MovieID=$submitted_array[0];
	
		if (isset($_POST['AlteraCapa'])){
			if(!empty($_FILES['capa']['name'])) {
				$tmpName = $_FILES['capa']['name'];
				$imagetmp=addslashes (file_get_contents($_FILES['capa']['tmp_name']));
			
				$SQLCommand = "UPDATE MyMovies.Movies SET Name='".$name."',Sinopse='".$Sinopse."',ID_Source='".$idOrigem."',ID_Category='".$idCategoria."',ID_Classific='".$idClassificacao."',ID_Midia='".$idTipoMidia."',Year='".$Ano."',Capa='".$imagetmp."' WHERE IDMovies='".$submitted_array[0]."';";
			}else{
				$SQLCommand = "UPDATE MyMovies.Movies SET Name='".$name."',Sinopse='".$Sinopse."',ID_Source='".$idOrigem."',ID_Category='".$idCategoria."',ID_Classific='".$idClassificacao."',ID_Midia='".$idTipoMidia."',Year='".$Ano."' WHERE IDMovies='".$submitted_array[0]."';";		
			}
		}else{
			$SQLCommand = "UPDATE MyMovies.Movies SET Name='".$name."',Sinopse='".$Sinopse."',ID_Source='".$idOrigem."',ID_Category='".$idCategoria."',ID_Classific='".$idClassificacao."',ID_Midia='".$idTipoMidia."',Year='".$Ano."' WHERE IDMovies='".$submitted_array[0]."';";
		}

} Elseif (isset($_POST['delete_button'])){
		$submitted_array = array_keys($_POST['delete_button']);
		$MovieID=$submitted_array[0];
		
		$SQLCommand=" Delete FROM Movies Where IDMovies='".$submitted_array[0]."';";
} Elseif (isset($_POST['enable_button'])){
		$submitted_array = array_keys($_POST['enable_button']);
		$MovieID=$submitted_array[0];
	
		$SQLCommand="UPDATE Movies SET Status='E' Where IDMovies='".$submitted_array[0]."';";
} Elseif (isset($_POST['disable_button'])){
		$submitted_array = array_keys($_POST['disable_button']);
		$MovieID=$submitted_array[0];
	
		$SQLCommand="UPDATE Movies SET Status='D' Where IDMovies='".$submitted_array[0]."';";
}

Insert_Movie ($SQLCommand);
echo "<script>alert('Operação executada com sucesso!');window.location.href='index.php';</script>";
#printf("\n<a href=\"index.php\">Home</a>\n");

?>