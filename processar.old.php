<?php

/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 * 
 * Modificado por: Girol | andregirol@gmail.com
 */

require('funcoes.php');

$getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//$dados2 = $getpost['atributos'];


// Busca os atributos preenchidos pelo usuário e transforma em array
$atributos = array_map('trim', explode(',', $getpost['atributos']));

// Melhor deixar tudo minúsculo, e colocar maiúsculo quando precisar
$nome_classe = strtolower($getpost['nome']);

// Mantendo retrocompatibilidade com código antigo
$classeM = $nome_classe; 
//$numVars = count($dados); -- substituído porlinha abaixo
$num_atributos = count($atributos);
// $s = "\n\n";

?>



<?php 
make_form($nome_classe, $atributos);
//exit('refactor do formulario');

## inicio botão do form
$s .= "<br><button type='submit' class='btn btn-lg btn-primary'>Publicar</button>";
$s .= "\n\n";
$s .= "</fieldset>";
$s .= "\n";
$s .= "</form>";
$s .= "\n";
$s .= "<br>";
$s .= "\n";
$s .= "<div class='container'>";
$s .= "\n";
$s .= "  <div class='row'>";
$s .= "\n";
$s .= "    <div id='resposta'></div>";
$s .= "\n";
$s .= "  </div>";
$s .= "\n";
$s .= "</div>";
$s .= "\n";
$s .= "<script>";
$s .= "\n";
$s .= "  $(document).ready(function () {";
$s .= "\n";
$s .= "    $('#form_cadastrar_"."$classeM').submit(function () {";
$s .= "\n";
$s .= "      var page = \"<?= base_url('##########################') ?>\";";
$s .= "\n";
$s .= "      var dados = jQuery(this).serialize();";
$s .= "\n";
$s .= "      $.ajax({";
$s .= "\n";
$s .= "        type: 'POST',";
$s .= "\n";
$s .= "        dataType: 'html',";
$s .= "\n";
$s .= "        url: page,";
$s .= "\n";
$s .= "        beforeSend: function () {";
$s .= "\n";
$s .= "          $(\"#carregando_animado\").show('fast');";
$s .= "\n";
$s .= "        },";
$s .= "\n";
$s .= "        data: dados,";
$s .= "\n";
$s .= "        success: function (msg) {";
$s .= "\n";
$s .= "          $(\"#resposta\").append(msg);";
$s .= "\n";
$s .= "          $(\"#carregando_animado\").hide('fast');";
$s .= "\n";
$s .= "        }";
$s .= "\n";
$s .= "      });";
$s .= "\n";
$s .= "      return false;";
$s .= "\n";
$s .= "    });";
$s .= "\n";
$s .= "  });";
$s .= "\n";
$s .= "</script>";
$s .= "\n\n";
$s .= "<!-- ######### fim formulario de cadastro #################### -->";
$s .= "\n\n\n";
$s .= "<!-- ############# formulario de edição #################### -->";
$s .= "\n\n";
$s .= '<?php';
$s .= "\n";
$s .= '$' . "$classeM = " . "$classe"."_model::" . "getObj" . "$classe($" . "id);";
$s .= "\n";
$s .= "?>";
$s .= "\n\n";
$s .= "<h1 class='text-uppercase'>Editar $classeM</h1>";
$s .= "\n";
$s .= "<form method='post' id='form_editar_"."$classeM'>";
$s .= "\n";
$s .= '<fieldset>';
$s .= "\n";
foreach ($dados as $dado) {
  $dado2 = ucfirst($dado);
  $dado3 = str_replace('_', ' ', $dado2);
  $s .= "<!-- $dado3 -->
        <div class='form-group'>
          <label class='control-label' for='$dado'>$dado3</label>
          <input id='$dado' name='$dado' type='text' value='<?= $$classeM" . "->get$dado2() ?>' class='form-control input-md' required>
        </div>";
  $s .= "\n\n";
}
$s .= "<input type='hidden' name='id' value='<?= $$classeM" . "->getId() ?>'>";
$s .= "\n";
$s .= "<br><button type='submit' class='btn btn-lg btn-primary'>Salvar edição</button>";
$s .= "\n\n";
$s .= "</fieldset>";
$s .= "\n";
$s .= "</form>";
$s .= "\n";
$s .= "<br>";
$s .= "\n";
$s .= "<div class='container'>";
$s .= "\n";
$s .= "  <div class='row'>";
$s .= "\n";
$s .= "    <div id='resposta'></div>";
$s .= "\n";
$s .= "  </div>";
$s .= "\n";
$s .= "</div>";
$s .= "\n";
$s .= "<script>";
$s .= "\n";
$s .= "  $(document).ready(function () {";
$s .= "\n";
$s .= "    $('form_editar_"."$classeM').submit(function () {";
$s .= "\n";
$s .= "      var page = \"<?= base_url('##########################') ?>\";";
$s .= "\n";
$s .= "      var dados = jQuery(this).serialize();";
$s .= "\n";
$s .= "      $.ajax({";
$s .= "\n";
$s .= "        type: 'POST',";
$s .= "\n";
$s .= "        dataType: 'html',";
$s .= "\n";
$s .= "        url: page,";
$s .= "\n";
$s .= "        beforeSend: function () {";
$s .= "\n";
$s .= "          $(\"#carregando_animado\").show('fast');";
$s .= "\n";
$s .= "        },";
$s .= "\n";
$s .= "        data: dados,";
$s .= "\n";
$s .= "        success: function (msg) {";
$s .= "\n";
$s .= "          $(\"#resposta\").append(msg);";
$s .= "\n";
$s .= "          $(\"#carregando_animado\").hide('fast');";
$s .= "\n";
$s .= "        }";
$s .= "\n";
$s .= "      });";
$s .= "\n";
$s .= "      return false;";
$s .= "\n";
$s .= "    });";
$s .= "\n";
$s .= "  });";
$s .= "\n";
$s .= "</script>";
$s .= "\n\n";
$s .= "<!-- ######### fim formulario de edição #################### -->";
$s .= "\n\n\n";



/* ########################################################### */
/* metodos do controller que receberao os post dos formularios */
/* ########################################################### */
$s .= "<!-- ######### metodo que recebe o form de cadastro ########## -->";
$s .= "\n\n";
$s .= '$getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);';
$s .= "\n";
foreach ($dados as $dado) {
  $s .= '$' . "$dado = " . '$getpost' . "['$dado'];";
  $s .= "\n";
}
$s .= "\n";
$s .= '$sucesso = '."$classe"."_model::" . "create" . "$classe(";
$cont0 = 1;
foreach ($dados as $dado) {
  $s .= '$' . "$dado";
  if ($cont0 < $num_atributos) {
    $s .= ", ";
  }
  $cont0++;
}
$s .= ');';
$s .= "\n";
$s .= '    if ($sucesso) {';
$s .= "\n";
$s .= '      $msg = "Mensagem de sucesso ###############";';
$s .= "\n";
$s .= '      echo "';
$s .= "\n";
$s .= "      <div class='row'>";
$s .= "\n";
$s .= "        <div class='alert alert-info alert-dismissible fade in text-center' role='alert'>";
$s .= "\n";
$s .= "          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
$s .= "\n";
$s .= "            <span aria-hidden='true'>x</span>";
$s .= "\n";
$s .= "          </button>";
$s .= "\n";
$s .= '          <strong>$msg</strong>';
$s .= "\n";
$s .= "        </div>";
$s .= "\n";
$s .= '      </div>";';
$s .= "\n";
$s .= "    } else {";
$s .= "\n";
$s .= '      $msg = "Aconteceu um erro ao cadastrar no banco de dados, se persistir informe ao programador.";';
$s .= "\n";
$s .= '      echo "';
$s .= "\n";
$s .= "      <div class='row'>";
$s .= "\n";
$s .= "        <div class='alert alert-danger alert-dismissible fade in text-center' role='alert'>";
$s .= "\n";
$s .= "          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
$s .= "\n";
$s .= "            <span aria-hidden='true'>x</span>";
$s .= "\n";
$s .= "          </button>";
$s .= "\n";
$s .= '          <strong>$msg</strong>';
$s .= "\n";
$s .= "        </div>";
$s .= "\n";
$s .= '      </div>";';
$s .= "\n";
$s .= '    }';
$s .= "\n\n";
$s .= "<!-- ##### fim metodo que recebe o form de cadastro ########## -->";
$s .= "\n\n\n";
$s .= "<!-- ######### metodo que recebe o form de edição   ########## -->";
$s .= "\n\n";
$s .= '$getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);';
$s .= "\n";
$s .= '$' . "id = " . '$getpost' . "['id'];";
$s .= "\n";
foreach ($dados as $dado) {
  $s .= '$' . "$dado = " . '$getpost' . "['$dado'];";
  $s .= "\n";
}
$s .= "\n";
$s .= '$sucesso = '."$classe"."_model::" . "update" . "$classe(";
$s .= '$id,';
$cont00 = 1;
foreach ($dados as $dado) {
  $s .= '$' . "$dado";
  if ($cont00 < $num_atributos) {
    $s .= ", ";
  }
  $cont00++;
}
$s .= ');';
$s .= "\n";
$s .= '    if ($sucesso) {';
$s .= "\n";
$s .= '      $msg = "Mensagem de sucesso ###############";';
$s .= "\n";
$s .= '      echo "';
$s .= "\n";
$s .= "      <div class='row'>";
$s .= "\n";
$s .= "        <div class='alert alert-info alert-dismissible fade in text-center' role='alert'>";
$s .= "\n";
$s .= "          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
$s .= "\n";
$s .= "            <span aria-hidden='true'>x</span>";
$s .= "\n";
$s .= "          </button>";
$s .= "\n";
$s .= '          <strong>$msg</strong>';
$s .= "\n";
$s .= "        </div>";
$s .= "\n";
$s .= '      </div>";';
$s .= "\n";
$s .= "    } else {";
$s .= "\n";
$s .= '      $msg = "Aconteceu um erro ao cadastrar no banco de dados, se persistir informe ao programador.";';
$s .= "\n";
$s .= '      echo "';
$s .= "\n";
$s .= "      <div class='row'>";
$s .= "\n";
$s .= "        <div class='alert alert-danger alert-dismissible fade in text-center' role='alert'>";
$s .= "\n";
$s .= "          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
$s .= "\n";
$s .= "            <span aria-hidden='true'>x</span>";
$s .= "\n";
$s .= "          </button>";
$s .= "\n";
$s .= '          <strong>$msg</strong>';
$s .= "\n";
$s .= "        </div>";
$s .= "\n";
$s .= '      </div>";';
$s .= "\n";
$s .= '    }';
$s .= "\n\n";
$s .= "<!-- ##### fim metodo que recebe o form de edição   ########## -->";
$s .= "\n\n\n";

/* ########################################################### */
/*    comando sql para criar a tabela da classse no banco    */
/* ########################################################### */
$s .= "<!-- ##### sql para criar a tabela ########## -->";
$s .= "\n\n";
$s .= "CREATE TABLE `$classeM`";
$s .= "\n";
$s .= "(";
$s .= "\n";
$s .= "`id` INT NOT NULL AUTO_INCREMENT,";
$s .= "\n";
foreach ($dados as $dado) {
  $s .= "`$dado` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,";
  $s .= "\n";
}
$s .= "PRIMARY KEY (`id`)";
$s .= "\n";
$s .= ")";
$s .= "\n";
$s .= "ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";
$s .= "\n\n";
$s .= "<!-- ##### fim sql para criar a tabela ########### -->";
$s .= "\n\n\n";

/* ########################################################### */
/*      classe php contendo os atributos do formulario       */
/* ########################################################### */
$s .= "<!-- ############## classe php ################### -->";
$s .= "\n\n";
$s .= "defined('BASEPATH') OR exit('No direct script access allowed');";
$s .= "\n\n";
$s .= "class $classe" . "_model extends CI_Model {";
$s .= "\n\n";
$s .= "  //atributos";
$s .= "\n";
$s .= '  //###########################################################################';
$s .= "\n";
$s .= '  private $id;' . "\n";
foreach ($dados as $dado) {
  $s .= "  private " . '$' . "$dado;\n";
}
$s .= "\n";
$s .= "  //construtor";
$s .= "\n";
$s .= '  //###########################################################################';
$s .= "\n";
$s .= "  function __construct() {";
$s .= "\n";
$s .= "    parent::__construct();";
$s .= "\n";
$s .= "    // Helpers, libraries e models necessários";
$s .= "\n";
$s .= '    $this->load->model(\'Autoload_model\');';
$s .= "\n";
$s .= "  }";
$s .= "\n\n";
$s .= "  //metodos estaticos";
$s .= "\n";
$s .= '  //###########################################################################';
$s .= "\n\n";

/* ##########      metodo cadastrar      ################### */

$s .= '  /**';
$s .= "\n";
$s .= '  * Cria um novo registro na tabela '."$classe";
$s .= "\n";
$s .= '  */';
$s .= "\n";
$s .= "  public static function insert" . "$classe(";
$cont = 1;
foreach ($dados as $dado) {
  $s .= '$' . "$dado";
  if ($cont < $num_atributos) {
    $s .= ", ";
  }
  $cont++;
}
$s .= ") {\n";
$s .= "    try {";
$s .= "\n";
$s .= '      $con = Conect_model::conectar();';
$s .= "\n";
$s .= "      //preparando a query";
$s .= "\n";
$s .= '      $stmt = $con->prepare("INSERT INTO ' . "$classeM";
$s .= "\n";
$s .= "        (";
$s .= "\n          ";
$cont2 = 1;
foreach ($dados as $dado) {
  $s .= "$dado";
  if ($cont2 < $num_atributos) {
    $s .= ", ";
  }
  $cont2++;
}
$s .= "\n";
$s .= "        )";
$s .= "\n";
$s .= "      VALUES(";
$cont3 = 1;
foreach ($dados as $dado) {
  $s .= "?";
  if ($cont3 < $num_atributos) {
    $s .= ", ";
  }
  $cont3++;
}
$s .= ')");';
$s .= "\n";
$s .= "";
$s .= "\n";
$s .= "      //configurando os valores";
$s .= "\n";
$cont4 = 1;
foreach ($dados as $dado) {
  $s .= '      $stmt->bindParam(' . "$cont4" . "," . ' $' . "$dado);\n";
  $cont4++;
}
$s .= '      $stmt->execute();';
$s .= "\n";
$s .= '      if ($stmt->rowCount() > 0) {';
$s .= "\n";
$s .= "        return TRUE;";
$s .= "\n";
$s .= "      } else {";
$s .= "\n";
$s .= "        return FALSE;";
$s .= "\n";
$s .= "      }";
$s .= "\n";
$s .= '    } catch (Exception $exc) {';
$s .= "\n";
$s .= '      echo $exc->getTraceAsString();';
$s .= "\n";
$s .= "    }";
$s .= "\n";
$s .= "  }";
$s .= "\n\n";

/* ##########      metodo getObject      ################### */

$s .= '  /**';
$s .= "\n";
$s .= '  * Busca o registro que representa o objeto '. $classe .' cujo id é passado';
$s .= "\n";
$s .= '  * no banco de dados, monta o objeto e o retorna.';
$s .= "\n";
$s .= '  */';
$s .= "\n";
$s .= '  public static function getObj' . "$classe(" . '$id) {';
$s .= "\n";
$s .= '    $con = Conect_model::conectar();';
$s .= "\n";
$s .= '    $rs = $con->query("SELECT * FROM ' . "`$classeM`" . ' WHERE id = \'$id\'");';
$s .= "\n";
$s .= '    while ($row = $rs->fetch(PDO::FETCH_OBJ)) {';
$s .= "\n";
$s .= '      $objeto = new ' . "$classe" . '_model();';
$s .= "\n";
$s .= '      $objeto->id = $row->id;';
$s .= "\n";
foreach ($dados as $dado) {
  $s .= '      $objeto->' . "$dado" . ' = $row->' . "$dado;\n";
}
$s .= '    }';
$s .= "\n";
$s .= '    return $objeto;';
$s .= "\n";
$s .= '  }';
$s .= "\n\n";

/* ##########        metodo Editar       ################### */

$s .= '  /**';
$s .= "\n";
$s .= '  * Atualiza o registro de um objeto '."$classe" . ' existente no banco de dados';
$s .= "\n";
$s .= '  */';
$s .= "\n";
$s .= '  public static function update' . "$classe" . '($id, ';
$cont6 = 1;
foreach ($dados as $dado) {
  $s .= '$' . "$dado";
  if ($cont6 < $num_atributos) {
    $s .= ", ";
  }
  $cont6++;
}
$s .= "){";
$s .= "\n";
$s .= '    $con = Conect_model::conectar();';
$s .= "\n";
$s .= '    $select = $con->prepare("UPDATE ' . "`$classeM`" . ' SET ' . "\n    ";
$cont7 = 1;
foreach ($dados as $dado) {
  $s .= "`$dado` = :$dado";
  if ($cont7 < $num_atributos) {
    $s .= ", ";
  }
  $cont7++;
}
$s .= "\n";
$s .= '    WHERE ' . "`$classeM`" . '.`id` = :id");' . "\n";
foreach ($dados as $dado) {
  $s .= '    $select->bindParam(' . "'" . ":$dado'" . ', $' . "$dado);\n";
}
$s .= '    $select->bindParam' . '(\':id\', $id);';
$s .= "\n";
$s .= '    $select->execute();';
$s .= "\n";
$s .= '    if ($select->rowCount() > 0) {';
$s .= "\n";
$s .= '      return TRUE;';
$s .= "\n";
$s .= '    } else {';
$s .= "\n";
$s .= '      return FALSE;';
$s .= "\n";
$s .= '    }';
$s .= "\n";
$s .= '  }';
$s .= "\n\n";

/* ##########        metodo apagar       ################### */

$s .= '  /**';
$s .= "\n";
$s .= '  * Deleta de forma definitiva o registro do objeto '."$classe" . ' cujo id é passado';
$s .= "\n";
$s .= '  */';
$s .= "\n";
$s .= "  public static function delete" . "$classe(" . '$id' . "){";
$s .= "\n";
$s .= '    $con = Conect_model::conectar();';
$s .= "\n";
$s .= '    $select = $con->prepare("DELETE FROM ' . "`$classeM`" . " WHERE `$classeM`" . '.`id` = :id");';
$s .= "\n";
$s .= '    $select->bindParam(\':id\', $id);';
$s .= "\n";
$s .= '    $select->execute();';
$s .= "\n";
$s .= '    if ($select->rowCount() > 0) {';
$s .= "\n";
$s .= '      return TRUE;';
$s .= "\n";
$s .= '    } else {';
$s .= "\n";
$s .= '      return FALSE;';
$s .= "\n";
$s .= '    }';
$s .= "\n";
$s .= '  }';
$s .= "\n\n";

/* ##########        metodo getAll       ################### */

$s .= '  /**';
$s .= "\n";
$s .= '  * Retorna um array de objetos '. $classe .' contendo todos os registros que estão no';
$s .= "\n";
$s .= '  * banco de dados na tabela '. $classe;
$s .= "\n";
$s .= '  */';
$s .= "\n";
$s .= "  public static function getAll" . "$classe"."(){";
$s .= "\n";
$s .= '    $array[0] = "";';
$s .= "\n";
$s .= '    $contador = 0;';
$s .= "\n";
$s .= '    $con = Conect_model::conectar();';
$s .= "\n";
$s .= '    $rs = $con->query("SELECT * FROM `'."$classeM".'`");';
$s .= "\n";
$s .= '    while ($row = $rs->fetch(PDO::FETCH_OBJ)) {';
$s .= "\n";
$s .= '      $objeto = new ' . "$classe" . '_model();';
$s .= "\n";
$s .= '      $objeto->id = $row->id;';
$s .= "\n";
foreach ($dados as $dado) {
  $s .= '      $objeto->' . "$dado" . ' = $row->' . "$dado;\n";
}
$s .= '      $array[$contador] = $objeto;';
$s .= "\n";
$s .= '      $contador++;';
$s .= "\n";
$s .= '    }';
$s .= "\n";
$s .= '    return $array;';
$s .= "\n";
$s .= '  }';      
$s .= "\n\n";

/* ##########        metodo count       ################### */

$s .= '  /**';
$s .= "\n";
$s .= '  * Conta todos os registros da tabela '."$classe".' e retorna um INT o resultado.';
$s .= "\n";
$s .= '  */';
$s .= "\n";
$s .= "  public static function count" . "$classe"."(){";
$s .= "\n";
$s .= '    $con = Conect_model::conectar();';
$s .= "\n";
$s .= '    $rs = $con->query("SELECT * FROM `'."$classeM".'`");';
$s .= "\n";
$s .= '    return $rs->rowCount();';
$s .= "\n";
$s .= '  }';      
$s .= "\n\n";

/* ##########       metodo autoSave      ################### */

$s .= '  //metodos da classe';
$s .= "\n";
$s .= '  //###########################################################################';
$s .= "\n\n";
$s .= '  /**';
$s .= "\n";
$s .= '  * Atualiza o registro do objeto atual no banco de dados.';
$s .= "\n";
$s .= '  */';
$s .= "\n";
$s .= '  public function autoSave(){';
$s .= "\n";
$s .= '    $id = $this->id;';
$s .= "\n";
foreach ($dados as $dado) {
  $s .= '    $' . "$dado" . ' = $this->' . "$dado;\n";
}
$s .= '    $con = Conect_model::conectar();';
$s .= "\n";
$s .= '    $select = $con->prepare("UPDATE ' . "`$classeM`" . ' SET ' . "\n    ";
$cont12 = 1;
foreach ($dados as $dado) {
  $s .= "`$dado` = :$dado";
  if ($cont12 < $num_atributos) {
    $s .= ", ";
  }
  $cont12++;
}
$s .= "\n";
$s .= '    WHERE ' . "`$classeM`" . '.`id` = :id");' . "\n";
foreach ($dados as $dado) {
  $s .= '    $select->bindParam(' . "'" . ":$dado'" . ', $' . "$dado);\n";
}
$s .= '    $select->bindParam' . '(\':id\', $id);';
$s .= "\n";
$s .= '    $select->execute();';
$s .= "\n";
$s .= '    if ($select->rowCount() > 0) {';
$s .= "\n";
$s .= '      return TRUE;';
$s .= "\n";
$s .= '    } else {';
$s .= "\n";
$s .= '      return FALSE;';
$s .= "\n";
$s .= '    }';
$s .= "\n";
$s .= '  }';
$s .= "\n\n";

/* ##########        metodos especiais     ################# */

$s .= '  //getters';
$s .= "\n";
$s .= '  //###########################################################################';
$s .= "\n";
$s .= '  function getId(){';
$s .= "\n";
$s .= '    return $this->id;';
$s .= "\n";
$s .= '  }';
$s .= "\n\n";

foreach ($dados as $dado) {
  $dado2 = ucfirst($dado);
  $s .= '  function get' . "$dado2() {";
  $s .= "\n";
  $s .= '    return $this->' . "$dado;";
  $s .= "\n";
  $s .= '  }';
  $s .= "\n\n";
}
$s .= '  //setters';
$s .= "\n";
$s .= '  //###########################################################################';
$s .= "\n";
foreach ($dados as $dado) {
  $dado2 = ucfirst($dado);
  $s .= '  function set' . "$dado2($". $dado .") {";
  $s .= "\n";
  $s .= '    $this->' . "$dado = $" . "$dado;";
  $s .= "\n";
  $s .= '  }';
  $s .= "\n\n";
}
$s .= '}';
$s .= "\n\n";
$s .= "<!-- ########## fim classe php ################### -->";
echo "<div >";
var_dump($s);
echo "</div>";
echo "<h1>Por favor visualize o codigo fonte da pagina</h1>";
