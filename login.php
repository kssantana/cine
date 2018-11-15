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

if (isset($_SESSION["UserName"])){
	session_destroy();
}

#Includes de classes comuns entre todos os fontes.
include_once ("etc/config.php");
include_once ("etc/query.php");
include_once 'head.html';
echo "\n";
include_once 'menulock.html';

//$MovieID=$submitted_array[0];
#Busca os dados do Filme que se esta trabalhando na tabela Classificacao

echo '
<form class="form-horizontal" role="form" method="post" action="ValidUser.php" enctype="multipart/form-data">
';

echo '<div class="form-group">
		<label for="name" class="col-sm-2 control-label">Nome do Usuario</label>
		<div class="col-xs-10 .col-md-6">
			<input type="text" class="form-control" id="UserName" name="UserName" placeholder="Nome do Usuário" value="" required>
		</div>
	</div>
';
echo '	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">Senha de Acesso</label>
		<div class="col-xs-10 .col-md-6">
			<input type="password" class="form-control" id="password" name="password" placeholder="Senha de Acesso" value="" required>
		</div>
	</div>
';
echo '<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<input id="submit" type="submit" value="Acessar" name="Acessar">
				</div>
			</div>
		</form>
		</div>
		</div>
		</td>
		';
echo"
	\t</tbody>\n</table>\n";
echo"\n</div>\n</body>\n</html>";
?>
