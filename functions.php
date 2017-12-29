<?php
	/*
	* Autor: Peterson Passos
	* peterson.jfp@gmail.com
	* 51 9921298121
	* 
	* Modificado por: Girol | andregirol@gmail.com
	*/

function make_forms($nome_classe, $atributos, $num_atributos) {
		$height = $num_atributos * 80 + 300;//calculando o tamanho do textarea
		
		echo	'
				<h1>Formulario de cadastro (com classes bootstrap)</h1>
				<textarea style="width: 100%; background-color: #ccffff; min-height:'.$height.'px"> ';
				make_insert_form($nome_classe, $atributos, $num_atributos);
		echo	"</textarea>";
		
		echo	'
				<h1>Formulario de edição (com classes bootstrap)</h1>
				<textarea style="width: 100%; background-color: #ccffff; min-height:'.$height.'px"> ';
				make_edit_form($nome_classe, $atributos);
		echo	"</textarea>";
}

function make_insert_form($nome_classe,	$atributos, $num_atributos){ ?>
<h1 class='text-uppercase'>Cadastrar <?= $nome_classe ?></h1>
<form method='post' action="####################">
  <fieldset>
		<?php
		foreach	($atributos	as	$atributo):
				$nome_do_atributo = str_replace('_', ' ', ucfirst($atributo));
		?>
<!-- <?= $nome_do_atributo ?> -->
    <div class='form-group'>
      <label class='control-label' for='<?= $atributo	?>'><?=	$nome_do_atributo ?></label>
      <input id='<?=	$atributo	?>' name='<?= $atributo	?>' type='text' placeholder='<?= $nome_do_atributo ?>' class='form-control input-md' required>
    </div>
    <?php endforeach; ?>
    <br>
    <button type='submit' class='btn btn-lg btn-primary'>Cadastrar</button>
  </fieldset>
</form>
		<?php
}

//depois colocaremos opcao la na frente para usar com ajax ou não
function	make_insert_form_ajax($nome_classe,	$atributos)	{
		?>
		<!-- ############# formulario de cadastro #################### -->

		<h1 class='text-uppercase'>Cadastrar <?=	$nome_classe	?></h1>
		<form method='post' id='form_cadastrar_<?=	strtolower($nome_classe)	?>'>
				<fieldset>
						<?php
						foreach	($atributos	as	$atributo):
								$nome_do_atributo	=	str_replace('_',	' ',	ucfirst($atributo));
								?>
								<!-- <?=	$nome_do_atributo	?> -->
								<div class='form-group'>
										<label class='control-label' for='<?=	$atributo	?>'><?=	$nome_do_atributo	?></label>
										<input id='<?=	$atributo	?>' name='<?=	$atributo	?>' type='text' placeholder='<?=	$nome_do_atributo	?>' class='form-control input-md' required>
								</div>
						<?php	endforeach;	?>

						<br>
						<button type='submit' class='btn btn-lg btn-primary'>Publicar</button>

				</fieldset>
		</form>
		<br>
		<div class='container'>
				<div class='row'>
						<div id='resposta_form_cadastrar_<?=	strtolower($nome_classe)	?>'></div>
				</div>
		</div>
		<script>
				$(document).ready(function () {
						$('#form_<?=	strtolower($nome_classe)	?>').submit(function () {
								var page = "##################";
								var dados = jQuery(this).serialize();
								$.ajax({
										type: 'POST',
										dataType: 'html',
										url: page,
										beforeSend: function () {
												$("#carregando_animado").show('fast');
										},
										data: dados,
										success: function (msg) {
												$("#resposta_form_cadastrar_<?=	strtolower($nome_classe)	?>").append(msg);
												$("#carregando_animado").hide('fast');
										}
								});
								return false;
						});
				});
		</script>

		<!-- ######### fim formulario de cadastro #################### -->
		<?php
}

function	make_edit_form($nome_classe,	$atributos)	{
  echo	'<?php $pessoa = Pessoa_model::getObjPessoa($id); ?>' ;
		?>
		
		
<h1 class='text-uppercase'>Editar <?=	$nome_classe	?></h1>
<form method='post' action="################">
  <fieldset>
  <?php
    foreach	($atributos	as	$atributo):
      $nome_do_atributo	=	str_replace('_',	' ',	ucfirst($atributo));
  ?>
<!-- <?=	$nome_do_atributo	?> -->
    <div class='form-group'>
      <label class='control-label' for='<?=	$atributo	?>'><?=	$nome_do_atributo	?></label>
      <input id='<?=	$atributo	?>' name='<?=	$atributo	?>' type='text' value='<?=	'<?= $pessoa->getNome() ?>'	?>' class='form-control input-md' required>
    </div>
    <?php	endforeach;	?>
    <input type='hidden' name='id' value='<?=	'$pessoa->getId()'	?>'>
    <br>
    <button type='submit' class='btn btn-lg btn-primary'>Salvar edição</button>
  </fieldset>
</form>
		<?php
}

//depois colocaremos opcao la na frente para usar com ajax ou não
function	make_edit_form_ajax($nome_classe,	$atributos)	{
		?>
		<!-- ############# formulario de edição #################### -->
		<?=
		'<?php $pessoa	=	Pessoa_model::getObjPessoa($id); ?>'
		?>

		<h1 class='text-uppercase'>Editar <?=	$nome_classe	?></h1>
		<form method='post' id='form_editar_<?=	strtolower($nome_classe)	?>'>
				<fieldset>
						<?php
						foreach	($atributos	as	$atributo):
								$nome_do_atributo	=	str_replace('_',	' ',	ucfirst($atributo));
								?>
								<!-- <?=	$nome_do_atributo	?> -->
								<div class='form-group'>
										<label class='control-label' for='<?=	$atributo	?>'><?=	$nome_do_atributo	?></label>
										<input id='<?=	$atributo	?>' name='<?=	$atributo	?>' type='text' value='<?=	'<?= $pessoa->getNome() ?>'	?>' class='form-control input-md' required>
								</div>
						<?php	endforeach;	?>

						<input type='hidden' name='id' value='<?=	'$pessoa->getId()'	?>'>
						<br>
						<button type='submit' class='btn btn-lg btn-primary'>Salvar edição</button>

				</fieldset>
		</form>
		<br>
		<div class='container'>
				<div class='row'>
						<div id='resposta_form_editar_<?=	strtolower($nome_classe)	?>'></div>
				</div>
		</div>
		<script>
				$(document).ready(function () {
						$('form_editar_<?=	strtolower($nome_classe)	?>').submit(function () {
								var page = "##############################";
								var dados = jQuery(this).serialize();
								$.ajax({
										type: 'POST',
										dataType: 'html',
										url: page,
										beforeSend: function () {
												$("#carregando_animado").show('fast');
										},
										data: dados,
										success: function (msg) {
												$("#resposta_form_editar_<?=	strtolower($nome_classe)	?>").append(msg);
												$("#carregando_animado").hide('fast');
										}
								});
								return false;
						});
				});
		</script>
		<!-- ######### fim formulario de edição #################### -->
		<?php
}

function	make_methods($nome_classe,	$atributos,	$numVars)	{
		$height = $numVars * 16 + 150;//calculando o tamanho do textarea
		
		echo	'
				<h1>Metodo que recebe o formulário de cadastro</h1>
				<textarea style="width: 100%; background-color: #ccffff; min-height:'.$height.'px"> ';
				make_insert_method($nome_classe,	$atributos,	$numVars);
		echo	"</textarea>";
				
		echo	'
				<h1>Metodo que recebe o formulário de edição</h1>
				<textarea style="width: 100%; background-color: #ccffff; min-height:'.$height.'px"> ';
				make_edit_method($nome_classe,	$atributos,	$numVars);
		echo	"</textarea>";
}

function	make_insert_method($nome_classe,	$atributos,	$numVars)	{
		echo	'$getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);';
		echo	"\n";
		foreach	($atributos	as	$atributo)	{
				echo '$'	.	"$atributo = "	.	'$getpost'	.	"['$atributo'];";
				echo	"\n";
		}
		echo	"\n";
		echo	'$sucess = '	.	"$nome_classe"	.	"_model::"	.	"insert"	.	"$nome_classe(";
		$cont0	=	1;
		foreach	($atributos	as	$atributo)	{
				echo	'$'	.	"$atributo";
				if	($cont0	<	$numVars)	{
						echo	", ";
				}
				$cont0++;
		}
		echo	');';
}

function	make_insert_method_ajax($nome_classe,	$atributos,	$numVars)	{
		$s	=	'';
		$s	.=	"<!-- ######### metodo que recebe o form de cadastro ########## -->";
		$s	.=	"\n\n";
		$s	.=	'$getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);';
		$s	.=	"\n";
		foreach	($atributos	as	$atributo)	{
				$s	.=	'$'	.	"$atributo = "	.	'$getpost'	.	"['$atributo'];";
				$s	.=	"\n";
		}
		$s	.=	"\n";
		$s	.=	'$sucesso = '	.	"$nome_classe"	.	"_model::"	.	"create"	.	"$nome_classe(";
		$cont0	=	1;
		foreach	($atributos	as	$atributo)	{
				$s	.=	'$'	.	"$atributo";
				if	($cont0	<	$numVars)	{
						$s	.=	", ";
				}
				$cont0++;
		}
		$s	.=	');';
		$s	.=	"\n";
		$s	.=	'        if ($sucesso) {';
		$s	.=	"\n";
		$s	.=	'            $msg = "Mensagem de sucesso ###############";';
		$s	.=	"\n";
		$s	.=	'            echo "';
		$s	.=	"\n";
		$s	.=	"            <div class='row'>";
		$s	.=	"\n";
		$s	.=	"                <div class='alert alert-info alert-dismissible fade in text-center' role='alert'>";
		$s	.=	"\n";
		$s	.=	"                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
		$s	.=	"\n";
		$s	.=	"                        <span aria-hidden='true'>x</span>";
		$s	.=	"\n";
		$s	.=	"                    </button>";
		$s	.=	"\n";
		$s	.=	'                    <strong>$msg</strong>';
		$s	.=	"\n";
		$s	.=	"                </div>";
		$s	.=	"\n";
		$s	.=	'            </div>";';
		$s	.=	"\n";
		$s	.=	"        } else {";
		$s	.=	"\n";
		$s	.=	'            $msg = "Aconteceu um erro ao cadastrar no banco de dados, se persistir informe ao programador.";';
		$s	.=	"\n";
		$s	.=	'            echo "';
		$s	.=	"\n";
		$s	.=	"            <div class='row'>";
		$s	.=	"\n";
		$s	.=	"                <div class='alert alert-danger alert-dismissible fade in text-center' role='alert'>";
		$s	.=	"\n";
		$s	.=	"                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
		$s	.=	"\n";
		$s	.=	"                        <span aria-hidden='true'>x</span>";
		$s	.=	"\n";
		$s	.=	"                    </button>";
		$s	.=	"\n";
		$s	.=	'                    <strong>$msg</strong>';
		$s	.=	"\n";
		$s	.=	"                </div>";
		$s	.=	"\n";
		$s	.=	'            </div>";';
		$s	.=	"\n";
		$s	.=	'        }';
		$s	.=	"\n\n";
		$s	.=	"<!-- ##### fim metodo que recebe o form de cadastro ########## -->";
		$s	.=	"\n\n\n";
		return	$s;
}

function	make_edit_method($nome_classe,	$atributos,	$numVars)	{
		echo	'$getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);';
		echo	"\n";
		echo	'$'	.	"id = "	.	'$getpost'	.	"['id'];";
		echo	"\n";
		foreach	($atributos	as	$atributo)	{
				echo	'$'	.	"$atributo = "	.	'$getpost'	.	"['$atributo'];";
				echo	"\n";
		}
		echo	"\n";
		echo	'$sucess = '	.	"$nome_classe"	.	"_model::"	.	"update"	.	"$nome_classe(";
		echo	'$id,';
		$cont00	=	1;
		foreach	($atributos	as	$atributo)	{
				echo	'$'	.	"$atributo";
				if	($cont00	<	$numVars)	{
						echo	", ";
				}
				$cont00++;
		}
		echo	');';
}

function	make_edit_method_ajax($nome_classe,	$atributos,	$numVars)	{
		$s	=	'';
		$s	.=	"<!-- ######### metodo que recebe o form de edição     ########## -->";
		$s	.=	"\n\n";
		$s	.=	'$getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);';
		$s	.=	"\n";
		$s	.=	'$'	.	"id = "	.	'$getpost'	.	"['id'];";
		$s	.=	"\n";
		foreach	($atributos	as	$atributo)	{
				$s	.=	'$'	.	"$atributo = "	.	'$getpost'	.	"['$atributo'];";
				$s	.=	"\n";
		}
		$s	.=	"\n";
		$s	.=	'$sucesso = '	.	"$nome_classe"	.	"_model::"	.	"update"	.	"$nome_classe(";
		$s	.=	'$id,';
		$cont00	=	1;
		foreach	($atributos	as	$atributo)	{
				$s	.=	'$'	.	"$atributo";
				if	($cont00	<	$numVars)	{
						$s	.=	", ";
				}
				$cont00++;
		}
		$s	.=	');';
		$s	.=	"\n";
		$s	.=	'        if ($sucesso) {';
		$s	.=	"\n";
		$s	.=	'            $msg = "Mensagem de sucesso ###############";';
		$s	.=	"\n";
		$s	.=	'            echo "';
		$s	.=	"\n";
		$s	.=	"            <div class='row'>";
		$s	.=	"\n";
		$s	.=	"                <div class='alert alert-info alert-dismissible fade in text-center' role='alert'>";
		$s	.=	"\n";
		$s	.=	"                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
		$s	.=	"\n";
		$s	.=	"                        <span aria-hidden='true'>x</span>";
		$s	.=	"\n";
		$s	.=	"                    </button>";
		$s	.=	"\n";
		$s	.=	'                    <strong>$msg</strong>';
		$s	.=	"\n";
		$s	.=	"                </div>";
		$s	.=	"\n";
		$s	.=	'            </div>";';
		$s	.=	"\n";
		$s	.=	"        } else {";
		$s	.=	"\n";
		$s	.=	'            $msg = "Aconteceu um erro ao cadastrar no banco de dados, se persistir informe ao programador.";';
		$s	.=	"\n";
		$s	.=	'            echo "';
		$s	.=	"\n";
		$s	.=	"            <div class='row'>";
		$s	.=	"\n";
		$s	.=	"                <div class='alert alert-danger alert-dismissible fade in text-center' role='alert'>";
		$s	.=	"\n";
		$s	.=	"                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
		$s	.=	"\n";
		$s	.=	"                        <span aria-hidden='true'>x</span>";
		$s	.=	"\n";
		$s	.=	"                    </button>";
		$s	.=	"\n";
		$s	.=	'                    <strong>$msg</strong>';
		$s	.=	"\n";
		$s	.=	"                </div>";
		$s	.=	"\n";
		$s	.=	'            </div>";';
		$s	.=	"\n";
		$s	.=	'        }';
		$s	.=	"\n\n";
		$s	.=	"<!-- ##### fim metodo que recebe o form de edição     ########## -->";
		$s	.=	"\n\n\n";

		return	$s;
}

function	make_sql($nome_classe,	$atributos,	$numVars)	{
		$height = $numVars * 20 + 150;//calculando o tamanho do textarea
		
		echo	'
				<h1>SQL para criar a tabela (falta configurar os tipos)</h1>
				<textarea style="width: 100%; background-color: #ccffff; min-height:'.$height.'px"> ';
		
		
echo	'
CREATE TABLE `'.	strtolower($nome_classe)	.'`
(
`id` INT NOT NULL AUTO_INCREMENT,';
echo	"\n";
foreach	($atributos	as	$atributo)	{
		echo	"`$atributo` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,";
		echo	"\n";
}
echo '
PRIMARY KEY (`id`)
)
ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;
';
		
		echo	"</textarea>";
}

function	make_class($nome_classe,	$atributos,	$numVars)	{
		$height = $numVars * 350 + 1900;//calculando o tamanho do textarea
		
		echo	'
				<h1>Classe PHP (model)</h1>
				<textarea style="width: 100%; background-color: #ccffff; min-height:'.$height.'px"> ';
		
		echo	"defined('BASEPATH') OR exit('No direct script access allowed');";
		echo	"\n\n";
		echo	"class $nome_classe"	.	"_model extends CI_Model {";
		echo	"\n\n";
		echo	"    //atributos";
		echo	"\n";
		echo	'    //###########################################################################';
		echo	"\n";
		echo	'    private $id;'	.	"\n";
		foreach	($atributos	as	$atributo)	{
				echo	"    private "	.	'$'	.	"$atributo;\n";
		}
		echo	"\n";
		echo	"    //construtor";
		echo	"\n";
		echo	'    //###########################################################################';
		echo	"\n";
		echo	"    function __construct() {";
		echo	"\n";
		echo	"        parent::__construct();";
		echo	"\n";
		echo	"        // Helpers, libraries e models necessários";
		echo	"\n";
		echo	"    }";
		echo	"\n\n";
		echo	"    //metodos estaticos";
		echo	"\n";
		echo	'    //###########################################################################';
		echo	"\n\n";

		/* ##########            metodo cadastrar            ################### */

		echo	'    /**';
		echo	"\n";
		echo	'    * Cria um novo registro na tabela '	.	"$nome_classe";
		echo	"\n";
		echo	'    */';
		echo	"\n";
		echo	"    public static function insert"	.	"$nome_classe(";
		$cont	=	1;
		foreach	($atributos	as	$atributo)	{
				echo	'$'	.	"$atributo";
				if	($cont	<	$numVars)	{
						echo	", ";
				}
				$cont++;
		}
		echo	") {\n";
		echo	"        try {";
		echo	"\n";
		echo	'            $con = Conect_model::conectar();';
		echo	"\n";
		echo	"            //preparando a query";
		echo	"\n";
		echo	'            $stmt = $con->prepare("INSERT INTO '	.	""	.	strtolower($nome_classe)	.	"";
		echo	"\n";
		echo	"                (";
		echo	"\n                    ";
		$cont2	=	1;
		foreach	($atributos	as	$atributo)	{
				echo	"$atributo";
				if	($cont2	<	$numVars)	{
						echo	", ";
				}
				$cont2++;
		}
		echo	"\n";
		echo	"                )";
		echo	"\n";
		echo	"            VALUES(";
		$cont3	=	1;
		foreach	($atributos	as	$atributo)	{
				echo	"?";
				if	($cont3	<	$numVars)	{
						echo	", ";
				}
				$cont3++;
		}
		echo	')");';
		echo	"\n";
		echo	"";
		echo	"\n";
		echo	"            //configurando os valores";
		echo	"\n";
		$cont4	=	1;
		foreach	($atributos	as	$atributo)	{
				echo	'            $stmt->bindParam('	.	"$cont4"	.	","	.	' $'	.	"$atributo);\n";
				$cont4++;
		}
		echo	'            $stmt->execute();';
		echo	"\n";
		echo	'            if ($stmt->rowCount() > 0) {';
		echo	"\n";
		echo	"                return TRUE;";
		echo	"\n";
		echo	"            } else {";
		echo	"\n";
		echo	"                return FALSE;";
		echo	"\n";
		echo	"            }";
		echo	"\n";
		echo	'        } catch (Exception $exc) {';
		echo	"\n";
		echo	'            echo $exc->getTraceAsString();';
		echo	"\n";
		echo	"        }";
		echo	"\n";
		echo	"    }";
		echo	"\n\n";

		/* ##########            metodo getObject            ################### */

		echo	'    /**';
		echo	"\n";
		echo	'    * Busca o registro que representa o objeto '	.	$nome_classe	.	' cujo id é passado';
		echo	"\n";
		echo	'    * no banco de dados, monta o objeto e o retorna. Se não encontrar o registro retorna FALSE';
		echo	"\n";
		echo	'    */';
		echo	"\n";
		echo	'    public static function getObj'	.	"$nome_classe("	.	'$id) {';
		echo	"\n";
		echo	'        $con = Conect_model::conectar();';
		echo	"\n";
		echo	'        $rs = $con->query("SELECT * FROM '	.	"`"	.	strtolower($nome_classe)	.	"`"	.	' WHERE id = \'$id\'");';
		echo	"\n";
		echo	'        if($rs->rowCount() < 1){return FALSE;}';
		echo	"\n";
		echo	'        while ($row = $rs->fetch(PDO::FETCH_OBJ)) {';
		echo	"\n";
		echo	'            $objeto = new '	.	"$nome_classe"	.	'_model();';
		echo	"\n";
		echo	'            $objeto->id = $row->id;';
		echo	"\n";
		foreach	($atributos	as	$atributo)	{
				echo	'            $objeto->'	.	"$atributo"	.	' = $row->'	.	"$atributo;\n";
		}
		echo	'        }';
		echo	"\n";
		echo	'        return $objeto;';
		echo	"\n";
		echo	'    }';
		echo	"\n\n";

		/* ##########                metodo Editar             ################### */

		echo	'    /**';
		echo	"\n";
		echo	'    * Atualiza o registro de um objeto '	.	"$nome_classe"	.	' existente no banco de dados';
		echo	"\n";
		echo	'    */';
		echo	"\n";
		echo	'    public static function update'	.	"$nome_classe"	.	'($id, ';
		$cont6	=	1;
		foreach	($atributos	as	$atributo)	{
				echo	'$'	.	"$atributo";
				if	($cont6	<	$numVars)	{
						echo	", ";
				}
				$cont6++;
		}
		echo	"){";
		echo	"\n";
		echo	'        $con = Conect_model::conectar();';
		echo	"\n";
		echo	'        $select = $con->prepare("UPDATE '	.	"`"	.	strtolower($nome_classe)	.	"`"	.	' SET '	.	"\n        ";
		$cont7	=	1;
		foreach	($atributos	as	$atributo)	{
				echo	"`$atributo` = :$atributo";
				if	($cont7	<	$numVars)	{
						echo	", ";
				}
				$cont7++;
		}
		echo	"\n";
		echo	'        WHERE '	.	"`"	.	strtolower($nome_classe)	.	"`"	.	'.`id` = :id");'	.	"\n";
		foreach	($atributos	as	$atributo)	{
				echo	'        $select->bindParam('	.	"'"	.	":$atributo'"	.	', $'	.	"$atributo);\n";
		}
		echo	'        $select->bindParam'	.	'(\':id\', $id);';
		echo	"\n";
		echo	'        $select->execute();';
		echo	"\n";
		echo	'        if ($select->rowCount() > 0) {';
		echo	"\n";
		echo	'            return TRUE;';
		echo	"\n";
		echo	'        } else {';
		echo	"\n";
		echo	'            return FALSE;';
		echo	"\n";
		echo	'        }';
		echo	"\n";
		echo	'    }';
		echo	"\n\n";

		/* ##########                metodo apagar             ################### */

		echo	'    /**';
		echo	"\n";
		echo	'    * Deleta de forma definitiva o registro do objeto '	.	"$nome_classe"	.	' cujo id é passado';
		echo	"\n";
		echo	'    */';
		echo	"\n";
		echo	"    public static function delete"	.	"$nome_classe("	.	'$id'	.	"){";
		echo	"\n";
		echo	'        $con = Conect_model::conectar();';
		echo	"\n";
		echo	'        $select = $con->prepare("DELETE FROM '	.	"`"	.	strtolower($nome_classe)	.	"`"	.	" WHERE `"	.	strtolower($nome_classe)	.	"`"	.	'.`id` = :id");';
		echo	"\n";
		echo	'        $select->bindParam(\':id\', $id);';
		echo	"\n";
		echo	'        $select->execute();';
		echo	"\n";
		echo	'        if ($select->rowCount() > 0) {';
		echo	"\n";
		echo	'            return TRUE;';
		echo	"\n";
		echo	'        } else {';
		echo	"\n";
		echo	'            return FALSE;';
		echo	"\n";
		echo	'        }';
		echo	"\n";
		echo	'    }';
		echo	"\n\n";

		/* ##########                metodo getAll             ################### */

		echo	'    /**';
		echo	"\n";
		echo	'    * Retorna um array de objetos '	.	$nome_classe	.	' contendo todos os registros que estão no';
		echo	"\n";
		echo	'    * banco de dados na tabela '	.	$nome_classe;
		echo	"\n";
		echo	'    */';
		echo	"\n";
		echo	"    public static function getAll"	.	"$nome_classe"	.	"(){";
		echo	"\n";
		echo	'        $array[0] = "";';
		echo	"\n";
		echo	'        $contador = 0;';
		echo	"\n";
		echo	'        $con = Conect_model::conectar();';
		echo	"\n";
		echo	'        $rs = $con->query("SELECT * FROM `'	.	""	.	strtolower($nome_classe)	.	""	.	'`");';
		echo	"\n";
		echo	'        while ($row = $rs->fetch(PDO::FETCH_OBJ)) {';
		echo	"\n";
		echo	'            $objeto = new '	.	"$nome_classe"	.	'_model();';
		echo	"\n";
		echo	'            $objeto->id = $row->id;';
		echo	"\n";
		foreach	($atributos	as	$atributo)	{
				echo	'            $objeto->'	.	"$atributo"	.	' = $row->'	.	"$atributo;\n";
		}
		echo	'            $array[$contador] = $objeto;';
		echo	"\n";
		echo	'            $contador++;';
		echo	"\n";
		echo	'        }';
		echo	"\n";
		echo	'        return $array;';
		echo	"\n";
		echo	'    }';
		echo	"\n\n";

		/* ##########                metodo count             ################### */

		echo	'    /**';
		echo	"\n";
		echo	'    * Conta todos os registros da tabela '	.	"$nome_classe"	.	' e retorna um INT o resultado.';
		echo	"\n";
		echo	'    */';
		echo	"\n";
		echo	"    public static function count"	.	"$nome_classe"	.	"(){";
		echo	"\n";
		echo	'        $con = Conect_model::conectar();';
		echo	"\n";
		echo	'        $rs = $con->query("SELECT * FROM `'	.	""	.	strtolower($nome_classe)	.	""	.	'`");';
		echo	"\n";
		echo	'        return $rs->rowCount();';
		echo	"\n";
		echo	'    }';
		echo	"\n\n";

		/* ##########             metodo autoSave            ################### */

		echo	'    //metodos da classe';
		echo	"\n";
		echo	'    //###########################################################################';
		echo	"\n\n";
		echo	'    /**';
		echo	"\n";
		echo	'    * Atualiza o registro do objeto atual no banco de dados.';
		echo	"\n";
		echo	'    */';
		echo	"\n";
		echo	'    public function autoSave(){';
		echo	"\n";
		echo	'        $id = $this->id;';
		echo	"\n";
		foreach	($atributos	as	$atributo)	{
				echo	'        $'	.	"$atributo"	.	' = $this->'	.	"$atributo;\n";
		}
		echo	'        $con = Conect_model::conectar();';
		echo	"\n";
		echo	'        $select = $con->prepare("UPDATE '	.	"`"	.	strtolower($nome_classe)	.	"`"	.	' SET '	.	"\n        ";
		$cont12	=	1;
		foreach	($atributos	as	$atributo)	{
				echo	"`$atributo` = :$atributo";
				if	($cont12	<	$numVars)	{
						echo	", ";
				}
				$cont12++;
		}
		echo	"\n";
		echo	'        WHERE '	.	"`"	.	strtolower($nome_classe)	.	"`"	.	'.`id` = :id");'	.	"\n";
		foreach	($atributos	as	$atributo)	{
				echo	'        $select->bindParam('	.	"'"	.	":$atributo'"	.	', $'	.	"$atributo);\n";
		}
		echo	'        $select->bindParam'	.	'(\':id\', $id);';
		echo	"\n";
		echo	'        $select->execute();';
		echo	"\n";
		echo	'        if ($select->rowCount() > 0) {';
		echo	"\n";
		echo	'            return TRUE;';
		echo	"\n";
		echo	'        } else {';
		echo	"\n";
		echo	'            return FALSE;';
		echo	"\n";
		echo	'        }';
		echo	"\n";
		echo	'    }';
		echo	"\n\n";

		/* ##########                metodos especiais         ################# */

		echo	'    //getters';
		echo	"\n";
		echo	'    //###########################################################################';
		echo	"\n";
		echo	'    function getId(){';
		echo	"\n";
		echo	'        return $this->id;';
		echo	"\n";
		echo	'    }';
		echo	"\n\n";

		foreach	($atributos	as	$atributo)	{
				$dado2	=	ucfirst($atributo);
				echo	'    function get'	.	"$dado2() {";
				echo	"\n";
				echo	'        return $this->'	.	"$atributo;";
				echo	"\n";
				echo	'    }';
				echo	"\n\n";
		}
		echo	'    //setters';
		echo	"\n";
		echo	'    //###########################################################################';
		echo	"\n";
		foreach	($atributos	as	$atributo)	{
				$dado2	=	ucfirst($atributo);
				echo	'    function set'	.	"$dado2($"	.	$atributo	.	") {";
				echo	"\n";
				echo	'        $this->'	.	"$atributo = $"	.	"$atributo;";
				echo	"\n";
				echo	'    }';
				echo	"\n\n";
		}
		echo	'}';
		
		echo	"</textarea>";
		
}