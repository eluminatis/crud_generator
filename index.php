<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gerador automático de cruds</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    </head>
    <style>
        * {
            /* font-family: sans-serif; */
        }
    </style>
    <body>
        <div class="container">
            <div class="jumbotron">
                <h1 class="display-4">Projeto gerador de cruds</h1>
                <hr class="my-4">
                <p class="lead">
                    Adicione o nome da classe e a lista de atributos dela no formulário abaixo e clique em enviar
                </p>
            </div>

                <form method="post" action="processar.php">

                <div class="form-group">
                    <label for="nome">Nome da classe</label>
                    <input type="text" class="form-control" >
                </div>
                
                <div class="form-group">

                    <label for="atributos">Adicione os atributos da classe separados por virgula '<code>,</code>'</label>
                    <textarea rows="10" name="atributos" class="form-control"></textarea>
                </div>
   
                <button class="btn btn-warning btn-lg btn-block" type="submit">Enviar</button>
            </form>
        </div>
    </body>
</html>
