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

$SQLQuery="SELECT * FROM Users WHERE Name LIKE'%".$_POST['name']."%' AND EMail LIKE '%".$_POST['email']."%' AND Nivel LIKE '%".$_POST['idaccesstype']."%';";

$Users = Select_MyMovie($SQLQuery);

echo "<form action='Display_User_Data.php' method='post'>
<table class=\"table table-striped\">\n
	\t<thead>\n
		\t\t<tr>\n
			\t\t\t<th>Opetions</th>
";
if ($_SESSION["Nivel"] == "F"){
	echo "<th> </th>";
	echo "<th> </th>";
}

echo "		<th>ID User</th>
			<th>User Name</th>
			<th>E-Mail</th>
			<th>Icones</th>
			<th>Nivel de Acesso</th>\n
		\t\t</tr>\n
	\t</thead>\n
	\t<tbody>\n";
	
	while($Users_id = $SQLServerParameterFetch($Users)) {
		echo "<tr><td><input type='submit' value='View' name='action_button[".$Users_id['id']."]'></td>\n";
		if ($_SESSION["Nivel"] == "F"){
			echo "<td><input type='submit' value='Del' name='delete_button[".$Users_id['id']."]'></td>\n";
			echo "<td><input alt='Change User Password' type='submit' value='Pass' name='password_button[".$Users_id['id']."]'></td>\n";
		}
		echo "\t<td>".$Users_id['id']."</td>\n";
		echo "\t<td>".$Users_id['Name']."</td>\n";
		echo "\t<td>".$Users_id['EMail']."</td>\n";
		echo "\t<td>".$Users_id['cfg_images']."</td>\n";
		echo "\t<td>".$Users_id['Nivel']."</td>\n</tr>\n";
	};
	echo"\t</tbody>\n</table>\n";
echo"\n</div>\n</body>\n</html>";
?>
