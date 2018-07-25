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
    echo "Route::get('/" . strtolower($nome_classe) . "', '$nome_classe" . "Controller@index');";
    echo "\n";//pula a linha
    echo "Route::get('/" . strtolower($nome_classe) . "/create', '$nome_classe" . "Controller@create');";
    echo "\n";//pula a linha
    echo "Route::post('/" . strtolower($nome_classe) . "/store', '$nome_classe" . "Controller@store');";
    echo "\n";//pula a linha
    echo "Route::get('/" . strtolower($nome_classe) . "/{" . strtolower($nome_classe) . "}/edit', '$nome_classe" . "Controller@edit');";
    echo "\n";//pula a linha
    echo "Route::post('/" . strtolower($nome_classe) . "/{" . strtolower($nome_classe) . "}/update', '$nome_classe" . "Controller@update');";
    echo "\n";//pula a linha
    echo "Route::get('/" . strtolower($nome_classe) . "/{" . strtolower($nome_classe) . "}/destroy', '$nome_classe" . "Controller@destroy');";
}

### CONTROLLER
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

### VIEWS
###########################################################################################################

function make_forms($nome_classe, $atributos, $num_atributos) {
    $height = $num_atributos * 132 + 450; //calculando o tamanho do textarea

    echo '
				<h1>View form</h1>
				<textarea style="width: 100%; background-color: #000; color:#fff; min-height:' . $height . 'px"> ';
    make_edit_form($nome_classe, $atributos);
    echo "</textarea>";
}

function make_index_view($nome_classe, $atributos, $numVars) {
    $height = 1500; //calculando o tamanho do textarea

    echo '
				<h1>View index</h1>
				<textarea style="width: 100%; background-color: #000; color:#fff; min-height:' . $height . 'px">';
    echo "\n";//pula a linha
    ?>
    @extends('adminlte::page')
    @section('content_header')
    <h1><?php echo $nome_classe . 's' ?></h1>
    @stop

    @include('messages.msgs')

    <a href="{{ url('/<?= strtolower($nome_classe) ?>/create') }}" class="btn btn-lg btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i> Novo cadastro</a>
    @if($<?= strtolower($nome_classe) ?>s->all())
    <br /><br />
    <div class='box'>
        <div class='box-body' style="overflow: auto;">
            <table id="mytable" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>#######</th>
                        <th>#######</th>
                        <th style="width:125px">Visualizar</th>
                        <th style="width:125px">Editar</th>
                        <th style="width:125px">Apagar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($<?= strtolower($nome_classe) ?>s as $<?= strtolower($nome_classe) ?>)
                    <tr>
                        <td>{{ $<?= strtolower($nome_classe) ?>->id }}</td>
                        <td>{{ $<?= strtolower($nome_classe) ?>->####### }}</td>
                        <td>{{ $<?= strtolower($nome_classe) ?>->####### }}</td>
                        <td><a href="{{ url('/<?= strtolower($nome_classe) ?>/'.$<?= strtolower($nome_classe) ?>->id.'/show') }}" class="btn btn-lg btn-block btn-success">Visualizar</a></td>
                        <td><a href="{{ url('/<?= strtolower($nome_classe) ?>/'.$<?= strtolower($nome_classe) ?>->id.'/edit') }}" class="btn btn-lg btn-block btn-primary">Editar</a></td>
                        <td><a href="{{ url('/<?= strtolower($nome_classe) ?>/'.$<?= strtolower($nome_classe) ?>->id.'/destroy') }}" class="btn btn-lg btn-block btn-danger">Apagar</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <br /><br />
    <p>Não há <?= strtolower($nome_classe) ?>s cadastrados</p>
    @endif
    @stop

    @section('js')
    <script>
        $(document).ready(function () {
            $('#mytable').DataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "Nada encontrado - desculpe",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "Nenhum registro encontrado",
                    "infoFiltered": "(filtrado de _MAX_ registros)",
                    "loadingRecords": "Carregando...",
                    "processing": "Processando...",
                    "search": "Procurar:",
                    "paginate": {
                        "first": "Primeiro",
                        "last": "Último",
                        "next": "Próximo",
                        "previous": "Anterior"
                    }
                }
            });
        });
    </script>
    @stop

    <?php
    echo "</textarea>";
}

function make_insert_form($nome_classe, $atributos, $num_atributos) {
    echo "\n";//pula a linha
    ?>
    @extends('adminlte::page')
    @section('title', 'Inserir <?= $nome_classe ?>')
    @section('content_header')
    <a href="{{ url( '/<?= strtolower($nome_classe) ?>' )}}" class="btn btn-info">
        <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
        Voltar
    </a>
    <h1><?php echo $nome_classe . 's' ?></h1>
    @stop

    @section('content')
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method='post' action="{{ url('/<?= strtolower($nome_classe) ?>/store') }}">
        <fieldset>
            <?php
            foreach ($atributos as $atributo):
                $nome_do_atributo = str_replace('_', ' ', ucfirst($atributo));
                ?>
                <!-- <?= $nome_do_atributo ?> -->
                <div class='form-group {{ $errors->any()?$errors->has('<?= $atributo ?>')?'has-error':'has-success':'' }}'>
                    <label class='control-label' for='<?= $atributo ?>'><?= $nome_do_atributo ?></label>
                    <input id='<?= $atributo ?>' name='<?= $atributo ?>' type='text' value="{{ old('<?= $atributo ?>') }}" placeholder='<?= $nome_do_atributo ?>' class='form-control input-md' required>
                </div>
            <?php endforeach; ?>
            <br>
            {{ csrf_field() }}
            <div class="clearfix"></div>
            <button type='submit' class='btn btn-lg btn-primary'>Cadastrar</button>
        </fieldset>
    </form>
    @stop
    <?php
}

function make_edit_form($nome_classe, $atributos) {
    echo "\n";//pula a linha
    ?>
    @extends('adminlte::page')
    @section('content_header')
    <h1><?php echo $nome_classe ?></h1>
    @stop

    @section('content')
    @include('messages.msgs')

    <form method='post' action="@if(isset($<?= strtolower($nome_classe) ?>)){{ url('/<?= strtolower($nome_classe) ?>/'.$<?= strtolower($nome_classe) ?>->id.'/update') }}@else{{ url('/<?= strtolower($nome_classe) ?>/store') }}@endif">
        <fieldset>
            <?php
            foreach ($atributos as $atributo):
                $nome_do_atributo = str_replace('_', ' ', ucfirst($atributo));
                echo "\n";//pula a linha ?>
            <!-- <?= $nome_do_atributo ?> -->
            <div class='form-group {{ $errors->any()?$errors->has('<?= $atributo ?>')?'has-error':'has-success':'' }}'>
                <label class='control-label' for='<?= $atributo ?>'><?= $nome_do_atributo ?></label>
                <input id='<?= $atributo ?>' name='<?= $atributo ?>' type='text' placeholder='<?= $nome_do_atributo ?>' @if(old('<?= $atributo ?>') || isset($<?= strtolower($nome_classe) ?>)) value='@if(old('<?= $atributo ?>')){{ old('<?= $atributo ?>') }}@else{{$<?= strtolower($nome_classe) ?>-><?= $atributo ?>}}@endif'@endif class='form-control input-md' required>
            </div>
            <?php endforeach; ?>
            <br>
            {{ csrf_field() }}
            <div class="clearfix"></div>
            <a href="{{ url( '/<?= strtolower($nome_classe) ?>' )}}" class="btn btn-lg btn-info">
                <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                Voltar
            </a>
            <button type='submit' class='btn btn-lg btn-primary'>
                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                Salvar
                @if(isset($<?= strtolower($nome_classe) ?>)) Alterações @endif
            </button>
            @if(isset($<?= strtolower($nome_classe) ?>))
                <a href="{{ url('/<?= strtolower($nome_classe) ?>/'.$<?= strtolower($nome_classe) ?>->id.'/destroy')}}" class="btn btn-lg btn-danger">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                    Deletar
                </a>
            @endif            
        </fieldset>
    </form>
    @stop
    <?php
}

function make_show_view($nome_classe, $atributos) {
    echo "\n";//pula a linha
    ?>
    @extends('adminlte::page')
    @section('content_header')
    <a href="{{ url( '/<?= strtolower($nome_classe) ?>' )}}" class="btn btn-info">
        <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
        Voltar
    </a>
    <h1><?php echo $nome_classe . 's' ?></h1>
    @stop

    @section('content')
    <fieldset>
        <?php
        foreach ($atributos as $atributo):
            $nome_do_atributo = str_replace('_', ' ', ucfirst($atributo));
            ?>
            <!-- <?= $atributo ?> -->
            <div class='form-group'>
                <label class='control-label' for='<?= $atributo ?>'><?= ucfirst($atributo) ?></label>
                <output class='form-control input-md'>{{ $<?= strtolower($nome_classe) ?>-><?= $atributo ?> }}</output>
            </div>
        <?php endforeach; ?>
    </fieldset>
    @stop
    <?php
}


