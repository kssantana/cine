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
include_once ("etc/config.php");
include_once ("etc/query.php");

$MidiaName = $_POST['name'];
$MidiaNote = $_POST['note'];

ValidaLogin();

if (isset($_POST['action_button'])){
	$submitted_array = array_keys($_POST['action_button']);
	$CategID=$submitted_array[0];
	
	if(!empty($_FILES['capa']['name'])) {
		$tmpName = $_FILES['capa']['name'];
		$imagetmp=addslashes (file_get_contents($_FILES['capa']['tmp_name']));
		$SQLCommand = "UPDATE MyMovies.Midia SET Name='".$MidiaName."',Note='".$MidiaNote."',Icon='".$imagetmp."' WHERE IDMidia='".$submitted_array[0]."';";
	} else {
		$SQLCommand = "UPDATE MyMovies.Midia SET Name='".$MidiaName."',Note='".$MidiaNote."' WHERE IDMidia='".$submitted_array[0]."';";
	}

} Elseif (isset($_POST['delete_button'])){
		$submitted_array = array_keys($_POST['delete_button']);
		$CategID=$submitted_array[0];
		
		$SQLCommand=" Delete FROM MyMovies.Midia Where IDMidia='".$submitted_array[0]."';";
}

Insert_Movie ($SQLCommand);
echo "<script>alert('Operação executada com sucesso!');window.location.href='index.php';</script>";
#printf("\n<a href=\"index.php\">Home</a>\n");

?>