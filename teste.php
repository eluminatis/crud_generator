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
								var page = "<?=	base_url('##########################')	?>";
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
		$pessoa	=	Pessoa_model::getObjPessoa($id);
		?>

		<h1 class='text-uppercase'>Editar pessoa</h1>
		<form method='post' id='form_editar_pessoa'>
				<fieldset>
						<!-- Nome -->
						<div class='form-group'>
								<label class='control-label' for='nome'>Nome</label>
								<input id='nome' name='nome' type='text' value='<?=	$pessoa->getNome()	?>' class='form-control input-md' required>
						</div>

						<!-- Telefone -->
						<div class='form-group'>
								<label class='control-label' for='telefone'>Telefone</label>
								<input id='telefone' name='telefone' type='text' value='<?=	$pessoa->getTelefone()	?>' class='form-control input-md' required>
						</div>

						<!-- Email -->
						<div class='form-group'>
								<label class='control-label' for='email'>Email</label>
								<input id='email' name='email' type='text' value='<?=	$pessoa->getEmail()	?>' class='form-control input-md' required>
						</div>

						<!-- Senha -->
						<div class='form-group'>
								<label class='control-label' for='senha'>Senha</label>
								<input id='senha' name='senha' type='text' value='<?=	$pessoa->getSenha()	?>' class='form-control input-md' required>
						</div>

						<input type='hidden' name='id' value='<?=	$pessoa->getId()	?>'>
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
								var page = "<?=	base_url('##########################')	?>";
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