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

// Gera um array para transporte de dados
$getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$v = [
    'atributos' => array_map('trim', explode(',', $getpost['atributos'])),

    //recebendo o nome da classe e colocando a primeira letra maiuscula ja que se trata de um nome de classe *-*
    'nome_classe' => ucfirst(strtolower($getpost['nome'])),

    'nome_classe_min' => strtolower($getpost['nome']),

    // 'num_atributos' => count($v['atributos']),
];

//gerando uma variavel com a contagem dos attrs
$v['num_atributos'] = count($v['atributos']);
// Gera variáveis com os mesmos nomes das chaves do array:
extract($v);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Codigo fonte</title>
    <!-- Latest compiled and minified bootstrap 3 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <style>
   
    pre {
        background-color: #f8f9fa;
        padding: 20px;
        /* color: #28a745; */
        font-size: 17px;
        font-family: monospace;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <h2> Rota 
                    <button data-clipboard-target="#rotas" class="btn btn-sm btn-success pull-left">
                        copiar &lt;/&gt;
                    </button>
                </h2>
                
                <code>
                    <pre id="rotas"><?php make_routes($v); ?></pre>
                </code>

                <h2> Migration
                    <button data-clipboard-target="#migration" class="btn btn-sm btn-success pull-left">
                        copiar &lt;/&gt;
                    </button>
                </h2>
                <code>
                    <pre id="migration"><?php make_migration($v); ?></pre>
                </code>

                <h2> Factory
                    <button data-clipboard-target="#factory" class="btn btn-sm btn-success pull-left">
                        copiar &lt;/&gt;
                    </button>
                </h2>
                <code>
                    <pre id="factory"><?php make_factory($v); ?></pre>
                </code>

                <h2> Controller
                    <button data-clipboard-target="#controller" class="btn btn-sm btn-success pull-left">
                        copiar &lt;/&gt;
                    </button>
                </h2>
                <code>
                    <pre id="controller"><?php make_controller($v); ?></pre>
                </code>
                
            <h1> View <?= $nome_classe_min ?>.index </h1>
            <?php
            // index do crud
            make_index_view($v);
            // formulario
            make_form($v);
            ?>
            </div>

        </div>
    </div>
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <!-- Copy to Clipboard plugin -->
    <script type="text/javascript" src="https://milankyncl.github.io/jquery-copy-to-clipboard/jquery.copy-to-clipboard.js"></script>
    <script>
        $(document).ready(function(){

        });
    </script>
</body>
</html>