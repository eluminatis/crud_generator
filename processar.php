<?php

/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 *
 * Modificado por: Girol | andregirol@gmail.com
 */
require_once	'functions.php';

echo "<style>body{background:#cecece}</style>";

//recebendo os dados do form da index
$getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// Busca os atributos preenchidos pelo usuário e transforma em array
$atributos = array_map('trim', explode(',', $getpost['atributos']));

//recebendo o nome da classe e colocando a primeira letra maiuscula ja que se trata de um nome de classe *-*
$nome_classe = ucfirst(strtolower($getpost['nome']));

//gerando uma variavel com a contagem dos attrs
$num_atributos = count($atributos);

/* rotas do laravel*/
make_routes($nome_classe, $atributos, $num_atributos);

/* metodos do controller que receberao os post dos formularios */
make_methods($nome_classe, $atributos, $num_atributos);

/* formularios html com classes booststrap */
make_forms($nome_classe, $atributos, $num_atributos);

/*  classe php contendo os atributos do formulario */
make_index_view($nome_classe,	$atributos, $num_atributos);
