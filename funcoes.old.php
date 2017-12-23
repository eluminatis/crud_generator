<?php
/* ########################################################### */
/*             formularios html com classes booststrap        */
/* ########################################################### */

function	make_form($nome_classe,	$atributos)	{
		?>
		<!-- ############# formulario de cadastro #################### -->
		<h1 class='text-uppercase'>Cadastrar <?=	ucfirst($nome_classe)	?></h1>
		<form method='post' id='form_cadastrar_<?=	$nome_classe	?>'>
				<fieldset>

						<?php
						foreach	($atributos	as	$atributo)	{

								// Explode os underlines por espaços e bota primeira letra em maiúscula
								$txt_atributo	=	str_replace('_',	' ',	ucfirst($atributo));
								echo	"<!-- {$txt_atributo} -->";
								?>
								<div class='form-group'>
										<label class='control-label' for='<?=	$atributo	?>'><?=	$txt_atributo	?></label>
										<input id='<?=	$atributo	?>' name='<?=	$atributo	?>' type='text' placeholder='<?=	$txt_atributo	?>' class='form-control input-md' required>
								</div>
								<?php
						}	// fim do foreach
				}

// fim da função
