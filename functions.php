<?php

/*
	* Autor: Peterson Passos
	* peterson.jfp@gmail.com
	* 51 9921298121
	*/

function	make_forms($nome_classe,	$atributos)	{
		$s	=	make_insert_form($nome_classe,	$atributos);
		$s	.=	make_edit_form($nome_classe,	$atributos);
		return	$s;
}

function make_insert_form($nome_classe,	$atributos){
		$s	=	' ';
		$s	.=	"<!-- ############# formulario de cadastro #################### -->";
		$s	.=	"\n\n";
		$s	.=	"<h1 class='text-uppercase'>Cadastrar "	.	strtolower($nome_classe)	.	"</h1>";
		$s	.=	"\n";
		$s	.=	"<form method='post' id='form_cadastrar_"	.	""	.	strtolower($nome_classe)	.	"'>";
		$s	.=	"\n";
		$s	.=	'<fieldset>';
		$s	.=	"\n";
		foreach	($atributos	as	$atributo)	{
				$nome_do_atributo	=	str_replace('_',	' ',	ucfirst($atributo));
				$s	.=	"                <!-- $nome_do_atributo -->
                <div class='form-group'>
                    <label class='control-label' for='$atributo'>$nome_do_atributo</label>
                    <input id='$atributo' name='$atributo' type='text' placeholder='$nome_do_atributo' class='form-control input-md' required>
                </div>";
				$s	.=	"\n\n";
		}
		$s	.=	"<br><button type='submit' class='btn btn-lg btn-primary'>Publicar</button>";
		$s	.=	"\n\n";
		$s	.=	"</fieldset>";
		$s	.=	"\n";
		$s	.=	"</form>";
		$s	.=	"\n";
		$s	.=	"<br>";
		$s	.=	"\n";
		$s	.=	"<div class='container'>";
		$s	.=	"\n";
		$s	.=	"    <div class='row'>";
		$s	.=	"\n";
		$s	.=	"        <div id='resposta'></div>";
		$s	.=	"\n";
		$s	.=	"    </div>";
		$s	.=	"\n";
		$s	.=	"</div>";
		$s	.=	"\n";
		$s	.=	"<script>";
		$s	.=	"\n";
		$s	.=	"    $(document).ready(function () {";
		$s	.=	"\n";
		$s	.=	"        $('#form_cadastrar_"	.	""	.	strtolower($nome_classe)	.	"').submit(function () {";
		$s	.=	"\n";
		$s	.=	"            var page = \"<?= base_url('##########################') ?>\";";
		$s	.=	"\n";
		$s	.=	"            var dados = jQuery(this).serialize();";
		$s	.=	"\n";
		$s	.=	"            $.ajax({";
		$s	.=	"\n";
		$s	.=	"                type: 'POST',";
		$s	.=	"\n";
		$s	.=	"                dataType: 'html',";
		$s	.=	"\n";
		$s	.=	"                url: page,";
		$s	.=	"\n";
		$s	.=	"                beforeSend: function () {";
		$s	.=	"\n";
		$s	.=	"                    $(\"#carregando_animado\").show('fast');";
		$s	.=	"\n";
		$s	.=	"                },";
		$s	.=	"\n";
		$s	.=	"                data: dados,";
		$s	.=	"\n";
		$s	.=	"                success: function (msg) {";
		$s	.=	"\n";
		$s	.=	"                    $(\"#resposta\").append(msg);";
		$s	.=	"\n";
		$s	.=	"                    $(\"#carregando_animado\").hide('fast');";
		$s	.=	"\n";
		$s	.=	"                }";
		$s	.=	"\n";
		$s	.=	"            });";
		$s	.=	"\n";
		$s	.=	"            return false;";
		$s	.=	"\n";
		$s	.=	"        });";
		$s	.=	"\n";
		$s	.=	"    });";
		$s	.=	"\n";
		$s	.=	"</script>";
		$s	.=	"\n\n";
		$s	.=	"<!-- ######### fim formulario de cadastro #################### -->";
		$s	.=	"\n\n\n";
		return	$s;
}

function	make_edit_form($nome_classe,	$atributos)	{
		$s	=	'';
		$s	.=	"<!-- ############# formulario de edição #################### -->";
		$s	.=	"\n\n";
		$s	.=	'<?php';
		$s	.=	"\n";
		$s	.=	'$'	.	""	.	strtolower($nome_classe)	.	" = "	.	"$nome_classe"	.	"_model::"	.	"getObj"	.	"$nome_classe($"	.	"id);";
		$s	.=	"\n";
		$s	.=	"?>";
		$s	.=	"\n\n";
		$s	.=	"<h1 class='text-uppercase'>Editar "	.	strtolower($nome_classe)	.	"</h1>";
		$s	.=	"\n";
		$s	.=	"<form method='post' id='form_editar_"	.	""	.	strtolower($nome_classe)	.	"'>";
		$s	.=	"\n";
		$s	.=	'<fieldset>';
		$s	.=	"\n";
		foreach	($atributos	as	$atributo)	{
				$nome_do_atributo	=	str_replace('_',	' ',	ucfirst($atributo));
				$s	.=	"                <!-- $nome_do_atributo -->
                <div class='form-group'>
                    <label class='control-label' for='$atributo'>$nome_do_atributo</label>
                    <input id='$atributo' name='$atributo' type='text' value='<?= $"	.	strtolower($nome_classe)	.	""	.	"->get".		ucfirst($atributo)."() ?>' class='form-control input-md' required>
                </div>";
				$s	.=	"\n\n";
		}
		$s	.=	"<input type='hidden' name='id' value='<?= $"	.	strtolower($nome_classe)	.	""	.	"->getId() ?>'>";
		$s	.=	"\n";
		$s	.=	"<br><button type='submit' class='btn btn-lg btn-primary'>Salvar edição</button>";
		$s	.=	"\n\n";
		$s	.=	"</fieldset>";
		$s	.=	"\n";
		$s	.=	"</form>";
		$s	.=	"\n";
		$s	.=	"<br>";
		$s	.=	"\n";
		$s	.=	"<div class='container'>";
		$s	.=	"\n";
		$s	.=	"    <div class='row'>";
		$s	.=	"\n";
		$s	.=	"        <div id='resposta'></div>";
		$s	.=	"\n";
		$s	.=	"    </div>";
		$s	.=	"\n";
		$s	.=	"</div>";
		$s	.=	"\n";
		$s	.=	"<script>";
		$s	.=	"\n";
		$s	.=	"    $(document).ready(function () {";
		$s	.=	"\n";
		$s	.=	"        $('form_editar_"	.	""	.	strtolower($nome_classe)	.	"').submit(function () {";
		$s	.=	"\n";
		$s	.=	"            var page = \"<?= base_url('##########################') ?>\";";
		$s	.=	"\n";
		$s	.=	"            var dados = jQuery(this).serialize();";
		$s	.=	"\n";
		$s	.=	"            $.ajax({";
		$s	.=	"\n";
		$s	.=	"                type: 'POST',";
		$s	.=	"\n";
		$s	.=	"                dataType: 'html',";
		$s	.=	"\n";
		$s	.=	"                url: page,";
		$s	.=	"\n";
		$s	.=	"                beforeSend: function () {";
		$s	.=	"\n";
		$s	.=	"                    $(\"#carregando_animado\").show('fast');";
		$s	.=	"\n";
		$s	.=	"                },";
		$s	.=	"\n";
		$s	.=	"                data: dados,";
		$s	.=	"\n";
		$s	.=	"                success: function (msg) {";
		$s	.=	"\n";
		$s	.=	"                    $(\"#resposta\").append(msg);";
		$s	.=	"\n";
		$s	.=	"                    $(\"#carregando_animado\").hide('fast');";
		$s	.=	"\n";
		$s	.=	"                }";
		$s	.=	"\n";
		$s	.=	"            });";
		$s	.=	"\n";
		$s	.=	"            return false;";
		$s	.=	"\n";
		$s	.=	"        });";
		$s	.=	"\n";
		$s	.=	"    });";
		$s	.=	"\n";
		$s	.=	"</script>";
		$s	.=	"\n\n";
		$s	.=	"<!-- ######### fim formulario de edição #################### -->";
		$s	.=	"\n\n\n";
		return	$s;
}

function	make_methods($nome_classe,	$atributos,	$numVars)	{
		$s	=	make_insert_method($nome_classe,	$atributos,	$numVars);
		$s	.=	make_edit_method($nome_classe,	$atributos,	$numVars);
		return	$s;
}

function	make_insert_method($nome_classe,	$atributos,	$numVars)	{
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

function	make_sql($nome_classe,	$atributos)	{
		$s	=	'';
		$s	.=	"<!-- ##### sql para criar a tabela ########## -->";
		$s	.=	"\n\n";
		$s	.=	"CREATE TABLE `"	.	strtolower($nome_classe)	.	"`";
		$s	.=	"\n";
		$s	.=	"(";
		$s	.=	"\n";
		$s	.=	"`id` INT NOT NULL AUTO_INCREMENT,";
		$s	.=	"\n";
		foreach	($atributos	as	$atributo)	{
				$s	.=	"`$atributo` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,";
				$s	.=	"\n";
		}
		$s	.=	"PRIMARY KEY (`id`)";
		$s	.=	"\n";
		$s	.=	")";
		$s	.=	"\n";
		$s	.=	"ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";
		$s	.=	"\n\n";
		$s	.=	"<!-- ##### fim sql para criar a tabela ########### -->";
		$s	.=	"\n\n\n";

		return	$s;
}

function	make_class($nome_classe,	$atributos, $numVars)	{
		$s	=	'';
		$s	.=	"<!-- ############## classe php ################### -->";
		$s	.=	"\n\n";
		$s	.=	"defined('BASEPATH') OR exit('No direct script access allowed');";
		$s	.=	"\n\n";
		$s	.=	"class $nome_classe"	.	"_model extends CI_Model {";
		$s	.=	"\n\n";
		$s	.=	"    //atributos";
		$s	.=	"\n";
		$s	.=	'    //###########################################################################';
		$s	.=	"\n";
		$s	.=	'    private $id;'	.	"\n";
		foreach	($atributos	as	$atributo)	{
				$s	.=	"    private "	.	'$'	.	"$atributo;\n";
		}
		$s	.=	"\n";
		$s	.=	"    //construtor";
		$s	.=	"\n";
		$s	.=	'    //###########################################################################';
		$s	.=	"\n";
		$s	.=	"    function __construct() {";
		$s	.=	"\n";
		$s	.=	"        parent::__construct();";
		$s	.=	"\n";
		$s	.=	"        // Helpers, libraries e models necessários";
		$s	.=	"\n";
		$s	.=	"    }";
		$s	.=	"\n\n";
		$s	.=	"    //metodos estaticos";
		$s	.=	"\n";
		$s	.=	'    //###########################################################################';
		$s	.=	"\n\n";

		/* ##########            metodo cadastrar            ################### */

		$s	.=	'    /**';
		$s	.=	"\n";
		$s	.=	'    * Cria um novo registro na tabela '	.	"$nome_classe";
		$s	.=	"\n";
		$s	.=	'    */';
		$s	.=	"\n";
		$s	.=	"    public static function insert"	.	"$nome_classe(";
		$cont	=	1;
		foreach	($atributos	as	$atributo)	{
				$s	.=	'$'	.	"$atributo";
				if	($cont	<	$numVars)	{
						$s	.=	", ";
				}
				$cont++;
		}
		$s	.=	") {\n";
		$s	.=	"        try {";
		$s	.=	"\n";
		$s	.=	'            $con = Conect_model::conectar();';
		$s	.=	"\n";
		$s	.=	"            //preparando a query";
		$s	.=	"\n";
		$s	.=	'            $stmt = $con->prepare("INSERT INTO '	.	""	.	strtolower($nome_classe)	.	"";
		$s	.=	"\n";
		$s	.=	"                (";
		$s	.=	"\n                    ";
		$cont2	=	1;
		foreach	($atributos	as	$atributo)	{
				$s	.=	"$atributo";
				if	($cont2	<	$numVars)	{
						$s	.=	", ";
				}
				$cont2++;
		}
		$s	.=	"\n";
		$s	.=	"                )";
		$s	.=	"\n";
		$s	.=	"            VALUES(";
		$cont3	=	1;
		foreach	($atributos	as	$atributo)	{
				$s	.=	"?";
				if	($cont3	<	$numVars)	{
						$s	.=	", ";
				}
				$cont3++;
		}
		$s	.=	')");';
		$s	.=	"\n";
		$s	.=	"";
		$s	.=	"\n";
		$s	.=	"            //configurando os valores";
		$s	.=	"\n";
		$cont4	=	1;
		foreach	($atributos	as	$atributo)	{
				$s	.=	'            $stmt->bindParam('	.	"$cont4"	.	","	.	' $'	.	"$atributo);\n";
				$cont4++;
		}
		$s	.=	'            $stmt->execute();';
		$s	.=	"\n";
		$s	.=	'            if ($stmt->rowCount() > 0) {';
		$s	.=	"\n";
		$s	.=	"                return TRUE;";
		$s	.=	"\n";
		$s	.=	"            } else {";
		$s	.=	"\n";
		$s	.=	"                return FALSE;";
		$s	.=	"\n";
		$s	.=	"            }";
		$s	.=	"\n";
		$s	.=	'        } catch (Exception $exc) {';
		$s	.=	"\n";
		$s	.=	'            echo $exc->getTraceAsString();';
		$s	.=	"\n";
		$s	.=	"        }";
		$s	.=	"\n";
		$s	.=	"    }";
		$s	.=	"\n\n";

		/* ##########            metodo getObject            ################### */

		$s	.=	'    /**';
		$s	.=	"\n";
		$s	.=	'    * Busca o registro que representa o objeto '	.	$nome_classe	.	' cujo id é passado';
		$s	.=	"\n";
		$s	.=	'    * no banco de dados, monta o objeto e o retorna.';
		$s	.=	"\n";
		$s	.=	'    */';
		$s	.=	"\n";
		$s	.=	'    public static function getObj'	.	"$nome_classe("	.	'$id) {';
		$s	.=	"\n";
		$s	.=	'        $con = Conect_model::conectar();';
		$s	.=	"\n";
		$s	.=	'        $rs = $con->query("SELECT * FROM '	.	"`"	.	strtolower($nome_classe)	.	"`"	.	' WHERE id = \'$id\'");';
		$s	.=	"\n";
		$s	.=	'        while ($row = $rs->fetch(PDO::FETCH_OBJ)) {';
		$s	.=	"\n";
		$s	.=	'            $objeto = new '	.	"$nome_classe"	.	'_model();';
		$s	.=	"\n";
		$s	.=	'            $objeto->id = $row->id;';
		$s	.=	"\n";
		foreach	($atributos	as	$atributo)	{
				$s	.=	'            $objeto->'	.	"$atributo"	.	' = $row->'	.	"$atributo;\n";
		}
		$s	.=	'        }';
		$s	.=	"\n";
		$s	.=	'        return $objeto;';
		$s	.=	"\n";
		$s	.=	'    }';
		$s	.=	"\n\n";

		/* ##########                metodo Editar             ################### */

		$s	.=	'    /**';
		$s	.=	"\n";
		$s	.=	'    * Atualiza o registro de um objeto '	.	"$nome_classe"	.	' existente no banco de dados';
		$s	.=	"\n";
		$s	.=	'    */';
		$s	.=	"\n";
		$s	.=	'    public static function update'	.	"$nome_classe"	.	'($id, ';
		$cont6	=	1;
		foreach	($atributos	as	$atributo)	{
				$s	.=	'$'	.	"$atributo";
				if	($cont6	<	$numVars)	{
						$s	.=	", ";
				}
				$cont6++;
		}
		$s	.=	"){";
		$s	.=	"\n";
		$s	.=	'        $con = Conect_model::conectar();';
		$s	.=	"\n";
		$s	.=	'        $select = $con->prepare("UPDATE '	.	"`"	.	strtolower($nome_classe)	.	"`"	.	' SET '	.	"\n        ";
		$cont7	=	1;
		foreach	($atributos	as	$atributo)	{
				$s	.=	"`$atributo` = :$atributo";
				if	($cont7	<	$numVars)	{
						$s	.=	", ";
				}
				$cont7++;
		}
		$s	.=	"\n";
		$s	.=	'        WHERE '	.	"`"	.	strtolower($nome_classe)	.	"`"	.	'.`id` = :id");'	.	"\n";
		foreach	($atributos	as	$atributo)	{
				$s	.=	'        $select->bindParam('	.	"'"	.	":$atributo'"	.	', $'	.	"$atributo);\n";
		}
		$s	.=	'        $select->bindParam'	.	'(\':id\', $id);';
		$s	.=	"\n";
		$s	.=	'        $select->execute();';
		$s	.=	"\n";
		$s	.=	'        if ($select->rowCount() > 0) {';
		$s	.=	"\n";
		$s	.=	'            return TRUE;';
		$s	.=	"\n";
		$s	.=	'        } else {';
		$s	.=	"\n";
		$s	.=	'            return FALSE;';
		$s	.=	"\n";
		$s	.=	'        }';
		$s	.=	"\n";
		$s	.=	'    }';
		$s	.=	"\n\n";

		/* ##########                metodo apagar             ################### */

		$s	.=	'    /**';
		$s	.=	"\n";
		$s	.=	'    * Deleta de forma definitiva o registro do objeto '	.	"$nome_classe"	.	' cujo id é passado';
		$s	.=	"\n";
		$s	.=	'    */';
		$s	.=	"\n";
		$s	.=	"    public static function delete"	.	"$nome_classe("	.	'$id'	.	"){";
		$s	.=	"\n";
		$s	.=	'        $con = Conect_model::conectar();';
		$s	.=	"\n";
		$s	.=	'        $select = $con->prepare("DELETE FROM '	.	"`"	.	strtolower($nome_classe)	.	"`"	.	" WHERE `"	.	strtolower($nome_classe)	.	"`"	.	'.`id` = :id");';
		$s	.=	"\n";
		$s	.=	'        $select->bindParam(\':id\', $id);';
		$s	.=	"\n";
		$s	.=	'        $select->execute();';
		$s	.=	"\n";
		$s	.=	'        if ($select->rowCount() > 0) {';
		$s	.=	"\n";
		$s	.=	'            return TRUE;';
		$s	.=	"\n";
		$s	.=	'        } else {';
		$s	.=	"\n";
		$s	.=	'            return FALSE;';
		$s	.=	"\n";
		$s	.=	'        }';
		$s	.=	"\n";
		$s	.=	'    }';
		$s	.=	"\n\n";

		/* ##########                metodo getAll             ################### */

		$s	.=	'    /**';
		$s	.=	"\n";
		$s	.=	'    * Retorna um array de objetos '	.	$nome_classe	.	' contendo todos os registros que estão no';
		$s	.=	"\n";
		$s	.=	'    * banco de dados na tabela '	.	$nome_classe;
		$s	.=	"\n";
		$s	.=	'    */';
		$s	.=	"\n";
		$s	.=	"    public static function getAll"	.	"$nome_classe"	.	"(){";
		$s	.=	"\n";
		$s	.=	'        $array[0] = "";';
		$s	.=	"\n";
		$s	.=	'        $contador = 0;';
		$s	.=	"\n";
		$s	.=	'        $con = Conect_model::conectar();';
		$s	.=	"\n";
		$s	.=	'        $rs = $con->query("SELECT * FROM `'	.	""	.	strtolower($nome_classe)	.	""	.	'`");';
		$s	.=	"\n";
		$s	.=	'        while ($row = $rs->fetch(PDO::FETCH_OBJ)) {';
		$s	.=	"\n";
		$s	.=	'            $objeto = new '	.	"$nome_classe"	.	'_model();';
		$s	.=	"\n";
		$s	.=	'            $objeto->id = $row->id;';
		$s	.=	"\n";
		foreach	($atributos	as	$atributo)	{
				$s	.=	'            $objeto->'	.	"$atributo"	.	' = $row->'	.	"$atributo;\n";
		}
		$s	.=	'            $array[$contador] = $objeto;';
		$s	.=	"\n";
		$s	.=	'            $contador++;';
		$s	.=	"\n";
		$s	.=	'        }';
		$s	.=	"\n";
		$s	.=	'        return $array;';
		$s	.=	"\n";
		$s	.=	'    }';
		$s	.=	"\n\n";

		/* ##########                metodo count             ################### */

		$s	.=	'    /**';
		$s	.=	"\n";
		$s	.=	'    * Conta todos os registros da tabela '	.	"$nome_classe"	.	' e retorna um INT o resultado.';
		$s	.=	"\n";
		$s	.=	'    */';
		$s	.=	"\n";
		$s	.=	"    public static function count"	.	"$nome_classe"	.	"(){";
		$s	.=	"\n";
		$s	.=	'        $con = Conect_model::conectar();';
		$s	.=	"\n";
		$s	.=	'        $rs = $con->query("SELECT * FROM `'	.	""	.	strtolower($nome_classe)	.	""	.	'`");';
		$s	.=	"\n";
		$s	.=	'        return $rs->rowCount();';
		$s	.=	"\n";
		$s	.=	'    }';
		$s	.=	"\n\n";

		/* ##########             metodo autoSave            ################### */

		$s	.=	'    //metodos da classe';
		$s	.=	"\n";
		$s	.=	'    //###########################################################################';
		$s	.=	"\n\n";
		$s	.=	'    /**';
		$s	.=	"\n";
		$s	.=	'    * Atualiza o registro do objeto atual no banco de dados.';
		$s	.=	"\n";
		$s	.=	'    */';
		$s	.=	"\n";
		$s	.=	'    public function autoSave(){';
		$s	.=	"\n";
		$s	.=	'        $id = $this->id;';
		$s	.=	"\n";
		foreach	($atributos	as	$atributo)	{
				$s	.=	'        $'	.	"$atributo"	.	' = $this->'	.	"$atributo;\n";
		}
		$s	.=	'        $con = Conect_model::conectar();';
		$s	.=	"\n";
		$s	.=	'        $select = $con->prepare("UPDATE '	.	"`"	.	strtolower($nome_classe)	.	"`"	.	' SET '	.	"\n        ";
		$cont12	=	1;
		foreach	($atributos	as	$atributo)	{
				$s	.=	"`$atributo` = :$atributo";
				if	($cont12	<	$numVars)	{
						$s	.=	", ";
				}
				$cont12++;
		}
		$s	.=	"\n";
		$s	.=	'        WHERE '	.	"`"	.	strtolower($nome_classe)	.	"`"	.	'.`id` = :id");'	.	"\n";
		foreach	($atributos	as	$atributo)	{
				$s	.=	'        $select->bindParam('	.	"'"	.	":$atributo'"	.	', $'	.	"$atributo);\n";
		}
		$s	.=	'        $select->bindParam'	.	'(\':id\', $id);';
		$s	.=	"\n";
		$s	.=	'        $select->execute();';
		$s	.=	"\n";
		$s	.=	'        if ($select->rowCount() > 0) {';
		$s	.=	"\n";
		$s	.=	'            return TRUE;';
		$s	.=	"\n";
		$s	.=	'        } else {';
		$s	.=	"\n";
		$s	.=	'            return FALSE;';
		$s	.=	"\n";
		$s	.=	'        }';
		$s	.=	"\n";
		$s	.=	'    }';
		$s	.=	"\n\n";

		/* ##########                metodos especiais         ################# */

		$s	.=	'    //getters';
		$s	.=	"\n";
		$s	.=	'    //###########################################################################';
		$s	.=	"\n";
		$s	.=	'    function getId(){';
		$s	.=	"\n";
		$s	.=	'        return $this->id;';
		$s	.=	"\n";
		$s	.=	'    }';
		$s	.=	"\n\n";

		foreach	($atributos	as	$atributo)	{
				$dado2	=	ucfirst($atributo);
				$s	.=	'    function get'	.	"$dado2() {";
				$s	.=	"\n";
				$s	.=	'        return $this->'	.	"$atributo;";
				$s	.=	"\n";
				$s	.=	'    }';
				$s	.=	"\n\n";
		}
		$s	.=	'    //setters';
		$s	.=	"\n";
		$s	.=	'    //###########################################################################';
		$s	.=	"\n";
		foreach	($atributos	as	$atributo)	{
				$dado2	=	ucfirst($atributo);
				$s	.=	'    function set'	.	"$dado2($"	.	$atributo	.	") {";
				$s	.=	"\n";
				$s	.=	'        $this->'	.	"$atributo = $"	.	"$atributo;";
				$s	.=	"\n";
				$s	.=	'    }';
				$s	.=	"\n\n";
		}
		$s	.=	'}';
		$s	.=	"\n\n";
		$s	.=	"<!-- ########## fim classe php ################### -->";

		return	$s;
}
