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
	print ("Você irá alterar os dados desse Usuario!<br><br></br></br>");
	$submitted_array = array_keys($_POST['action_button']);
} Elseif (isset($_POST['delete_button'])){
		print ("Você irá deletar os dados desse Usuario!<br><br></br></br>");
		$submitted_array = array_keys($_POST['delete_button']);
} Elseif (isset($_POST['password_button'])){
		print ("Você irá redefinir a senha do Usuario!<br><br></br></br>");
		$submitted_array = array_keys($_POST['password_button']);
}

//$MovieID=$submitted_array[0];
#Busca os dados do Filme que se esta trabalhando na tabela Classificacao
$Query = "select * from Users WHERE ID='".$submitted_array[0]."';";
$User = Select_MyMovie($Query);

while($User_id = $SQLServerParameterFetch($User)) {
	$UserName = $User_id['Name'];
	$Useremail = $User_id['EMail'];
	$UserNivel = $User_id['Nivel'];
	$icones = $User_id['cfg_images'];
	$Disabled = $User_id['DisplayDisabled'];
};

echo '
<form class="form-horizontal" role="form" method="post" action="Update_Users.php" enctype="multipart/form-data">
';

echo '<div class="form-group">
		<label for="name" class="col-sm-2 control-label">User Name</label>
		<div class="col-xs-10 .col-md-6">
			<input type="text" class="form-control" id="name" name="name" placeholder="Nome da Classificação" value="'.$UserName.'">
		</div>
	</div>
';
echo '	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">E-Mail do Usuario</label>
		<div class="col-xs-10 .col-md-6">
			<input type="text" class="form-control" id="email" name="email" placeholder="E-Mail do Usuario" value="'.$Useremail.'">
		</div>
	</div>
';
echo '<div class="form-group">
		<label for="name" class="col-sm-2 control-label">ID da Origem</label>
		<div class="col-xs-10 .col-md-6">
			<select name="tipodeacesso" class="form-control" id="tipodeacesso" placeholder="Nivel de Acesso">';
			if ($UserNivel == "F"){ 
				echo '<option value="'.$UserNivel.'">Full Access</option>';
				echo '<option value="R">Read Access</option>';
				echo '<option value="D">Disabled</option>';
			} elseif ($UserNivel == "R") {
				echo '<option value="'.$UserNivel.'">Read Access</option>';
				echo '<option value="F">Full Access</option>';
				echo '<option value="D">Disabled</option>';
			}elseif ($UserNivel == "D") {
				echo '<option value="'.$UserNivel.'">Disabled</option>';
				echo '<option value="F">Full Access</option>';
				echo '<option value="R">Read Access</option>';
			}
echo '</select>
		</div>
	</div>';
echo '		<p><b><center>Parametros de configuração de usuarios:</center></b></p>
		<hr>
';
echo '<div class="form-group">
		<label for="name" class="col-sm-2 control-label">Exibe Icones?</label>
		<div class="col-xs-10 .col-md-6">
			<select name="image" class="form-control" id="image" placeholder="Exibe Icone?">';
			if ($icones == "Y"){ 
				echo '<option value="'.$icones.'">Yes</option>';
				echo '<option value="N">No</option>';
			} elseif ($icones == "N") {
				echo '<option value="'.$icones.'">No</option>';
				echo '<option value="Y">Yes</option>';
			}
echo '</select>
		</div>
	</div>';
echo '<div class="form-group">
		<label for="name" class="col-sm-2 control-label">Exibe Desabilitados?</label>
		<div class="col-xs-10 .col-md-6">
			<select name="disabled" class="form-control" id="disabled" placeholder="Exibe Desabilitados?">';
			if ($Disabled == "Y"){ 
				echo '<option value="'.$Disabled.'">Yes</option>';
				echo '<option value="N">No</option>';
			} elseif ($Disabled == "N") {
				echo '<option value="'.$Disabled.'">No</option>';
				echo '<option value="Y">Yes</option>';
			}
echo '</select>
		</div>
	</div>';
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
	}Elseif (isset($_POST['password_button'])){
			echo '<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<input id="submit" type="submit" value="Redifine Senha" name="password_button['.$submitted_array[0].']">
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
