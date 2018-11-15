<?php
///////////////////////////////////////////////////////////////////////
//===================================================================//
//+-----------------------------------------------------------------+//
//|					PINN NEX Systems	    						|//
//|  Inteligencia de coleta de processamento e coleta de dados 	    |//
//| De gerenciamento de rede de computadores e sistemas	            |//
//+-----------------------------------------------------------------+// 	
//| DATA: 24/02/2016 - KLEBER DA SILVA SANTANA / EDNALDO ROSSI	    |//
//| VERSÃO: 1.0							    						|//
//| ULTIMA MODIFICAÇÃO: 24/02/2016				   					|//	
//+-----------------------------------------------------------------+//
//===================================================================//	
///////////////////////////////////////////////////////////////////////
session_start();
include_once ("etc/config.php");
include_once ("etc/query.php");
include_once 'head.html';

ValidaLogin();

global $Version;

echo "\n";
include_once 'menu.html';

echo '
<b><font size="10" color="red">Nex Systems</font></b>
<br><br>

<br><label><center>Bem vindo ao sistema CINE '.$Version.'</center></br></label>
<br></br>
<br><label>O Sistema CINE '.$Version.' é um simples cadastro de Filmes em diversos tipos de midia, concebido para que voce possa gerenciar</br></label>
<br><label>de forma simples e agil seus filmes, e possa ter acesso a essas informações quando decidir assisti-los</br></label>
<br><label>o Sistema CINE foi desenvolvido pela NEX SYSTEM uma consultoria de monitoração e gerencia de redes.</br></label>
<br><label>Para maiores informações da NEX SYSTEMS acesso nosso site em http://www.nexsystems.com.br.</br></label>
<br><label>Estamos felizes por poder atender você, queremos auxilia-lo em suas necessidades - Usando GIT.</br></label>
<br></br>
<br></br>
<br></br>
<br></br>
<br><label>Deus Seja Louvado!</br></label>
<br></br>
';

echo"
	\t</tbody>\n</table>\n";
echo"\n</div>\n</body>\n</html>";
?>
