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
include_once ("etc/config.php");
include_once ("etc/query.php");
include_once 'head.html';
echo "\n";
include_once 'menu.html';

ValidaLogin();

$script = Select_MyMovie("SELECT * FROM MyMovies.Category;");

echo "
<table class=\"table table-striped\">\n
	\t<thead>\n
		\t\t<tr>\n
			\t\t\t<th>ID</th>
			<th>Nome da Categoria</th>
			<th>Observações Diversas</th>\n
		\t\t</tr>\n
	\t</thead>\n
	\t<tbody>\n";
	while($script_id = $SQLServerParameterFetch($script)) {
		echo "<tr>\n\t<td>".$script_id['IDCategory']."</td>\n";
		echo "\t<td>".$script_id['Name']."</td>\n";
		echo "\t<td>".$script_id['Note']."</td>\n</tr>\n";
	};
	echo"
	\t</tbody>\n</table>\n";
echo"\n</div>\n</body>\n</html>";?>
