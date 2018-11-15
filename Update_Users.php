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

$UserName = $_POST['name'];
$Useremail = $_POST['email'];
$UserNivel = $_POST['tipodeacesso'];
$icones = $_POST['image'];
$Disabled=$_POST['disabled'];

if (isset($_POST['action_button'])){
	$submitted_array = array_keys($_POST['action_button']);
	$CategID=$submitted_array[0];
	
	$SQLCommand = "UPDATE MyMovies.Users SET Name='".$UserName."',EMail='".$Useremail."',Nivel='".$UserNivel."',cfg_images='".$icones."',DisplayDisabled='".$Disabled."' WHERE ID='".$submitted_array[0]."';";
} Elseif (isset($_POST['delete_button'])){
		$submitted_array = array_keys($_POST['delete_button']);
		$CategID=$submitted_array[0];
		
		$SQLCommand="Delete FROM MyMovies.Users Where ID='".$submitted_array[0]."';";
} Elseif (isset($_POST['password_button'])){
		 global $DefaultPassword;
		 
		$submitted_array = array_keys($_POST['password_button']);
		$CategID=$submitted_array[0];
		
		$SQLCommand="UPDATE MyMovies.Users SET Pass=password('$DefaultPassword') Where ID='".$submitted_array[0]."';";
}
Insert_Movie ($SQLCommand);
echo "<script>alert('Operação executada com sucesso! ATENÇÃO: Qualquer alteração de parâmetros somente entrará em vigor após Logout/Logon');window.location.href='index.php';</script>";

?>