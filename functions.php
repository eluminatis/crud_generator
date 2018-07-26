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
function make_routes($v) {
    echo "\n";//pula a linha
    echo "Route::resource('/" . $v["nome_classe_min"] . "', '" . $v["nome_classe"] . "Controller');";
    echo "\n";//pula a linha
}






