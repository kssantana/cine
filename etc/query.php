<?php
include ("etc/config.php");
date_default_timezone_set('America/Sao_Paulo');
if (!isset($_SESSION)) { session_start(); }
///////////////////////////////////////////////////////////////////////
//===================================================================//
//+-----------------------------------------------------------------+//
//|					DATA WAREHOUSE NEX Systems						|//
//|  Inteligencia de coleta de processamento e coleta de dados 	    |//
//| De gerenciamento de rede de computadores e sistemas			    |//
//+-----------------------------------------------------------------+// 	
//| DATA: 10/05/2015 - KLEBER DA SILVA SANTANA / EDNALDO ROSSI		|//
//| VERS�O: 1.0														|//
//| ULTIMA MODIFICA��O: 25/02/2016									|//	
//+-----------------------------------------------------------------+//
//===================================================================//	
///////////////////////////////////////////////////////////////////////

##########################################################################
#////////////////////////////////////////////////////////////////////////#
#// 		           	* OPERATIONAL FUNCTIONS  * 					   //#
#////////////////////////////////////////////////////////////////////////#
##########################################################################

function ValidaPermissao(){
	
if (isset($_SESSION['UserName']) && !empty($_SESSION['UserName'])) {
	if ($_SESSION["Nivel"] == "F"){

	}else{
		echo "<script>alert('Você não Tem autorização para utilizar esse modulo');window.location.href='index.php';</script>";
	}
} else {

}
}

function ValidaLogin(){

if (isset($_SESSION['UserName']) && !empty($_SESSION['UserName'])) {
	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $SessionTimeOut)) { // last request was more than 30 minutes ago
		session_unset();     // unset $_SESSION variable for the run-time 
		session_destroy();   // destroy session data in storage
	}
	Return 'True';
} Else {
	echo "<script>alert('Você não esta logado na aplicação, faça o login antes de continuar...');window.location.href='login.php';</script>";
}
}
##########################################################################
#////////////////////////////////////////////////////////////////////////#
#//            * FUNCOES DE CONSULTA EM BASE DE DADOS * 			   //#
#////////////////////////////////////////////////////////////////////////#
##########################################################################

#Funcao de coleta de dados da Base de NMS:
function Select_MyMovie($SQLCommand){
    global $DB_MyMovies;
	global $PHPVersion;
	
	
	if ($PHPVersion == "5"){
		mysql_select_db($DB_MyMovies);
	
		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');
	
		$Result = mysql_query($SQLCommand);
	
	} elseif ($PHPVersion == "7"){
			global $DB;
		
			mysqli_query($DB, "SET NAMES 'utf8'");
			mysqli_query($DB, 'SET character_set_connection=utf8');
			mysqli_query($DB, 'SET character_set_client=utf8');
			mysqli_query($DB, 'SET character_set_results=utf8');
	
			$Result = mysqli_query($DB, $SQLCommand);
	}
	
	return $Result;
}

#Funcao de coleta de dados da Base de NIM:
function Select_NIM($SQLCommand){
	global $DB_NIM;

	mysql_select_db($DB_NIM);
	
	$Result = mysql_query($SQLCommand);
	
	return $Result;
}

#Funcao de coleta de dados da Base de NCS:
function Select_NCS($SQLCommand){
	global $DB_NCS;

	mysql_select_db($DB_NCS);
	
	$Result = mysql_query($SQLCommand);
		
	return $Result;
}

#Funcao de coleta de dados da Base de DW:
function Select_DW($SQLCommand){
	global $DB_DW;

	mysql_select_db($DB_DW);
	
	$Result = mysql_query($SQLCommand);
	
	return $Result;
}

#Funcao de coleta de dados da Base de PINN:
function Select_PINN($SQLCommand){
	global $DB_PINN;

	mysql_select_db($DB_PINN);
	
	$Result = mysql_query($SQLCommand);
	
	return $Result;
}

##########################################################################
#////////////////////////////////////////////////////////////////////////#
#// 		           	* UPDATE FUNCTIONS  *    					   //#
#////////////////////////////////////////////////////////////////////////#
##########################################################################
function Update_DW($SQLUpdate){
	global $DB_DW;
	
	mysql_select_db($DB_DW);
	
	mysql_query($SQLUpdate) or die (mysql_error());

}

function Update_PINN($SQLUpdate){
	global $DB_PINN;
	
	mysql_select_db($DB_PINN);
	
	mysql_query($SQLUpdate) or die (mysql_error());

}
##########################################################################
#////////////////////////////////////////////////////////////////////////#
#// 		           	* INSERT FUNCTIONS  *    					   //#
#////////////////////////////////////////////////////////////////////////#
##########################################################################

function Insert_Movie($SQLInsert){
	global $DB_MyMovies;
	global $PHPVersion;
	
	if ($PHPVersion == "5"){
		mysql_select_db($DB_MyMovies);
	
		mysql_query($SQLInsert) or die (mysql_error());
	} elseif ($PHPVersion == "7"){
		global $DB;
		
		mysqli_query($DB, $SQLInsert) or die (mysqli_error($DB));
	}
}

##########################################################################
#////////////////////////////////////////////////////////////////////////#
#// 		           	* FUNCOES ESPECIFICAS * 					   //#
#////////////////////////////////////////////////////////////////////////#
##########################################################################

function GetLastState($HostID){
	global $DB_DW;
	
	mysql_select_db($DB_DW);
	
	$SQLCommand="SELECT nms_LastState,nms_LastDate FROM  nms_LastState WHERE nms_id=$HostID;";
	
	$LST = mysql_query($SQLCommand) or die (mysql_error());
	
	if (mysql_num_rows($LST)>0){
		$Result_partial=mysql_fetch_array($LST);	
	} else {
		$Result = -1;
	}

	$Result=$Result_partial['nms_LastState'];

	return $Result;
}

function GetLastStateAllInfo($HostID){
	global $DB_DW;
	
	mysql_select_db($DB_DW);
	
	$SQLCommand="SELECT nms_LastState,nms_LastDate FROM  nms_LastState WHERE nms_id=$HostID;";
	
	$LST = mysql_query($SQLCommand) or die (mysql_error());
	
	if (mysql_num_rows($LST)>0){
		$Result_partial=mysql_fetch_array($LST);	
	} else {
		$Result = -1;
	}

	return $Result_partial;
}

# Funcao para coletar o stado atual do host.
function GetActualState($HostID){
	global $DB_NMS;
	
	mysql_select_db($DB_NMS);
	
	$SQLCommand="SELECT current_state FROM nagios_hoststatus WHERE host_object_id=$HostID;";

	$LST = mysql_query($SQLCommand) or die (mysql_error());
	$Result_Actual=mysql_fetch_array($LST);

	$Result = $Result_Actual['current_state']; 
	return $Result;
	
}

#Função que coleta o Hostname através do ID
function Get_HostName($HostID){
	global $DB_NMS;
	
	mysql_select_db($DB_NMS);
	
	$SQLGetHostName = "SELECT display_name FROM nagios_hosts WHERE host_object_id=$HostID;";
	
	$LST = mysql_query($SQLGetHostName) or die (mysql_error());
	$Result=mysql_fetch_array($LST);	

	return $Result;
}

#Função que retorna o numero de hosts com Status UP nas Bases do NMS.
function Get_NumHostsOK(){
	global $DB_NMS;

	mysql_select_db($DB_NMS);

	$NumberOfHostsOK = "SELECT COUNT(*) FROM nexnmsdb.nagios_servicestatus WHERE current_state=0;";

	$LST = mysql_query($NumberOfHostsOK) or die (mysql_error());
	$Result=mysql_fetch_array($LST);

	return $Result;
}

#Função que coleta o atual status dos hosts.
function Get_RealState($HostID){
	global $DB_NMS;
	
	mysql_select_db($DB_NMS);
	
	$SelectRealState="SELECT output,current_state from nagios_hoststatus WHERE host_object_id=$HostID;";
	
	$LST = mysql_query($SelectRealState) or die (mysql_error());
	$Result=mysql_fetch_array($LST);
	
	return $Result;
}

#Coleta as estatisticas da ultima execu��o da carda do DW:
function Get_AvailableStatistics($HostID){
	$data = gmdate("y/m/d", time()-(3600*27));
	global $DB_DW;
	
	mysql_select_db($DB_DW);
	
	$SelectRealState="SELECT nms_timeup,nms_timedown,nms_timeunk,nms_dt FROM nms_available WHERE nms_id=$HostID and date(nms_dt)='$data';";
	
	$LST = mysql_query($SelectRealState) or die (mysql_error());
	$Result=mysql_fetch_array($LST);
	
	return $Result;
}

#Função que calcula a somatoria das horas dos eventos.
function SomaHora($inicio,$fim){
	$inicioSegundos = 0;
	$fimSegundos = 0;
	
	#Quebrando o tempo em HORAS, MINUTOS, SEGUNDOS.
	list($inicioH,$inicioM,$inicioS)=split(':',$inicio);
	list($fimH,$fimM,$fimS)=split(':',$fim);
	
	#CONVERTANDO HORAS E MINUTOS EM SEGUNDOS.
	$inicioSegundos += $inicioH * 3600;
	$inicioSegundos += $inicioM * 60;
    $inicioSegundos += $inicioS;	
	$fimSegundos += $fimH * 3600;
	$fimSegundos += $fimM * 60;
    $fimSegundos += $fimS;

	#SOMANDO OS SEGUNDOS DOS DOIS TEMPOS.
	$TempoTotal = $inicioSegundos + $fimSegundos;
	
	#CONVERTENDO EM FORMATO DE TEMPO NOVAMENTE.
	$horas = floor( $TempoTotal / 3600 );
	$TempoTotal %= 3600;
	$minutos = floor( $TempoTotal / 60 );
	$TempoTotal %= 60;
	
	#TRANTANDO SEGUNDOS E MINUTOS MENORES DE 10 PARA TEREM DUAS CASAS.
	if ($minutos < 10){
		if ($TempoTotal < 10){
			$intervalo = "{$horas}:0{$minutos}:0{$TempoTotal}";
		}else{
			$intervalo = "{$horas}:0{$minutos}:{$TempoTotal}"; 
		}
	} else {
		if ($TempoTotal < 10){
			$intervalo = "{$horas}:{$minutos}:0{$TempoTotal}";
		}else{
			$intervalo = "{$horas}:{$minutos}:{$TempoTotal}"; 
		}
	}
	
	#printf("\nDIFERENCA DE TEMPO: $intervalo\n");
	return $intervalo;
}

function SumTime($StartTime, $EndTime){
	#CONVERTENDO VARIAVEIS DE TEMPO EM FORMATO DE HORA.
	$inicio = DateTime::createFromFormat('H:i:s', $StartTime);
	$fim = DateTime::createFromFormat('H:i:s', $EndTime);
	
	#CALCULANDO A DIFEREN�A DAS DUAS HORAS PASSADAS.
	$intervalo = $inicio->diff($fim);
	
	#CONVERTENDO VALORES CALCULADOS EM STRING PARA DEVOLVER PARA A FUN��O ORIGINAL.
	$DIFHORAS = $intervalo->format('%H:%I:%S' );

	#printf("\nSOMA DAS HORAS: $DIFHORAS\n");
	
	return $DIFHORAS;
}

function ValidLastState($HostID){
	global $DB_DW;
	
	mysql_select_db($DB_DW);
	
	$SQLCommand="SELECT nms_LastState,nms_LastDate FROM  nms_LastState WHERE nms_id=$HostID;";
	$LST = mysql_query($SQLCommand);

	if (mysql_num_rows($LST)>0){
		$Result = 1;	
	} else {
		$Result = 0;
	}
	
	return $Result;
}

?>
