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
	print ("Você irá alterar os dados do Filme Desejado!");
	$submitted_array = array_keys($_POST['action_button']);
} Elseif (isset($_POST['delete_button'])){
		print ("Você irá deletar os dados desse filme Desejado!");
		$submitted_array = array_keys($_POST['delete_button']);
}elseif (isset($_POST['cad_button'])){
		print ("Você irá Cadastrar esse filme Desejado!");
		$submitted_array = array_keys($_POST['cad_button']);
}
		
$MovieID=$submitted_array[0];

#Busca os dados do Filme que se esta trabalhando na tabela Movies
$QueryMovie = "select * from Des_Movies WHERE IDMovies='".$submitted_array[0]."';";
$Filme = Select_MyMovie($QueryMovie);

while($filme_id = $SQLServerParameterFetch($Filme)) {
	$MovieName = $filme_id['Name'];
	$MovieIDOrigem = $filme_id['ID_Source'];
	$Sinopse = $filme_id['Sinopse'];
	$IDCategory = $filme_id['ID_Category'];
	$ID_Classific = $filme_id['ID_Classific'];
	$ID_Midia = $filme_id['ID_Midia'];
	$Capa = $filme_id['Capa'];
	$Ano = $filme_id['Year'];
};

#Buscando os dados referentes ao tipo de origem do filme trabalhado:
$QuerySource = "select * from Source WHERE IDSource='".$MovieIDOrigem."';";
$Source = Select_MyMovie($QuerySource);
while($Source_Data = $SQLServerParameterFetch($Source)) {
	$SourceName = $Source_Data['Name'];
}

#Busca informações referentes a categoria cadastrada no Filme em trabalho corrente.
$QueryCategoria = "select * from Category WHERE IDCategory='".$IDCategory."';";
$Category = Select_MyMovie($QueryCategoria);
while($Category_Data = $SQLServerParameterFetch($Category)) {
	$CategoryName = $Category_Data['Name'];
}

#Busca informações referentes a classificaçao cadastrada no Filme em trabalho corrente.
$QueryCategoria = "select * from Classificacao WHERE IDClassific='".$ID_Classific."';";
$Classific = Select_MyMovie($QueryCategoria);
while($Classific_Data = $SQLServerParameterFetch($Classific)) {
	$ClassificName = $Classific_Data['Name'];
}

#Busca informações referentes a Midia cadastrada no Filme em trabalho corrente.
$QueryMidia = "select Name from Midia WHERE IDMidia='".$ID_Midia."';";
$Midia = Select_MyMovie($QueryMidia);
while($Midia_Data = $SQLServerParameterFetch($Midia)) {
	$MidiaName = $Midia_Data['Name'];
}

echo '
<form class="form-horizontal" role="form" method="post" action="Update_DESfilmes.php" enctype="multipart/form-data">
<table width="100%">
   <tr>
    <td width="290" valign="top" >
	<div class="form-group" id="sidebar" style="float:left;">
		<img width="280" height="350" src="data:image/jpeg;base64,'.base64_encode( $Capa ).'"/>
		<input name="MAX_FILE_SIZE" value="502400" type="hidden">
		<br>
		</br>';
# Verifica se a opção selecionada pelo usuario é a de deletar o registro, caso seja, as opções de alterar a Capa do registro não será exibida
# E caso a opção selecionada pelo usuario seja alterar as opções que permitem alterar a cada do registro serão apresentadas corretamente.
if (isset($_POST['action_button'])){
		echo '<input type="checkbox" name="AlteraCapa" id="AlteraCapa" value="Sim" align="center" ><label>Altera Capa?</label>
		<br>
		</br>
		<input type="file" accept="image/jpeg" class="form-control" id="capa" name="capa" placeholder="Capa do Filme" value="">';
}	

# Finalizada a verificação das opções selecionadas pelo usuario, continua-se contruindo a interface do usuario.	
echo '	</div>
	</td>
	<td align="right">
	<div class="form-group" id="content" style="float:Center;">
	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">Nome do Filme</label>
		<div class="col-xs-10 .col-md-6">
			<input type="text" class="form-control" id="name" name="name" value="'.$MovieName.'" required>
		</div>
	</div>
	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">ID da Origem</label>
		<div class="col-xs-10 .col-md-6">
			<select name="idorigem" class="form-control" id="idorigem" placeholder="Origem do Filme">';
			$IDSource = Select_MyMovie("Select IDSource,Name FROM Source;");
				
			echo '<option value="'.$MovieIDOrigem.'">'.$SourceName.'</option>';
			
			while($Movie_id = $SQLServerParameterFetch($IDSource)){
				echo '<option value="'.$Movie_id['IDSource'].'">'.$Movie_id['Name'].'</option>';
			}
echo '</select>
		</div>
	</div>';
echo '	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">ID da Categoria</label>
		<div class="col-xs-10 .col-md-6">
			<select name="idcategoria" class="form-control" id="idcategoria" placeholder="Categoria do Filme">
 ';
				$ID_Category = Select_MyMovie("Select IDCategory,Name FROM Category;");
				
				echo '<option value="'.$IDCategory.'">'.$CategoryName.'</option>';

				while($Category_id = $SQLServerParameterFetch($ID_Category)){
					 echo '<option value="'.$Category_id['IDCategory'].'">'.$Category_id['Name'].'</option>';
				}
echo '			</select>
		</div>
	</div>
';
echo '<div class="form-group">
		<label for="name" class="col-sm-2 control-label">ID Classificacao</label>
		<div class="col-xs-10 .col-md-6">
		<select name="idclassificacao" class="form-control" id="idclassificacao" placeholder="Classificação do Filme">
';
		$IDClass = Select_MyMovie("Select IDClassific,Name FROM Classificacao;");
				
		echo '<option value="'.$ID_Classific.'">'.$ClassificName.'</option>';

		while($Classific_id = $SQLServerParameterFetch($IDClass)){
				echo '<option value="'.$Classific_id['IDClassific'].'">'.$Classific_id['Name'].'</option>';
		}	
echo '		</select>
		</div>
	</div>';

echo '	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">ID da Midia</label>
		<div class="col-xs-10 .col-md-6">
		<select name="IDMidia" class="form-control" id="IDMidia" placeholder="Tipo de Midia do Filme">
';
		$Midias = Select_MyMovie("Select IDMidia,Name FROM Midia;");
				
		echo '<option value="'.$ID_Midia.'">'.$MidiaName.'</option>';

		
		while($Midia_id = $SQLServerParameterFetch($Midias)){
				echo '<option value="'.$Midia_id['IDMidia'].'">'.$Midia_id['Name'].'</option>';
		}
echo '		</select>
		</div>
	</div>';

echo '	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">Ano do Filme</label>
		<div class="col-xs-10 .col-md-6">
			<input type="number" class="form-control" id="ano" name="ano" maxlength="4" value="'.$Ano.'">
		</div>
	</div>';

echo '	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">Sinopse do Filme</label>
		<div class="col-xs-10 .col-md-6">
			<textarea type="memo" class="form-control" id="sinopse" name="sinopse" rows="5" cols="40">'.$Sinopse.'</textarea>
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
	} Elseif (isset($_POST['cad_button'])){
			echo '<div class="form-group">
					<label for="Valor Compra R$" class="col-sm-2 control-label">Valor Compra R$</label>
					<div class="col-xs-10 .col-md-6">
						<input type="number" class="form-control"  min="0.00" max="10000.00" step="0.01" id="valor" name="valor">
					</div>
					<div class="col-sm-10 col-sm-offset-2">	
						<br><input id="submit" type="submit" value="Cadstrar" name="cad_button['.$submitted_array[0].']"></br>
					</div>
					<div class="form-group">
					 <br></br>
					 <br><font color="red">Lembrando que esta rotina não cadastra a capa automaticamente!
					 Por Favor acesse o filme recem cadastrado e adicione a capa manualmente</font></br>
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
