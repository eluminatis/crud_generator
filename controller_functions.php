<?php
###########################################################################################################
#                                               CONTROLLER                                                #
###########################################################################################################

function make_controller($nome_classe, $atributos, $numVars) {
    make_index_method($nome_classe, $atributos, $numVars);

    make_create_method($nome_classe, $atributos, $numVars);

    make_store_method($nome_classe, $atributos, $numVars);

    make_edit_method($nome_classe, $atributos, $numVars);

    make_update_method($nome_classe, $atributos, $numVars);

    make_destroy_method($nome_classe, $atributos, $numVars);
}

function make_index_method($nome_classe, $atributos, $numVars) {
    echo('
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
    $data["'.strtolower($nome_classe).'s"] = '. $nome_classe . '::all();
    return view("' . strtolower($nome_classe) . '.index", $data);;
}
    ');
}

function make_create_method($nome_classe, $atributos, $numVars) {
    echo('
/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
public function create()
{
    return view("' . strtolower($nome_classe) . '.form");
}
    ');
}

function make_store_method($nome_classe, $atributos, $numVars) {
    echo('
/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function store(Request $request)
{
    $request->validate([
    ');
    echo "\n";//pula a linha
    //criando as validações
foreach ($atributos as $atributo) {
    echo "        '$atributo' => 'required|min:4|max:191',";
    echo "\n";//pula a linha
}
    echo('
    ]);

    $' . strtolower($nome_classe) . ' = new ' . $nome_classe . '();
    ');
    echo "\n";//pula a linha
    //preenchendo os atributos do objeto recém criado
foreach ($atributos as $atributo) {
    echo '    $' . strtolower($nome_classe) . '->' . $atributo . ' = ' . '$request->' . $atributo . ';';
    echo "\n";//pula a linha
}
    //persistindo o objeto
    echo '    $' . strtolower($nome_classe) . '->save();';
    //mensagem flash de sucesso e retorno para a rota index
    echo('
    \Session::flash("flash_msg_success", "Armazenamento realizado com sucesso.");
    return redirect("/' . strtolower($nome_classe) . '");
}
    ');
}

function make_show_method($nome_classe, $atributos, $numVars) {
    echo('
/**
 * Display the specified resource.
 *
 * @param  \App\Models\\'.$nome_classe.' $'.strtolower($nome_classe).'
 * @return \Illuminate\Http\Response
 */
public function show('.$nome_classe.' $'.strtolower($nome_classe).')
{
    $data["'.strtolower($nome_classe).'"] = $'.strtolower($nome_classe).';
    return view("'.strtolower($nome_classe).'.show", $data);
}
    ');
}

function make_edit_method($nome_classe, $atributos, $numVars) {
    echo('
/**
 * Show the form for editing the specified resource.
 *
 * @param  \App\Models\\'.$nome_classe.' $'.strtolower($nome_classe).'
 * @return \Illuminate\Http\Response
 */
public function edit('.$nome_classe.' $'.strtolower($nome_classe).')
{
    $data["'.strtolower($nome_classe).'"] = $'.strtolower($nome_classe).';
    return view("'.strtolower($nome_classe).'.form", $data);
}
    ');
}

function make_update_method($nome_classe, $atributos, $numVars) {
    echo('
/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Models\\'.$nome_classe.' $'.strtolower($nome_classe).'
 * @return \Illuminate\Http\Response
 */
public function update(Request $request, '.$nome_classe.' $'.strtolower($nome_classe).')
{
    $request->validate([
    ');
    echo "\n";//pula a linha
    //criando as validações
foreach ($atributos as $atributo) {
    echo "        '$atributo' => 'required|min:4|max:191',";
    echo "\n";//pula a linha
}
    echo "\n";//pula a linha
    echo('    ]);');
    echo "\n\n";
    //preenchendo os atributos do objeto recém criado
foreach ($atributos as $atributo) {
    echo '    $' . strtolower($nome_classe) . '->' . $atributo . ' = ' . '$request->' . $atributo . ';';
    echo "\n";//pula a linha
}
    //persistindo o objeto
    echo '    $' . strtolower($nome_classe) . '->save();';
    echo "\n";//pula a linha
    //mensagem flash de sucesso e retorno para a rota index
    echo('
    \Session::flash("flash_msg_success", "Update realizado com sucesso.");
    return redirect("/' . strtolower($nome_classe) . '");
}
    ');
}

function make_destroy_method($nome_classe, $atributos, $numVars) {
    echo('
/**
 * Remove the specified resource from storage.
 *
 * @param  \App\Models\\'.$nome_classe.' $'.strtolower($nome_classe).'
 * @return \Illuminate\Http\Response
 */
public function destroy('.$nome_classe.' $'.strtolower($nome_classe).')
{
    $'.strtolower($nome_classe).'->delete();
    \Session::flash("flash_msg_success", "Exclusão realizada com sucesso.");
    return redirect("/' . strtolower($nome_classe) . '");
}
    ');
}