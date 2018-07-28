<?php
/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 *
 * Modificado por: Girol | andregirol@gmail.com
 */

### ROTAS
###########################################################################################################
function make_routes($v)
{
    echo "Route::resource('/{$v['nome_classe_min']}', '{$v['nome_classe']}Controller');";
}

function make_migration($v)
{
    foreach ($v["atributos"] as $atributo) {
        echo "\$table->string('{$atributo}')->nullable()->comment(\"Comentario\");" . PHP_EOL;
    }
}

function make_factory($v)
{
    echo "\n";//pula a linha
    foreach ($v["atributos"] as $atributo) {
        echo '"' . $atributo . '" => ucfirst($faker->words(rand(2, 5), true)),';
        echo "\n";//pula a linha
    }
}




