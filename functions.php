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
function make_routes($nome_classe, $atributos, $numVars) {
    echo "\n";//pula a linha
    echo "Route::resource('/" . strtolower($nome_classe) . "', '" . $nome_classe . "Controller');";
    echo "\n";//pula a linha
}






