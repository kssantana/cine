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

ValidaLogin();

if (isset($_POST['action_button'])){
	print ("Você irá alterar os dados dessa Categoria!<br><br></br></br>");
	$submitted_array = array_keys($_POST['action_button']);
} Elseif (isset($_POST['delete_button'])){
		print ("Você irá deletar os dados dessa Categoria!<br><br></br></br>");
		$submitted_array = array_keys($_POST['delete_button']);
}

//$MovieID=$submitted_array[0];
#Busca os dados do Filme que se esta trabalhando na tabela Classificacao
$QuerySource = "select * from Source WHERE IDSource='".$submitted_array[0]."';";
$Sources = Select_MyMovie($QuerySource);

while($Source_id = $SQLServerParameterFetch($Sources)) {
	$SourceName = $Source_id['Name'];
	$SourceNote = $Source_id['NOTE'];
};

echo '
<form class="form-horizontal" role="form" method="post" action="Update_Sources.php" enctype="multipart/form-data">
';

echo '<div class="form-group">
		<label for="name" class="col-sm-2 control-label">Nome da Classifição</label>
		<div class="col-xs-10 .col-md-6">
			<input type="text" class="form-control" id="name" name="name" placeholder="Nome da Classificação" value="'.$SourceName.'">
		</div>
	</div>
';
echo '	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">Sinopse do Filme</label>
		<div class="col-xs-10 .col-md-6">
			<textarea type="memo" class="form-control" id="note" name="note" rows="5" cols="40">'.$SourceNote.'</textarea>
		</div>
	</div>
';
if ($_SESSION["Nivel"] == "F"){
	if (isset($_POST['action_button'])){
			echo '<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<input id="submit" type="submit" value="Save" name="action_button['.$submitted_array[0].']">
					</div>
				</div>
			</form>
			</div>
			</div>
			</td>
			';
	} Elseif (isset($_POST['delete_button'])){
			echo '<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<input id="submit" type="submit" value="Delete" name="delete_button['.$submitted_array[0].']">
					</div>
				</div>
			</form>
			</div>
			</div>
			</td>
			';
	}
}
echo"
	\t</tbody>\n</table>\n";
echo"\n</div>\n</body>\n</html>";
?>
