<?php
/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 *
 * Modificado por: Girol | andregirol@gmail.com
 */

function make_forms($nome_classe, $atributos, $num_atributos) {
    $height = $num_atributos * 80 + 450; //calculando o tamanho do textarea

    echo '
				<h1>View create</h1>
				<textarea style="width: 100%; background-color: #000; color:#fff; min-height:' . $height . 'px"> ';
    make_insert_form($nome_classe, $atributos, $num_atributos);
    echo "</textarea>";

    echo '
				<h1>View edit</h1>
				<textarea style="width: 100%; background-color: #000; color:#fff; min-height:' . $height . 'px"> ';
    make_edit_form($nome_classe, $atributos);
    echo "</textarea>";

    echo '
				<h1>View show</h1>
				<textarea style="width: 100%; background-color: #000; color:#fff; min-height:' . $height . 'px"> ';
    make_show_view($nome_classe, $atributos, $num_atributos);
    echo "</textarea>";
}

function make_insert_form($nome_classe, $atributos, $num_atributos) {
    echo "\n";
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
    echo "\n";
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
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method='post' action="{{ url('/<?= strtolower($nome_classe) ?>/'.$<?= strtolower($nome_classe) ?>->id.'/update') }}">
        <fieldset>
            <?php
            foreach ($atributos as $atributo):
                $nome_do_atributo = str_replace('_', ' ', ucfirst($atributo));
                ?>
                <!-- <?= $nome_do_atributo ?> -->
                <div class='form-group {{ $errors->any()?$errors->has('<?= $atributo ?>')?'has-error':'has-success':'' }}'>
                    <label class='control-label' for='<?= $atributo ?>'><?= $nome_do_atributo ?></label>
                    <input id='<?= $atributo ?>' name='<?= $atributo ?>' type='text' value='{{ empty(old('<?= $atributo ?>')) ? $<?= strtolower($nome_classe) ?>-><?= $atributo ?> : old('<?= $atributo ?>') }}' class='form-control input-md' required>
                </div>
            <?php endforeach; ?>
            <br>
            {{ csrf_field() }}
            <div class="clearfix"></div>
            <button type='submit' class='btn btn-lg btn-primary'>Salvar edição</button>
        </fieldset>
    </form>
    @stop
    <?php
}

function make_show_view($nome_classe, $atributos) {
    echo "\n";
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

function make_methods($nome_classe, $atributos, $numVars) {
    $height = $numVars * 30 + 150; //calculando o tamanho do textarea

    echo '
				<h1>Metodo ' . $nome_classe . 'Controller@index</h1>
				<textarea style="width: 100%; background-color: #000; color:#fff; min-height:' . 70 . 'px"> ';
    make_index_method($nome_classe, $atributos, $numVars);
    echo "</textarea>";

    echo '
				<h1>Metodo ' . $nome_classe . 'Controller@create</h1>
				<textarea style="width: 100%; background-color: #000; color:#fff; min-height:' . 50 . 'px"> ';
    make_create_method($nome_classe, $atributos, $numVars);
    echo "</textarea>";

    echo '
				<h1>Metodo ' . $nome_classe . 'Controller@store</h1>
				<textarea style="width: 100%; background-color: #000; color:#fff; min-height:' . $height . 'px"> ';
    make_store_method($nome_classe, $atributos, $numVars);
    echo "</textarea>";

    echo '
				<h1>Metodo ' . $nome_classe . 'Controller@show</h1>
				<textarea style="width: 100%; background-color: #000; color:#fff; min-height:' . 70 . 'px"> ';
    make_show_method($nome_classe, $atributos, $numVars);
    echo "</textarea>";

    echo '
				<h1>Metodo ' . $nome_classe . 'Controller@edit</h1>
				<textarea style="width: 100%; background-color: #000; color:#fff; min-height:' . 70 . 'px"> ';
    make_edit_method($nome_classe, $atributos, $numVars);
    echo "</textarea>";

    echo '
				<h1>Metodo ' . $nome_classe . 'Controller@update</h1>
				<textarea style="width: 100%; background-color: #000; color:#fff; min-height:' . $height . 'px"> ';
    make_update_method($nome_classe, $atributos, $numVars);
    echo "</textarea>";

    echo '
				<h1>Metodo ' . $nome_classe . 'Controller@destroy</h1>
				<textarea style="width: 100%; background-color: #000; color:#fff; min-height:' . 70 . 'px"> ';
    make_destroy_method($nome_classe, $atributos, $numVars);
    echo "</textarea>";
}

function make_index_method($nome_classe, $atributos, $numVars) {
    echo "\n";
    echo '$data' . "['" . strtolower($nome_classe) . "s'] = " . $nome_classe . "::all();";
    echo "\n";
    echo 'return view(\'' . strtolower($nome_classe) . '.index\', $data);';
}

function make_show_method($nome_classe, $atributos, $numVars) {
    echo "\n";
    echo '$data' . "['" . strtolower($nome_classe) . "'] = $" . strtolower($nome_classe) . ";";
    echo "\n";
    echo 'return view(\'' . strtolower($nome_classe) . '.show\', $data);';
}

function make_create_method($nome_classe, $atributos, $numVars) {
    echo "\n";
    echo 'return view(\'' . strtolower($nome_classe) . '.create\');';
}

function make_store_method($nome_classe, $atributos, $numVars) {
    echo "\n";
    echo '$request->validate([';
    echo "\n";
    foreach ($atributos as $atributo) {
        echo "    '$atributo' => 'required|min:4|max:191',";
        echo "\n";
    }
    echo ']);';
    echo "\n";
    echo '$' . strtolower($nome_classe) . ' = new ' . $nome_classe . '();';
    echo "\n";
    foreach ($atributos as $atributo) {
        echo '$' . strtolower($nome_classe) . '->' . $atributo . ' = ' . '$request->' . $atributo . ';';
        echo "\n";
    }
    echo '$' . strtolower($nome_classe) . '->save();';
    echo "\n";
    echo "\Session::flash('flash_msg', 'Armazenamento realizado com sucesso.');";
    echo "\n";
    echo "return redirect('/" . strtolower($nome_classe) . "');";
}

function make_edit_method($nome_classe, $atributos, $numVars) {
    echo "\n";
    echo '$data' . "['" . strtolower($nome_classe) . "s'] = $" . strtolower($nome_classe) . ";";
    echo "\n";
    echo 'return view(\'' . strtolower($nome_classe) . '.edit\', $data);';
}

function make_update_method($nome_classe, $atributos, $numVars) {
    echo "\n";
    echo '$request->validate([';
    echo "\n";
    foreach ($atributos as $atributo) {
        echo "    '$atributo' => 'required|min:4|max:191',";
        echo "\n";
    }
    echo ']);';
    echo "\n";
    foreach ($atributos as $atributo) {
        echo '$' . strtolower($nome_classe) . '->' . $atributo . ' = ' . '$request->' . $atributo . ';';
        echo "\n";
    }
    echo '$' . strtolower($nome_classe) . '->save();';
    echo "\n";
    echo "\Session::flash('flash_msg', 'Edição realizada com sucesso.');";
    echo "\n";
    echo "return redirect('/" . strtolower($nome_classe) . "');";
}

function make_destroy_method($nome_classe, $atributos, $numVars) {
    echo "\n";
    echo "$" . strtolower($nome_classe) . "->delete();";
    echo "\n";
    echo "\Session::flash('flash_msg', 'Exclusão realizada com sucesso.');";
    echo "\n";
    echo "return redirect('/" . strtolower($nome_classe) . "');";
}

function make_routes($nome_classe, $atributos, $numVars) {
    $height = 150; //calculando o tamanho do textarea
    echo '<h1>Rotas</h1><textarea style="width: 100%; background-color: #000; color:#fff; min-height:' . $height . 'px"> ';
    echo "\n";
    echo "Route::get('/" . strtolower($nome_classe) . "', '$nome_classe" . "Controller@index');";
    echo "\n";
    echo "Route::get('/" . strtolower($nome_classe) . "/create', '$nome_classe" . "Controller@create');";
    echo "\n";
    echo "Route::post('/" . strtolower($nome_classe) . "/store', '$nome_classe" . "Controller@store');";
    echo "\n";
    echo "Route::get('/" . strtolower($nome_classe) . "/{" . strtolower($nome_classe) . "}/show', '$nome_classe" . "Controller@show');";
    echo "\n";
    echo "Route::get('/" . strtolower($nome_classe) . "/{" . strtolower($nome_classe) . "}/edit', '$nome_classe" . "Controller@edit');";
    echo "\n";
    echo "Route::post('/" . strtolower($nome_classe) . "/{" . strtolower($nome_classe) . "}/update', '$nome_classe" . "Controller@update');";
    echo "\n";
    echo "Route::get('/" . strtolower($nome_classe) . "/{" . strtolower($nome_classe) . "}/destroy', '$nome_classe" . "Controller@destroy');";
    echo "</textarea>";
}

function make_index_view($nome_classe, $atributos, $numVars) {
    $height = 1200; //calculando o tamanho do textarea

    echo '
				<h1>View index</h1>
				<textarea style="width: 100%; background-color: #000; color:#fff; min-height:' . $height . 'px">';
    echo "\n";
    ?>
    @extends('adminlte::page')
    @section('content_header')
    <h1><?php echo $nome_classe . 's' ?></h1>
    @stop

    @section('content')
    @if(Session::has('flash_msg'))
    <div class="alert alert-warning text-center">
        <p><b>{{Session::get('flash_msg')}}</b></p>
    </div>
    @endif
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
