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

$SQKCommand = "SELECT * FROM Des_Historico;";

$Historico = Select_MyMovie($SQKCommand);

echo "
<table class=\"table table-striped\">\n
	\t<thead>\n
		\t\t<tr>\n
			\t\t\t<th>Capa</th>
			<th>ID Desejo</th>
			<th>Filme Desejado</th>
			<th>ID Comprado</th>
			<th>Filme Comprado</th>
			<th>VLR Compra</th>\n
		\t\t</tr>\n
	\t</thead>\n
	\t<tbody>\n";
	while($Historico_ID = $SQLServerParameterFetch($Historico)) {
		#Busca informações referentes a Midia cadastrada no Filme em trabalho corrente.
		$QueryMovies = "select * from Movies WHERE IDMovies='".$Historico_ID['ID_Movies']."';";
		$Movies = Select_MyMovie($QueryMovies);
		
		while($Movie_Data = $SQLServerParameterFetch($Movies)) {
			$MovieName = $Movie_Data['Name'];
			$MovieStatus = $Movie_Data['Status'];
			$MovieID = $Historico_ID['ID_Movies'];
		}
		
		if ($MovieStatus == 'E'){
			$ColorMovie = "black";
		}else{
			$ColorMovie = "red";
		}
				
		$QueryDesMovies = "select * from Des_Movies WHERE IDMovies='".$Historico_ID['ID_Des_Movie']."';";
		$DesMovies = Select_MyMovie($QueryDesMovies);
		
		while($DesMovie_Data = $SQLServerParameterFetch($DesMovies)) {
			$DesMovieName = $DesMovie_Data['Name'];
			$DesMovieID = $Historico_ID['ID_Des_Movie'];
			$DesMovieStatus = $DesMovie_Data['Status'];
			$DesMovieCapa = $DesMovie_Data['Capa'];
		}
						
		if ( $DesMovieStatus == 'E'){
			$ColorDesMovie = "black";
		}else{
			$ColorDesMovie = "red";
		}

		echo '<tr><td><img width="80" height="120" src="data:image/jpeg;base64,'.base64_encode( $DesMovieCapa ).'"/></td>';
		echo "\t<td><font color=$ColorDesMovie>".$DesMovieID."</td>\n";
		echo "\t<td><font color=$ColorDesMovie>".$DesMovieName."</td>\n";
		echo "\t<td><font color=$ColorMovie>".$MovieID."</td>\n";
		echo "\t<td><font color=$ColorMovie>".$MovieName."</td>\n";
		echo "\t<td><font color=$ColorMovie>R$ ".number_format($Historico_ID['Valor'], 2, ',', '.')."</td>\n";
		
		
	};
	echo"\t</tbody>\n</table>\n";
echo"\n</div>\n</body>\n</html>";
?>
