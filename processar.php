<?php

/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 *
 * Modificado por: Girol | andregirol@gmail.com
 */
require_once 'functions.php';
require_once 'view_functions.php';
require_once 'controller_functions.php';

//recebendo os dados do form da index
$getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
// Busca os atributos preenchidos pelo usuário e transforma em array
$atributos = array_map('trim', explode(',', $getpost['atributos']));
//recebendo o nome da classe e colocando a primeira letra maiuscula ja que se trata de um nome de classe *-*
$nome_classe = ucfirst(strtolower($getpost['nome']));
//gerando uma variavel com a contagem dos attrs
$num_atributos = count($atributos);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Codigo fonte</title>
    <!-- Latest compiled and minified bootstrap 3 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
    body{
        background-color: #0c0c0c;
    }
    h2{color:#fff}
    pre{
        background-color: black;
        color: #fff;
        font-size: 17px;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <h2>Rotas</h2>
            <code->
                <pre>
                    <?php make_routes($nome_classe, $atributos, $num_atributos); ?>
                </pre>
            </code->

            <h2>Controller</h2>
            <code->
                <pre>
                    <?php make_controller($nome_classe, $atributos, $num_atributos); ?>
                </pre>
            </code->
            <?php
            // index do crud
            make_index_view($nome_classe, $atributos, $num_atributos);
            // formulario
            make_form($nome_classe, $atributos, $num_atributos);   
            ?>
        </div>
    </div>
</body>
</html>