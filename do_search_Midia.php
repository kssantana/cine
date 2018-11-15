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

$SQLQuery="SELECT * FROM Midia WHERE Name LIKE'%".$_POST['name']."%' AND Note LIKE '%".$_POST['note']."%' AND IDMidia LIKE '%".$_POST['id']."%';";

$Midias = Select_MyMovie($SQLQuery);

echo "<form action='Display_Midia_Data.php' method='post'>
<table class=\"table table-striped\">\n
	\t<thead>\n
		\t\t<tr>\n
			\t\t\t<th>Opetions</th>
";
if ($_SESSION["Nivel"] == "F"){
	echo "<th> </th>";
}

echo "			<th>ID Midia</th>
			<th>Nome</th>
			<th>Observações Diversas</th>
			<th>Icone</th>\n
		\t\t</tr>\n
	\t</thead>\n
	\t<tbody>\n";
	
	while($Midia_id = $SQLServerParameterFetch($Midias)) {
		echo "<tr><td><input type='submit' value='View' name='action_button[".$Midia_id['IDMidia']."]'></td>\n";
		if ($_SESSION["Nivel"] == "F"){
			echo "<td><input type='submit' value='Del' name='delete_button[".$Midia_id['IDMidia']."]'></td>\n";
		}
		echo "\t<td>".$Midia_id['IDMidia']."</td>\n";
		echo "\t<td>".$Midia_id['Name']."</td>\n";
		echo "\t<td>".$Midia_id['Note']."</td>\n";
		echo '<td><img width="40" height="40" src="data:image/jpeg;base64,'.base64_encode( $Midia_id['Icon'] ).'"/></td></tr>';
	};
	echo"\t</tbody>\n</table>\n";
echo"\n</div>\n</body>\n</html>";
?>
