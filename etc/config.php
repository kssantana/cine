<?php
///////////////////////////////////////////////////////////////////////
//===================================================================//
//+-----------------------------------------------------------------+//
//|					DATA WAREHOUSE NEX Systems						|//
//|  Inteligencia de coleta de processamento e coleta de dados 	    |//
//| De gerenciamento de rede de computadores e sistemas			    |//
//+-----------------------------------------------------------------+// 	
//| DATA: 10/05/2015 - KLEBER DA SILVA SANTANA	/ EDNALDO ROSSI		|//
//| VERS�O: 1.0														|//
//| ULTIMA MODIFICA��O: 08/02/2016									|//	
//+-----------------------------------------------------------------+//
//===================================================================//	
///////////////////////////////////////////////////////////////////////
#if (!isset($_SESSION)) { session_start(); }

include_once 'etc/query.php';

//******************************************************//
//* VARIABLES E CONFIGURA��ES DO BANCO DE DADOS:		//
//******************************************************//
#DB HOST DEV NA CPFL:
#$host = "192.168.250.3"; //Servidor do mysql
#DB HOST DEV:
#$host = "192.168.1.181"; //Servidor do mysql
#DB HOST PRODUCAO (ON PREMISSE):
#$host = "192.168.3.14"; //Servidor do mysql
#DB HOST PRODUCAO (CLOUD):
$host = "db01_mysql_1"; //Servidor do mysql1


$user = "cineadm"; //Usuario do banco de dados DW
$senha = "senha"; //senha do banco de dados
$DefaultPassword = "Senha01"; //Senha default automaticamente setada quando se redefine a senha de um usuario do Sistema.
$Version = "2.0.24j"; //Versao exibida no index.do sistema
$SessionTimeOut = 200; // Tempo para expiração de uma sessão de usuario (1800=30Min. / 900=15Min. / 450=10Min. / 225=5Min. )
$PHPVersion = "7"; // Informa a versão do PHP instalado no Servidor, evitando erros de sintaxe MySQL.
$SQLServerParameterFetch = ""; //Definição inicial de variavel Parametro MySQL *NAO PRECISA ALTERAR*
$SQLServerParameterRows = ""; //Definição inicial de variavel Parametro MySQL *NAO PRECISA ALTERAR*

$DB_MyMovies="MyMovies"; 

#Define variaveis que precisam ser globais;
global $DB_MyMovies;
global $PHPVersion;


#Abre Conexao com o Servidor de Banco de Dados
if ($PHPVersion == "5"){
	$DB = mysql_connect($host, $user, $senha);
	
	#Define parametros utilizados pelo MySQL para PHP 5.
	$SQLServerParameterFetch = "mysql_fetch_array";
	$SQLServerParameterRows = "mysql_num_rows";
} elseif ($PHPVersion == "7"){
	$DB = mysqli_connect($host, $user, $senha, $DB_MyMovies);
	global $DB;
	
	#Define parametros utilizados pelo MySQL para PHP 7.
	$SQLServerParameterFetch = "mysqli_fetch_array";
	$SQLServerParameterRows = "mysqli_num_rows";
}

#Set Time Zone:
date_default_timezone_set('America/Sao_Paulo');


?>
