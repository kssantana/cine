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

$SQLQuery="SELECT * FROM Classificacao WHERE Name LIKE'%".$_POST['name']."%' AND IDADE LIKE '%".$_POST['idade']."%' AND IDClassific LIKE '%".$_POST['IDCLASS']."%';";

$Classificacao = Select_MyMovie($SQLQuery);

echo "<form action='Display_Clas_Data.php' method='post'>
<table class=\"table table-striped\">\n
	\t<thead>\n
		\t\t<tr>\n
			\t\t\t<th>Opetions</th>
";
if ($_SESSION["Nivel"] == "F"){
	echo "<th> </th>";
}

echo "			<th>ID Classificacao</th>
			<th>Nome</th>
			<th>Idade</th>\n
		\t\t</tr>\n
	\t</thead>\n
	\t<tbody>\n";
	
	while($Class_id = $SQLServerParameterFetch($Classificacao )) {
		echo "<tr><td><input type='submit' value='View' name='action_button[".$Class_id['IDClassific']."]'></td>\n";
		if ($_SESSION["Nivel"] == "F"){
			echo "<td><input type='submit' value='Del' name='delete_button[".$Class_id['IDClassific']."]'></td>\n";
		}
		echo "\t<td>".$Class_id['IDClassific']."</td>\n";
		echo "\t<td>".$Class_id['Name']."</td>\n";
		echo "\t<td>".$Class_id['IDADE']."</td>\n</tr>\n";
	};
	echo"\t</tbody>\n</table>\n";
echo"\n</div>\n</body>\n</html>";
?>
