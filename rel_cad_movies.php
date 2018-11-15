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

include_once 'etc/query.php';

include_once 'head.html';

ValidaLogin();

echo "\n";
include_once 'menu.html';

if ($_SESSION["DisplayDisabled"] == "Y"){
	$Movies = Select_MyMovie("SELECT * FROM Movies;");
}else{
	$Movies = Select_MyMovie("SELECT * FROM Movies WHERE Status='E';");
}

echo "
<table class=\"table table-striped\">\n
	\t<thead>\n
		\t\t<tr>\n
			\t\t\t<th>Capa</th>
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
		
		if ($Movie_id['Status'] == 'E'){
			$Color = "black";
		}else{
			$Color = "red";
		}
		
		while($Midia_Data = $SQLServerParameterFetch($Midia)) {
			$MidiaName = $Midia_Data['Name'];
			$MidiaIcon = $Midia_Data['Icon'];
		}

		echo '<tr><td><img width="80" height="120" src="data:image/jpeg;base64,'.base64_encode( $Movie_id['Capa'] ).'"/></td>';
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
