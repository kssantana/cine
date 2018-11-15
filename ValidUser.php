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

#Busca informações do usuario na base de dados.
#$SQLQuery="SELECT * FROM Users WHERE Name='".$_POST['UserName']."' AND Pass=password('".$_POST['password']."');";
$SQLQuery="SELECT * FROM Users WHERE Name='".$_POST['UserName']."' AND Pass=password('".$_POST['password']."') AND Nivel != 'D';";

$User = Select_MyMovie($SQLQuery);

while($User_ID = $SQLServerParameterFetch($User)) {
	$_SESSION["UserName"] = $User_ID['Name'];
	$_SESSION["EMail"] = $User_ID['EMail'];
	$_SESSION["ID"] = $User_ID['id'];
	$_SESSION["Nivel"] = $User_ID['Nivel'];	
	$_SESSION["Password"] = $User_ID['Pass'];
	$_SESSION["cfg_images"] = $User_ID['cfg_images'];
	$_SESSION["DisplayDisabled"] = $User_ID['DisplayDisabled'];
};

#Verifica se o usuario foi encontrado e uma sessão foi criada.

if ($SQLServerParameterRows($User)>0 and $_POST['UserName'] == $_SESSION["UserName"]) {
	header("location: index.php");
} else {
	print ("<font color=red><b>USUARIO OU SENHA INVALIDA, CONTATE O ADMINISTRADOR!</b></font>");
}

	echo"\t</tbody>\n</table>\n";
echo"\n</div>\n</body>\n</html>";
?>
