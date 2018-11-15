<?php
///////////////////////////////////////////////////////////////////////
//===================================================================//
//+-----------------------------------------------------------------+//
//|					PINN NEX Systems	        					|//
//|  Inteligencia de coleta de processamento e coleta de dados 	    |//
//| De gerenciamento de rede de computadores e sistemas			    |//
//+-----------------------------------------------------------------+// 	
//| DATA: 25/02/2016 - KLEBER DA SILVA SANTANA / EDNALDO ROSSI		|//
//| VERSÃO: 1.0														|//
//| ULTIMA MODIFICAÇÃO: 25/02/2016									|//	
//+-----------------------------------------------------------------+//
//===================================================================//	
///////////////////////////////////////////////////////////////////////
include_once ("/mnt/workdir/engine/etc/config.php");
include_once ("/mnt/workdir/engine/etc/query.php");
include_once 'head.html';
echo "\n";
include_once 'menu.html';

ValidaLogin();

$hsc = Select_PINN("select ch.HOSTNAME, cs.NAME as script, cc.NAME
from pinn.CAD_HOSTS as ch
inner join pinn.HOSTS_X_SCRIPTS as hs on
hs.ID_HOST=ch.id_host
inner join	CAD_SCRIPTS AS cs on
hs.ID_SCRIPT=cs.ID_SCRIPT
inner join	CAD_CHECKS as cc on
hs.ID_CHECK=cc.ID_CHECK;");
echo "
<table class=\"table table-striped\">\n
	\t<thead>\n
		\t\t<tr>\n
			\t\t\t<th>HOSTNAME</th>
			<th>CHECKNAME</th>
			<th>SCRIPTNAME</th>\n
		\t\t</tr>\n
	\t</thead>\n
	\t<tbody>\n";
	while($hsc_name = $SQLServerParameterFetch($hsc)) {
		echo "<tr>\n\t<td>".$hsc_name['HOSTNAME']."</td>\n";
		echo "\t<td>".$hsc_name['script']."</td>\n";
		echo "\t<td>".$hsc_name['NAME']."</td>\n</tr>\n";
	};
	echo"
	\t</tbody>\n</table>\n";
echo"\n</div>\n</body>\n</html>";
?>
