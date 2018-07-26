<?php
function make_form($nome_classe, $atributos, $num_atributos) {
    $height = $num_atributos * 160 + 900; //calculando o tamanho do textarea

    echo '
				<h1>View '.strtolower($nome_classe).'.form</h1>
				<textarea style="width: 100%; background-color: #000; color:#fff; min-height:' . $height . 'px"> ';
    make_view_form($nome_classe, $atributos);
    echo "</textarea>";
}


###################################################################################################
#                                       VIEW INDEX                                                #
###################################################################################################
function make_index_view($nome_classe, $atributos, $numVars) {
    $height = 1500; //calculando o tamanho do textarea

    echo '
				<h1>View '.strtolower($nome_classe).'.index</h1>
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
                    <th style="width: 30px;">Id</th>
                    <th>Id</th>
                </tr>
            </thead>
            <tbody>
                @foreach($<?= strtolower($nome_classe) ?>s as $<?= strtolower($nome_classe) ?>)
                <tr>
                    <td>
                        <a href="{{ url('/<?= strtolower($nome_classe) ?>/'.$<?= strtolower($nome_classe) ?>->id.'/edit') }}">{{ $<?= strtolower($nome_classe) ?>->id }}</a>
                    </td>
                    <td>
                        <a href="{{ url('/<?= strtolower($nome_classe) ?>/'.$<?= strtolower($nome_classe) ?>->id.'/edit') }}">{{ $<?= strtolower($nome_classe) ?>->id }}</a>
                    </td>
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

###################################################################################################
#                                       VIEW FORM                                                 #
###################################################################################################
function make_view_form($nome_classe, $atributos) {
    echo "\n";//pula a linha
    ?>

@extends('adminlte::page')
@section('content_header')
<h1><?php echo $nome_classe ?></h1>
@stop

@section('content')
@include('messages.msgs')

<form method='post' action="@if(isset($<?= strtolower($nome_classe) ?>)){{ url('/<?= strtolower($nome_classe) ?>/'.$<?= strtolower($nome_classe) ?>->id) }}@else{{ url('/<?= strtolower($nome_classe) ?>') }}@endif">
    {{ csrf_field() }}
    @if(isset($<?= strtolower($nome_classe) ?>)){{ method_field('patch') }}@endif
    
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
            <div class="btn btn-lg btn-danger" onclick="if(confirm('confirmar exclusão?')){document.form_deletar.submit()}">
                <i class="fa fa-trash" aria-hidden="true"></i>
                Deletar
            </div>
        @endif            
    </fieldset>
</form>
@if(isset($<?= strtolower($nome_classe) ?>))
    <form action="{{ url('/<?= strtolower($nome_classe) ?>/'.$<?= strtolower($nome_classe) ?>->id)}}" method="post" name="form_deletar">
        {{ csrf_field() }}
        {{ method_field('delete') }}
    </form>
@endif
@stop

<?php
}