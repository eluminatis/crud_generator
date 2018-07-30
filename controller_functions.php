<?php
###########################################################################################################
#                                               CONTROLLER                                                #
###########################################################################################################

function make_controller($v) {
    echo '#colocar no topo >>>> use App\Http\Requests\\'. $v['nome_classe'] .'Request'. PHP_EOL;

    make_index_method($v);

    make_create_method($v);

    make_store_method($v);

    make_edit_method($v);

    make_update_method($v);

    make_destroy_method($v);
}

function make_index_method($v) {
    echo('
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
    $data["'.$v['nome_classe_min'].'s"] = '. $v['nome_classe'] . '::all();
    return view("' . $v['nome_classe_min'] . '.index", $data);;
}
    ');
}

function make_create_method($v) {
    echo('
/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
public function create()
{
    return view("' . $v['nome_classe_min'] . '.form");
}
    ');
}

function make_store_method($v) {
    echo('
/**
 * Store a newly created resource in storage.
 *
 * @param  \App\Http\Requests\\' . $v['nome_classe'] . 'Request  $request
 * @return \Illuminate\Http\Response
 */
public function store(' . $v['nome_classe'] . 'Request $request)
{
    $this->runValidate($request);
    ');
    echo('
    $' . $v['nome_classe_min'] . ' = new ' . $v['nome_classe'] . '();
    ');
    echo "\n";//pula a linha
    //preenchendo os atributos do objeto recém criado
foreach ($v["atributos"] as $atributo) {
    echo '    $' . $v['nome_classe_min'] . '->' . $atributo . ' = ' . '$request->' . $atributo . ';';
    echo "\n";//pula a linha
}
    //persistindo o objeto
    echo '    $' . $v['nome_classe_min'] . '->save();';
    //mensagem flash de sucesso e retorno para a rota index
    echo('
    \Session::flash("flash_msg_success", "Armazenamento realizado com sucesso.");
    return redirect("/' . $v['nome_classe_min'] . '");
}
    ');
}

function make_show_method($v) {
    echo('
/**
 * Display the specified resource.
 *
 * @param  \App\Models\\'.$v["nome_classe"].' $'.$v['nome_classe_min'].'
 * @return \Illuminate\Http\Response
 */
public function show('.$v["nome_classe"].' $'.$v['nome_classe_min'].')
{
    $data["'.$v['nome_classe_min'].'"] = $'.$v['nome_classe_min'].';
    return view("'.$v['nome_classe_min'].'.show", $data);
}
    ');
}

function make_edit_method($v) {
    echo('
/**
 * Show the form for editing the specified resource.
 *
 * @param  \App\Models\\'.$v["nome_classe"].' $'.$v['nome_classe_min'].'
 * @return \Illuminate\Http\Response
 */
public function edit('.$v["nome_classe"].' $'.$v['nome_classe_min'].')
{
    $data["'.$v['nome_classe_min'].'"] = $'.$v['nome_classe_min'].';
    return view("'.$v['nome_classe_min'].'.form", $data);
}
    ');
}

function make_update_method($v) {
    echo('
/**
 * Update the specified resource in storage.
 *
 * @param  \App\Http\Requests\\' . $v['nome_classe'] . 'Request  $request
 * @param  \App\Models\\'.$v["nome_classe"].' $'.$v['nome_classe_min'].'
 * @return \Illuminate\Http\Response
 */
public function update(' . $v['nome_classe'] . 'Request $request, '.$v["nome_classe"].' $'.$v['nome_classe_min'].')
{
    $this->runValidate($request);
    ');
    echo "\n";//pula a linha
    //preenchendo os atributos do objeto recém atualizado
foreach ($v["atributos"] as $atributo) {
    echo '    $' . $v['nome_classe_min'] . '->' . $atributo . ' = ' . '$request->' . $atributo . ';';
    echo "\n";//pula a linha
}
    //persistindo o objeto
    echo '    $' . $v['nome_classe_min'] . '->save();';
    echo "\n";//pula a linha
    //mensagem flash de sucesso e retorno para a rota index
    echo('
    \Session::flash("flash_msg_success", "Update realizado com sucesso.");
    return redirect("/' . $v['nome_classe_min'] . '");
}
    ');
}

function make_destroy_method($v) {
    echo('
/**
 * Remove the specified resource from storage.
 *
 * @param  \App\Models\\'.$v["nome_classe"].' $'.$v['nome_classe_min'].'
 * @return \Illuminate\Http\Response
 */
public function destroy('.$v["nome_classe"].' $'.$v['nome_classe_min'].')
{
    $'.$v['nome_classe_min'].'->delete();
    \Session::flash("flash_msg_success", "Exclusão realizada com sucesso.");
    return redirect("/' . $v['nome_classe_min'] . '");
}
    ');
}