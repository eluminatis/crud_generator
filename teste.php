<div style='display:none'>string(14572) "

    <!-- ############# formulario de cadastro #################### -->

    <h1 class='text-uppercase'>Cadastrar pessoa</h1>
    <form method='post' id='form_cadastrar_pessoa'>
        <fieldset>
            <!-- Nome -->
            <div class='form-group'>
                <label class='control-label' for='nome'>Nome</label>
                <input id='nome' name='nome' type='text' placeholder='Nome' class='form-control input-md' required>
            </div>

            <!-- Telefone -->
            <div class='form-group'>
                <label class='control-label' for='telefone'>Telefone</label>
                <input id='telefone' name='telefone' type='text' placeholder='Telefone' class='form-control input-md' required>
            </div>

            <!-- Email -->
            <div class='form-group'>
                <label class='control-label' for='email'>Email</label>
                <input id='email' name='email' type='text' placeholder='Email' class='form-control input-md' required>
            </div>

            <!-- Senha -->
            <div class='form-group'>
                <label class='control-label' for='senha'>Senha</label>
                <input id='senha' name='senha' type='text' placeholder='Senha' class='form-control input-md' required>
            </div>

            <br><button type='submit' class='btn btn-lg btn-primary'>Publicar</button>

        </fieldset>
    </form>
    <br>
    <div class='container'>
        <div class='row'>
            <div id='resposta'></div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#form_cadastrar_pessoa').submit(function () {
                var page = "<?= base_url('##########################') ?>";
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
                        $("#resposta").append(msg);
                        $("#carregando_animado").hide('fast');
                    }
                });
                return false;
            });
        });
    </script>

    <!-- ######### fim formulario de cadastro #################### -->


    <!-- ############# formulario de edição #################### -->

    <?php
    $pessoa = Pessoa_model::getObjPessoa($id);
    ?>

    <h1 class='text-uppercase'>Editar pessoa</h1>
    <form method='post' id='form_editar_pessoa'>
        <fieldset>
            <!-- Nome -->
            <div class='form-group'>
                <label class='control-label' for='nome'>Nome</label>
                <input id='nome' name='nome' type='text' value='<?= $pessoa->getNome() ?>' class='form-control input-md' required>
            </div>

            <!-- Telefone -->
            <div class='form-group'>
                <label class='control-label' for='telefone'>Telefone</label>
                <input id='telefone' name='telefone' type='text' value='<?= $pessoa->getTelefone() ?>' class='form-control input-md' required>
            </div>

            <!-- Email -->
            <div class='form-group'>
                <label class='control-label' for='email'>Email</label>
                <input id='email' name='email' type='text' value='<?= $pessoa->getEmail() ?>' class='form-control input-md' required>
            </div>

            <!-- Senha -->
            <div class='form-group'>
                <label class='control-label' for='senha'>Senha</label>
                <input id='senha' name='senha' type='text' value='<?= $pessoa->getSenha() ?>' class='form-control input-md' required>
            </div>

            <input type='hidden' name='id' value='<?= $pessoa->getId() ?>'>
            <br><button type='submit' class='btn btn-lg btn-primary'>Salvar edição</button>

        </fieldset>
    </form>
    <br>
    <div class='container'>
        <div class='row'>
            <div id='resposta'></div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('form_editar_pessoa').submit(function () {
                var page = "<?= base_url('##########################') ?>";
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
                        $("#resposta").append(msg);
                        $("#carregando_animado").hide('fast');
                    }
                });
                return false;
            });
        });
    </script>

    <!-- ######### fim formulario de edição #################### -->
    <?php
    /*
     * Autor: Peterson Passos
     * peterson.jfp@gmail.com
     * 51 9921298121
     */

    /* codigo que impossibilita o acesso direto sem passar pela home */
    defined('BASEPATH') OR exit('No direct script access allowed');
    /* todo controller DEVE extender CI_Controller */

    class Usuario_model extends CI_Model {

        //atributos
        private $id;
        private $nome;
        private $login;
        private $telefone;
        private $email;
        private $nivel_de_acesso;
        private $data_de_cadastro;
        private $data_de_ultimo_acesso;
        private $status;

        function __construct() {
            /* contrutor da classe pai */
            parent::__construct();
            /* abaixo deverão ser carregados helpers, libraries e models utilizados
              por este model */
        }

        //metodos estaticos
        public static function cadastrarUsuario($nome, $login, $senha, $telefone, $email, $nivel_de_acesso, $data_de_cadastro, $data_de_ultimo_acesso, $status) {
            try {
                $con = Conect_model::conectar();
                //preparando a query
                $stmt = $con->prepare("INSERT INTO usuario
										(
												nome, login, senha, telefone, email, nivel_de_acesso, data_de_cadastro, data_de_ultimo_acesso, status
										)
								VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");

                //configurando os valores
                $stmt->bindParam(1, $nome);
                $stmt->bindParam(2, $login);
                $stmt->bindParam(3, $senha);
                $stmt->bindParam(4, $telefone);
                $stmt->bindParam(5, $email);
                $stmt->bindParam(6, $nivel_de_acesso);
                $stmt->bindParam(7, $data_de_cadastro);
                $stmt->bindParam(8, $data_de_ultimo_acesso);
                $stmt->bindParam(9, $status);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        }

        public static function getObjUsuario($id) {
            $usuario = new Usuario_model();
            $con = Conect_model::conectar();
            $rs = $con->query("SELECT * FROM `usuario` WHERE id = '$id'");
            while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
                $usuario->id = $row->id;
                $usuario->nome = $row->nome;
                $usuario->login = $row->login;
                $usuario->telefone = $row->telefone;
                $usuario->email = $row->email;
                $usuario->nivel_de_acesso = $row->nivel_de_acesso;
                $usuario->data_de_cadastro = $row->data_de_cadastro;
                $usuario->data_de_ultimo_acesso = $row->data_de_ultimo_acesso;
                $usuario->status = $row->status;
            }
            return $usuario;
        }

        public static function editarUsuario($id, $nome, $login, $senha, $telefone, $email, $nivel_de_acesso, $data_de_cadastro, $data_de_ultimo_acesso, $status) {
            $con = Conect_model::conectar();
            $select = $con->prepare("UPDATE `usuario` SET 
						`nome` = :nome, `login` = :login, `senha` = :senha, `telefone` = :telefone, `email` = :email, `nivel_de_acesso` = :nivel_de_acesso, `data_de_cadastro` = :data_de_cadastro, `data_de_ultimo_acesso` = :data_de_ultimo_acesso, `status` = :status
						WHERE `usuario`.`id` = :id");
            $select->bindParam(':nome', $nome);
            $select->bindParam(':login', $login);
            $select->bindParam(':senha', $senha);
            $select->bindParam(':telefone', $telefone);
            $select->bindParam(':email', $email);
            $select->bindParam(':nivel_de_acesso', $nivel_de_acesso);
            $select->bindParam(':data_de_cadastro', $data_de_cadastro);
            $select->bindParam(':data_de_ultimo_acesso', $data_de_ultimo_acesso);
            $select->bindParam(':status', $status);
            $select->bindParam(':id', $id);
            $select->execute();
            if ($select->rowCount() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        public static function deleteUsuario($id) {
            $con = Conect_model::conectar();
            $select = $con->prepare("DELETE FROM `usuario` WHERE `usuario`.`id` = :id");
            $select->bindParam(':id', $id);
            $select->execute();
            if ($select->rowCount() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        public static function getAllUsuarios() {
            $array[0] = "";
            $contador = 0;
            $con = Conect_model::conectar();
            $rs = $con->query("SELECT * FROM `usuario`");
            while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
                $id = $row->id;
                $obj = self::getObjUsuario($id);
                $array[$contador] = $obj;
                $contador++;
            }
            return $array;
        }

        public static function autenticaLogin($login, $senha) {
            $loginOK = FALSE;
            //tirando caracteres especias do login
            $login2 = preg_replace('/[^[:alnum:]_.-@]/', '', $login);
            //criando a conexão
            $con = Conect_model::conectar();
            /* conte quantas linhas retornaram da pesquisa */
            $select = $con->prepare("SELECT * FROM `usuario` WHERE login = :login");
            $select->bindParam(':login', $login2);
            $select->execute();
            $n = count($select->fetchAll(PDO::FETCH_ASSOC));
            if ($n > 0) {
                $loginOK = TRUE;
            } else {
                return FALSE;
            }
            //se chegou ate aqui o login existe, vamos verificar a senha
            $id = Usuario_model::retornarIdInserindoLogin($login2);
            $hash = Usuario_model::retornarHashDaSenha($id);
            $senhaOK = password_verify($senha, $hash);
            //senha verificada, vamos revisar tudo para permitir acesso
            if ($loginOK && $senhaOK) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        public static function retornarIdInserindoLogin($login) {
            $con = Conect_model::conectar();
            $rs = $con->query("SELECT * FROM `usuario` WHERE login = '$login'");
            while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
                $id = $row->id;
            }
            return $id;
        }

        private static function retornarHashDaSenha($id) {
            $con = Conect_model::conectar();
            $rs = $con->query("SELECT * FROM `usuario` WHERE id = '$id'");
            while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
                $hash = $row->senha;
            }
            return $hash;
        }

        public static function oLoginJaExiste($login) {
            $con = Conect_model::conectar();
            $select = $con->prepare("SELECT * FROM `usuario` WHERE login = :login");
            $select->bindParam(':login', $login);
            $select->execute();
            $n = count($select->fetchAll(PDO::FETCH_ASSOC));
            if ($n > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        public static function atualizarUltimoAcesso($id) {
            $data_de_ultimo_acesso = Helper::retornarDataComHorario();
            //criando a conexão
            $con = Conect_model::conectar();
            /* conte quantas linhas retornaram da pesquisa */
            $select = $con->prepare("UPDATE `usuario` SET `data_de_ultimo_acesso` = :data_de_ultimo_acesso WHERE `usuario`.`id` = :id");
            $select->bindParam(':data_de_ultimo_acesso', $data_de_ultimo_acesso);
            $select->bindParam(':id', $id);
            $select->execute();
        }

        public static function atualizar_senha($login, $nova_senha) {
            $id = self::retornarIdInserindoLogin($login);
            $novo_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
            //criando a conexão
            $con = Conect_model::conectar();
            /* conte quantas linhas retornaram da pesquisa */
            $select = $con->prepare("UPDATE `usuario` SET `senha` = :senha WHERE `usuario`.`id` = :id");
            $select->bindParam(':senha', $novo_hash);
            $select->bindParam(':id', $id);
            $select->execute();
            if ($select->rowCount() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        public static function verificaSessao($chaveDeSessao) {
            $sessao = 'fga35ds4g8sd4g3g8weg7w987g9f8gre';
            if ($chaveDeSessao != $sessao) {
                redirect('autenticacao');
                exit();
            }
        }

        //getters
        function getId() {
            return $this->id;
        }

        function getNome() {
            return $this->nome;
        }

        function getLogin() {
            return $this->login;
        }

        function getTelefone() {
            return $this->telefone;
        }

        function getEmail() {
            return $this->email;
        }

        function getNivel_de_acesso() {
            return $this->nivel_de_acesso;
        }

        function getData_de_cadastro() {
            return $this->data_de_cadastro;
        }

        function getData_de_ultimo_acesso() {
            return $this->data_de_ultimo_acesso;
        }

        function getStatus() {
            return $this->status;
        }

    }

    /*
		FORMULARIOS E METODOS DE CADASTRO E EDIÇÃO DE NOVOS USUARIOS
		<!-- ############# formulario de cadastro #################### -->

		<h1 class='text-uppercase'>Cadastrar usuario</h1>
		<form method='post' id='form_cadastrar_usuario'>
		<fieldset>
		<!-- Nome -->
										<div class='form-group'>
												<label class='col-md-4 col-lg-3 control-label' for='nome'>Nome</label>  
												<div class='col-md-8 col-lg-9'>
												<input id='nome' name='nome' type='text' placeholder='Nome' class='form-control input-md' required>
												</div>
										</div>

		<!-- Login -->
										<div class='form-group'>
												<label class='col-md-4 col-lg-3 control-label' for='login'>Login</label>  
												<div class='col-md-8 col-lg-9'>
												<input id='login' name='login' type='text' placeholder='Login' class='form-control input-md' required>
												</div>
										</div>

		<!-- Senha -->
										<div class='form-group'>
												<label class='col-md-4 col-lg-3 control-label' for='senha'>Senha</label>  
												<div class='col-md-8 col-lg-9'>
												<input id='senha' name='senha' type='text' placeholder='Senha' class='form-control input-md' required>
												</div>
										</div>

		<!-- Telefone -->
										<div class='form-group'>
												<label class='col-md-4 col-lg-3 control-label' for='telefone'>Telefone</label>  
												<div class='col-md-8 col-lg-9'>
												<input id='telefone' name='telefone' type='text' placeholder='Telefone' class='form-control input-md' required>
												</div>
										</div>

		<!-- Email -->
										<div class='form-group'>
												<label class='col-md-4 col-lg-3 control-label' for='email'>Email</label>  
												<div class='col-md-8 col-lg-9'>
												<input id='email' name='email' type='text' placeholder='Email' class='form-control input-md' required>
												</div>
										</div>

		<!-- Nivel de acesso -->
										<div class='form-group'>
												<label class='col-md-4 col-lg-3 control-label' for='nivel_de_acesso'>Nivel de acesso</label>  
												<div class='col-md-8 col-lg-9'>
												<input id='nivel_de_acesso' name='nivel_de_acesso' type='text' placeholder='Nivel de acesso' class='form-control input-md' required>
												</div>
										</div>

		<!-- Data de cadastro -->
										<div class='form-group'>
												<label class='col-md-4 col-lg-3 control-label' for='data_de_cadastro'>Data de cadastro</label>  
												<div class='col-md-8 col-lg-9'>
												<input id='data_de_cadastro' name='data_de_cadastro' type='text' placeholder='Data de cadastro' class='form-control input-md' required>
												</div>
										</div>

		<!-- Data de ultimo acesso -->
										<div class='form-group'>
												<label class='col-md-4 col-lg-3 control-label' for='data_de_ultimo_acesso'>Data de ultimo acesso</label>  
												<div class='col-md-8 col-lg-9'>
												<input id='data_de_ultimo_acesso' name='data_de_ultimo_acesso' type='text' placeholder='Data de ultimo acesso' class='form-control input-md' required>
												</div>
										</div>

		<!-- Status -->
										<div class='form-group'>
												<label class='col-md-4 col-lg-3 control-label' for='status'>Status</label>  
												<div class='col-md-8 col-lg-9'>
												<input id='status' name='status' type='text' placeholder='Status' class='form-control input-md' required>
												</div>
										</div>

		<br><button type='submit' class='btn btn-lg btn-primary'>Publicar</button>

		</fieldset>
		</form>
		<br>
		<div class='container'>
				<div class='row'>
						<div id='resposta'></div>
				</div>
		</div>
		<script>
				$(document).ready(function () {
						$('#form_cadastrar_usuario').submit(function () {
								var page = "<?= base_url('##########################') ?>";
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
												$("#resposta").append(msg);
												$("#carregando_animado").hide('fast');
										}
								});
								return false;
						});
				});
		</script>

		<!-- ######### fim formulario de cadastro #################### -->


		<!-- ############# formulario de edição #################### -->

		<?php
		$usuario = Usuario_model::getObjUsuario($id);
		?>

		<h1 class='text-uppercase'>Editar usuario</h1>
		<form method='post' id='form_editar_usuario'>
		<fieldset>
		<!-- Nome -->
										<div class='form-group'>
												<label class='col-md-4 col-lg-3 control-label' for='nome'>Nome</label>  
												<div class='col-md-8 col-lg-9'>
												<input id='nome' name='nome' type='text' value='<?= $usuario->getNome() ?>' class='form-control input-md' required>
												</div>
										</div>

		<!-- Login -->
										<div class='form-group'>
												<label class='col-md-4 col-lg-3 control-label' for='login'>Login</label>  
												<div class='col-md-8 col-lg-9'>
												<input id='login' name='login' type='text' value='<?= $usuario->getLogin() ?>' class='form-control input-md' required>
												</div>
										</div>

		<!-- Senha -->
										<div class='form-group'>
												<label class='col-md-4 col-lg-3 control-label' for='senha'>Senha</label>  
												<div class='col-md-8 col-lg-9'>
												<input id='senha' name='senha' type='text' value='<?= $usuario->getSenha() ?>' class='form-control input-md' required>
												</div>
										</div>

		<!-- Telefone -->
										<div class='form-group'>
												<label class='col-md-4 col-lg-3 control-label' for='telefone'>Telefone</label>  
												<div class='col-md-8 col-lg-9'>
												<input id='telefone' name='telefone' type='text' value='<?= $usuario->getTelefone() ?>' class='form-control input-md' required>
												</div>
										</div>

		<!-- Email -->
										<div class='form-group'>
												<label class='col-md-4 col-lg-3 control-label' for='email'>Email</label>  
												<div class='col-md-8 col-lg-9'>
												<input id='email' name='email' type='text' value='<?= $usuario->getEmail() ?>' class='form-control input-md' required>
												</div>
										</div>

		<!-- Nivel de acesso -->
										<div class='form-group'>
												<label class='col-md-4 col-lg-3 control-label' for='nivel_de_acesso'>Nivel de acesso</label>  
												<div class='col-md-8 col-lg-9'>
												<input id='nivel_de_acesso' name='nivel_de_acesso' type='text' value='<?= $usuario->getNivel_de_acesso() ?>' class='form-control input-md' required>
												</div>
										</div>

		<!-- Data de cadastro -->
										<div class='form-group'>
												<label class='col-md-4 col-lg-3 control-label' for='data_de_cadastro'>Data de cadastro</label>  
												<div class='col-md-8 col-lg-9'>
												<input id='data_de_cadastro' name='data_de_cadastro' type='text' value='<?= $usuario->getData_de_cadastro() ?>' class='form-control input-md' required>
												</div>
										</div>

		<!-- Data de ultimo acesso -->
										<div class='form-group'>
												<label class='col-md-4 col-lg-3 control-label' for='data_de_ultimo_acesso'>Data de ultimo acesso</label>  
												<div class='col-md-8 col-lg-9'>
												<input id='data_de_ultimo_acesso' name='data_de_ultimo_acesso' type='text' value='<?= $usuario->getData_de_ultimo_acesso() ?>' class='form-control input-md' required>
												</div>
										</div>

		<!-- Status -->
										<div class='form-group'>
												<label class='col-md-4 col-lg-3 control-label' for='status'>Status</label>  
												<div class='col-md-8 col-lg-9'>
												<input id='status' name='status' type='text' value='<?= $usuario->getStatus() ?>' class='form-control input-md' required>
												</div>
										</div>

		<input type='hidden' name='id' value='<?= $usuario->getId() ?>'>
		<br><button type='submit' class='btn btn-lg btn-primary'>Salvar edição</button>

		</fieldset>
		</form>
		<br>
		<div class='container'>
				<div class='row'>
						<div id='resposta'></div>
				</div>
		</div>
		<script>
				$(document).ready(function () {
						$('form_editar_usuario').submit(function () {
								var page = "<?= base_url('##########################') ?>";
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
												$("#resposta").append(msg);
												$("#carregando_animado").hide('fast');
										}
								});
								return false;
						});
				});
		</script>

		<!-- ######### fim formulario de edição #################### -->


		<!-- ######### metodo que recebe o form de cadastro ########## -->

		$getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$nome = $getpost['nome'];
		$login = $getpost['login'];
		$senha = $getpost['senha'];
		$telefone = $getpost['telefone'];
		$email = $getpost['email'];
		$nivel_de_acesso = $getpost['nivel_de_acesso'];
		$data_de_cadastro = $getpost['data_de_cadastro'];
		$data_de_ultimo_acesso = $getpost['data_de_ultimo_acesso'];
		$status = $getpost['status'];

		$sucesso = Usuario_model::cadastrarUsuario($nome, $login, $senha, $telefone, $email, $nivel_de_acesso, $data_de_cadastro, $data_de_ultimo_acesso, $status);
						if ($sucesso) {
								$msg = "Mensagem de sucesso ###############";
								echo "
								<div class='row'>
										<div class='alert alert-info alert-dismissible fade in text-center' style='border: 1px solid blue;' role='alert'>
												<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
														<span aria-hidden='true'>x</span>
												</button>
												<strong>$msg</strong>
										</div>
								</div>";
						} else {
								$msg = "Aconteceu um erro ao cadastrar no banco de dados, se persistir informe ao programador.";
								echo "
								<div class='row'>
										<div class='alert alert-danger alert-dismissible fade in text-center' style='border: 1px solid red;' role='alert'>
												<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
														<span aria-hidden='true'>x</span>
												</button>
												<strong>$msg</strong>
										</div>
								</div>";
						}

		<!-- ##### fim metodo que recebe o form de cadastro ########## -->


		<!-- ######### metodo que recebe o form de edição   ########## -->

		$getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$id = $getpost['id'];
		$nome = $getpost['nome'];
		$login = $getpost['login'];
		$senha = $getpost['senha'];
		$telefone = $getpost['telefone'];
		$email = $getpost['email'];
		$nivel_de_acesso = $getpost['nivel_de_acesso'];
		$data_de_cadastro = $getpost['data_de_cadastro'];
		$data_de_ultimo_acesso = $getpost['data_de_ultimo_acesso'];
		$status = $getpost['status'];

		$sucesso = Usuario_model::editarUsuario($id,$nome, $login, $senha, $telefone, $email, $nivel_de_acesso, $data_de_cadastro, $data_de_ultimo_acesso, $status);
						if ($sucesso) {
								$msg = "Mensagem de sucesso ###############";
								echo "
								<div class='row'>
										<div class='alert alert-info alert-dismissible fade in text-center' style='border: 1px solid blue;' role='alert'>
												<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
														<span aria-hidden='true'>x</span>
												</button>
												<strong>$msg</strong>
										</div>
								</div>";
						} else {
								$msg = "Aconteceu um erro ao cadastrar no banco de dados, se persistir informe ao programador.";
								echo "
								<div class='row'>
										<div class='alert alert-danger alert-dismissible fade in text-center' style='border: 1px solid red;' role='alert'>
												<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
														<span aria-hidden='true'>x</span>
												</button>
												<strong>$msg</strong>
										</div>
								</div>";
						}

		<!-- ##### fim metodo que recebe o form de edição   ########## -->
			*/