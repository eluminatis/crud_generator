<?php

/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 * 
 * Modificado por: Girol | andregirol@gmail.com
 */
require_once	'functions.php';

//recebendo os dados do form da index
$getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// Busca os atributos preenchidos pelo usuário e transforma em array
$atributos = array_map('trim', explode(',', $getpost['atributos']));

//recebendo o nome da classe e colocando a primeira letra maiuscula ja que se trata de um nome de classe *-*
$nome_classe = ucfirst(strtolower($getpost['nome']));

//gerando uma variavel com a contagem dos attrs
$num_atributos = count($atributos);

//iniciando a var $s, depois a gente remove essa gambi de var e cada metodo dara seus echo's
$s = "\n\n";

/* formularios html com classes booststrap */
make_forms($nome_classe, $atributos, $num_atributos);

/* metodos do controller que receberao os post dos formularios */
make_methods($nome_classe, $atributos, $num_atributos);

/* comando sql para criar a tabela da classse no banco*/
make_sql($nome_classe, $atributos, $num_atributos);

/*  classe php contendo os atributos do formulario */
$s .= make_class($nome_classe,	$atributos, $num_atributos);

//jogando o codigo gerado na tela
var_dump($s);

echo "<h1>O codigo gerado esta no codigo fonte dessa pagina</h1>";
