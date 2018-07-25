<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gerador automático de cruds</title>
    </head>
    <style>
        * {
            font-family: sans-serif;
        }
    </style>
    <body style="background: #cccccc">
        <div style="width: 60%; margin: 15px auto;">
            <h1>Projeto gerador de cruds</h1>

            <h2>
                Adicione o nome da classe e a lista de atributos dela no formulário abaixo e clique em enviar
            </h2>
            <form method="post" action="processar.php">
                <label for="nome" style="font-size: 18pt;">Nome da classe</label><br>
                <input type="text" style="font-size: 18pt; background-color: #000; color:#fff; width: 500px;" id="nome" name="nome"><br><br>

                <label for="atributos" style="font-size: 18pt;">Adicione os atributos da classe separados por virgula ','</label><br><br>
                <textarea rows="10" name="atributos" style="font-size: 18pt; background-color: #000; color:#fff; width: 100%"></textarea><br><br>

                <br /><br />
                <button type="submit" style="width: 250px; height: 100px;font-size: 18pt;">Enviar</button>
            </form>
        </div>
    </body>
</html>
