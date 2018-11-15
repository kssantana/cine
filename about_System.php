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
echo "\n";
include_once 'menu.html';

global $Version;

ValidaLogin();

echo '
<b><font size="10" color="red">Bem Vindo ao Sistema CINE '.$Version.'</font></b>
<br><br>

<br><label><center>Este é o sisitema CINE, sistema para cadastro e controle de DVDs e filmes em diversos tipos de midia.</center></br></label>
<br><label>Utilize esse sistema para organizar e administrar seus filmes de forma simples e agil,</br></label>
<br></br>
<br><label>Utilize também esse sistema para identificar os generos e classificação de seus filmes, permitindo</br></label>
<br><label>Escolher qual filme irá assistir, contendo muitos recursos para isso, como por exemplo visualizar as capas</br></label>
<br><label>de seus filmes cadastrados, bem como sinopse, generos, classificação e tipo de midia em que esta.</br></label>
<br></br>
<br></br>
<br></br>
<br></br>
<br><label>Esperamos que goste!Caso tenha duvidas, criticas ou sujestões estamos disponiveis em nossa pagina www.nexsystems.com.br</br></label>
<br></br>
';

echo"
	\t</tbody>\n</table>\n";
echo"\n</div>\n</body>\n</html>";
?>
