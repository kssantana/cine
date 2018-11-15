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

ValidaLogin();

$ClassName = $_POST['name'];
$ClassIDADE = $_POST['idade'];

if (isset($_POST['action_button'])){
	$submitted_array = array_keys($_POST['action_button']);
	$MovieID=$submitted_array[0];
	
	$SQLCommand = "UPDATE MyMovies.Classificacao SET Name='".$ClassName."',IDADE='".$ClassIDADE."' WHERE IDClassific='".$submitted_array[0]."';";

} Elseif (isset($_POST['delete_button'])){
		$submitted_array = array_keys($_POST['delete_button']);
		$MovieID=$submitted_array[0];
		
		$SQLCommand=" Delete FROM MyMovies.Classificacao Where IDClassific='".$submitted_array[0]."';";
}

Insert_Movie ($SQLCommand);
echo "<script>alert('Operação executada com sucesso!');window.location.href='index.php';</script>";
#printf("\n<a href=\"index.php\">Home</a>\n");

?>