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

function make_request($v){
    echo('
/**
 * Determine if the user is authorized to make this request.
 *
 * @return bool
 */
public function authorize()
{
    return true;
}

/**
 * Get the validation rules that apply to the request.
 *
 * @return array
 */
public function rules()
{
    return [
    ');
    echo "\n";//pula a linha
    //criando as validações
foreach ($v["atributos"] as $atributo) {
    echo "        '$atributo' => 'required|min:4|max:191',";
    echo "\n";//pula a linha
}
    echo "\n";//pula a linha
    echo('    ];');
    echo "\n}";
}




