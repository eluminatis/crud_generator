<?php
###################################################################################################
#                                       VIEW INDEX                                                #
###################################################################################################
function make_index_view($v)
{
extract($v);

$height = 1500; ?>

<textarea  id="index_view" style="min-height:<?= $height ?>px" readonly>

@extends('adminlte::page')
@section('content_header')
<h1><?= $nome_classe . 's' ?></h1>
@stop

@include('messages.msgs')

<a href="{{ url('/<?= $nome_classe_min ?>/create') }}" class="btn btn-lg btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i> Novo cadastro</a>
@if($<?= $nome_classe_min ?>s->all())
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
                @foreach($<?= $nome_classe_min ?>s as $<?= $nome_classe_min ?>)
                <tr>
                    <td>
                        <a href="{{ url('/<?= $nome_classe_min ?>/'.$<?= $nome_classe_min ?>->id.'/edit') }}">{{ $<?= $nome_classe_min ?>->id }}</a>
                    </td>
                    <td>
                        <a href="{{ url('/<?= $nome_classe_min ?>/'.$<?= $nome_classe_min ?>->id.'/edit') }}">{{ $<?= $nome_classe_min ?>->id }}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<br /><br />
<p>Não há <?= $nome_classe_min ?>s cadastrados</p>
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

</textarea>

<?php 
}

###################################################################################################
#                                       VIEW FORM                                                 #
###################################################################################################
function make_view_base_form($v) 
{
    extract($v);

    $height = $num_atributos * 160 + 900; //calculando o tamanho do textarea
?>
<textarea id="base_form" style="min-height:<?= $height ?>px" readonly>

@extends('adminlte::page')
@section('content_header')
<h1><?= $nome_classe ?></h1>
@stop

@section('content')
@include('messages.msgs')

<form method='post' action="@if(isset($<?= $nome_classe_min ?>)){{ url('/<?= $nome_classe_min ?>/'.$<?= $nome_classe_min ?>->id) }}@else{{ url('/<?= $nome_classe_min ?>') }}@endif">
    {{ csrf_field() }}
    @if(isset($<?= $nome_classe_min ?>)){{ method_field('patch') }}@endif
    
    <fieldset>
        <?php foreach ($atributos as $atributo) :

            $nome_do_atributo = str_replace('_', ' ', ucfirst($atributo));
            
            echo PHP_EOL . "        <!-- {$nome_do_atributo}  -->" . PHP_EOL;
            ?>
        <div class='form-group {{ $errors->any()?$errors->has('<?= $atributo ?>')?'has-error':'has-success':'' }}'>
            <label class='control-label' for='<?= $atributo ?>'><?= $nome_do_atributo ?></label>
            <input id='<?= $atributo ?>' name='<?= $atributo ?>' type='text' placeholder='<?= $nome_do_atributo ?>' @if(old('<?= $atributo ?>') || isset($<?= $nome_classe_min ?>)) value='@if(old('<?= $atributo ?>')){{ old('<?= $atributo ?>') }}@else{{$<?= $nome_classe_min ?>-><?= $atributo ?>}}@endif'@endif class='form-control input-md' required>
        </div>
        
        <?php endforeach; ?>
        
        <br>
        <div class="clearfix"></div>

        <a href="{{ url( '/<?= $nome_classe_min ?>' )}}" class="btn btn-lg btn-info">
            <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
            Voltar
        </a>
        <button type='submit' class='btn btn-lg btn-primary'>
            <i class="fa fa-floppy-o" aria-hidden="true"></i>
            Salvar
            @if(isset($<?= $nome_classe_min ?>)) Alterações @endif
        </button>
        @if(isset($<?= $nome_classe_min ?>))
            <div class="btn btn-lg btn-danger" onclick="if(confirm('confirmar exclusão?')){document.form_deletar.submit()}">
                <i class="fa fa-trash" aria-hidden="true"></i>
                Deletar
            </div>
        @endif            
    </fieldset>
</form>
@if(isset($<?= $nome_classe_min ?>))
    <form action="{{ url('/<?= $nome_classe_min ?>/'.$<?= $nome_classe_min ?>->id)}}" method="post" name="form_deletar">
        {{ csrf_field() }}
        {{ method_field('delete') }}
    </form>
@endif
@stop

</textarea>
<?php
} // fim de make_view_base_form()