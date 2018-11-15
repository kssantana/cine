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

if (isset($_POST['cad_button'])){
	$ValorCompra = str_replace(',','.', $_POST['valor']);
}


#number_format($_POST['valor'], 2, ',', '.');
#str_replace('.', '', str_replace(',','.',substr($_POST['valor'],2)));


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
			
				$SQLCommand = "UPDATE MyMovies.Des_Movies SET Name='".$name."',Sinopse='".$Sinopse."',ID_Source='".$idOrigem."',ID_Category='".$idCategoria."',ID_Classific='".$idClassificacao."',ID_Midia='".$idTipoMidia."',Year='".$Ano."',Capa='".$imagetmp."' WHERE IDMovies='".$submitted_array[0]."';";
			}else{
				$SQLCommand = "UPDATE MyMovies.Des_Movies SET Name='".$name."',Sinopse='".$Sinopse."',ID_Source='".$idOrigem."',ID_Category='".$idCategoria."',ID_Classific='".$idClassificacao."',ID_Midia='".$idTipoMidia."',Year='".$Ano."' WHERE IDMovies='".$submitted_array[0]."';";		
			}
		}else{
			$SQLCommand = "UPDATE MyMovies.Des_Movies SET Name='".$name."',Sinopse='".$Sinopse."',ID_Source='".$idOrigem."',ID_Category='".$idCategoria."',ID_Classific='".$idClassificacao."',ID_Midia='".$idTipoMidia."',Year='".$Ano."' WHERE IDMovies='".$submitted_array[0]."';";
		}

} Elseif (isset($_POST['delete_button'])){
		$submitted_array = array_keys($_POST['delete_button']);
		$MovieID=$submitted_array[0];
		
		$SQLCommand=" Delete FROM Des_Movies Where IDMovies='".$submitted_array[0]."';";
} Elseif (isset($_POST['cad_button'])){
		$submitted_array = array_keys($_POST['cad_button']);
		$MovieID=$submitted_array[0];
		
		$QueryMovie = "select * from Des_Movies WHERE IDMovies='".$MovieID."';";
		$Filme = Select_MyMovie($QueryMovie);

		while($filme_id = $SQLServerParameterFetch($Filme)) {
			$MovieName = $filme_id['Name'];
			$MovieIDOrigem = $filme_id['ID_Source'];
			$Sinopse = $filme_id['Sinopse'];
			$IDCategory = $filme_id['ID_Category'];
			$ID_Classific = $filme_id['ID_Classific'];
			$ID_Midia = $filme_id['ID_Midia'];
			$Ano = $filme_id['Year'];
		};
	
		#Cadastra os dados do Filme Desejado no banco de dados de Filmes:
		$SQLCommand="INSERT INTO MyMovies.Movies (Name,Sinopse,ID_Source,ID_Category,ID_Classific,ID_Midia,Year,Status) VALUES('$MovieName','$Sinopse','$MovieIDOrigem','$idCategoria','$ID_Classific','$ID_Midia','$Ano','E');";
		Insert_Movie ($SQLCommand);
		
		#Pega o ID Do registro que acabou de Ser inserido.
		$IDMovieNew = Select_MyMovie('SELECT LAST_INSERT_ID();');
		while($NewMovieID = $SQLServerParameterFetch($IDMovieNew)){
			$NewMovie = $NewMovieID['LAST_INSERT_ID()'];
		}
				
		#Insere os dados de histórico no banco de dados de histórico.
		$SQLCommand="INSERT INTO Des_Historico (ID_Des_Movie, ID_Movies, DataAquisicao, Valor) VALUES ($MovieID,$NewMovie,now(),$ValorCompra);";
		Insert_Movie ($SQLCommand);
		
		#Desabilita o Filme desejado, pois ja esta cadastrado.
		$SQLCommand="UPDATE Des_Movies SET Status='D' WHERE IDMovies=$MovieID";
		Insert_Movie ($SQLCommand);
}
if (isset($_POST['cad_button'])){

}else {
	Insert_Movie ($SQLCommand);
}

echo "<script>alert('Operação executada com sucesso!');window.location.href='index.php';</script>";
#printf("\n<a href=\"index.php\">Home</a>\n");

?>