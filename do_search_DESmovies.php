<?php
///////////////////////////////////////////////////////////////////////
//===================================================================//
//+-----------------------------------------------------------------+//
//|					PINN NEX Systems	        					|//
//|  Inteligencia de coleta de processamento e coleta de dados 	    |//
//| De gerenciamento de rede de computadores e sistemas			    |//
//+-----------------------------------------------------------------+// 	
//| DATA: 24/02/2016 - KLEBER DA SILVA SANTANA / EDNALDO ROSSI		|//
//| VERSÃO: 1.0														|//
//| ULTIMA MODIFICAÇÃO: 24/02/2016									|//	
//+-----------------------------------------------------------------+//
//===================================================================//	
///////////////////////////////////////////////////////////////////////
session_start();
include_once ("etc/config.php");
include_once ("etc/query.php");
include_once 'head.html';
echo "\n";
include_once 'menu.html';

ValidaLogin();

if ($_SESSION["DisplayDisabled"] == "Y"){
	$SQLQuery="SELECT * FROM Des_Movies WHERE Name LIKE'%".$_POST['name']."%' AND ID_Source LIKE '%".$_POST['idorigem']."%' AND ID_Category LIKE '%".$_POST['idcategoria']."%' AND ID_Classific LIKE'%".$_POST['idclassificacao']."%' AND ID_Midia LIKE '%".$_POST['IDMidia']."%' AND Year LIKE '%".$_POST['ano']."%' AND Sinopse LIKE '%".$_POST['sinopse']."%' AND IDMovies LIKE '%".$_POST['IDM']."%' AND Status LIKE '%".$_POST['Status']."%';";
}else{
	if ($_POST['Status'] == 'D'){
		$SQLQuery="SELECT * FROM Des_Movies WHERE Name LIKE'%".$_POST['name']."%' AND ID_Source LIKE '%".$_POST['idorigem']."%' AND ID_Category LIKE '%".$_POST['idcategoria']."%' AND ID_Classific LIKE'%".$_POST['idclassificacao']."%' AND ID_Midia LIKE '%".$_POST['IDMidia']."%' AND Year LIKE '%".$_POST['ano']."%' AND Sinopse LIKE '%".$_POST['sinopse']."%' AND IDMovies LIKE '%".$_POST['IDM']."%' AND Status='D';";
	}else{
		$SQLQuery="SELECT * FROM Des_Movies WHERE Name LIKE'%".$_POST['name']."%' AND ID_Source LIKE '%".$_POST['idorigem']."%' AND ID_Category LIKE '%".$_POST['idcategoria']."%' AND ID_Classific LIKE'%".$_POST['idclassificacao']."%' AND ID_Midia LIKE '%".$_POST['IDMidia']."%' AND Year LIKE '%".$_POST['ano']."%' AND Sinopse LIKE '%".$_POST['sinopse']."%' AND IDMovies LIKE '%".$_POST['IDM']."%' AND Status='E';";
	}
}



$Movies = Select_MyMovie($SQLQuery);

echo "<form action='Display_DESMovie_Data.php' method='post'>
<table class=\"table table-striped\">\n
	\t<thead>\n
		\t\t<tr>\n
			\t\t\t<th>Opetions</th>
";
if ($_SESSION["Nivel"] == "F"){
	echo "<th> </th>";
	echo "<th> </th>";
}

echo "		<th>Capa</th>
			<th>ID</th>
			<th>Name</th>
			<th>Sinopse</th>
			<th>Year</th>
			<th>Midia</th>\n
		\t\t</tr>\n
	\t</thead>\n
	\t<tbody>\n";
	
	while($Movie_id = $SQLServerParameterFetch($Movies)) {
		#Busca informações referentes a Midia cadastrada no Filme em trabalho corrente.
		$QueryMidia = "select Name,Icon from Midia WHERE IDMidia='".$Movie_id['ID_Midia']."';";
		$Midia = Select_MyMovie($QueryMidia);
		while($Midia_Data = $SQLServerParameterFetch($Midia)) {
			$MidiaName = $Midia_Data['Name'];
			$MidiaIcon = $Midia_Data['Icon'];
		}
		
		echo "<tr><td><input type='submit' value='View' name='action_button[".$Movie_id['IDMovies']."]'></td>\n";
		if ($_SESSION["Nivel"] == "F"){
			echo "<td><input type='submit' value='Del' name='delete_button[".$Movie_id['IDMovies']."]'></td>\n";
			if ($Movie_id['Status'] == 'E'){
				echo "<td><input type='submit' value='Cad.' name='cad_button[".$Movie_id['IDMovies']."]'></td>\n";
				$Color = "black";
			} else {
				#echo "<td><input type='submit' value='Ena.' name='enable_button[".$Movie_id['IDMovies']."]'></td>\n";
				$Color = "red";
			}
		}
		echo '<td><img width="80" height="120" src="data:image/jpeg;base64,'.base64_encode( $Movie_id['Capa'] ).'"/></td>';
		echo "\t<td><font color=$Color>".$Movie_id['IDMovies']."</td>\n";
		echo "\t<td><font color=$Color>".$Movie_id['Name']."</td>\n";
		echo "\t<td><font color=$Color>".$Movie_id['Sinopse']."</td>\n";
		echo "\t<td><font color=$Color>".$Movie_id['Year']."</td>\n";
		
		if ($_SESSION['cfg_images'] == "Y"){
		    echo '<td><img width="40" height="40" src="data:image/jpeg;base64,'.base64_encode( $MidiaIcon ).'"/></td></tr>';
		} else {
			echo "\t<td><font color=$Color>".$MidiaName."</td>\n";
		}
	
	};
	echo"\t</tbody>\n</table>\n";
echo"\n</div>\n</body>\n</html>";
?>
