<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<body style="background: #88dafb">
		<div style="width: 60%; margin: 15px auto;">
			<h1>Projeto ajudante</h1>
			<h2>
				Adicione o nome da classe e a lista de atributos dela no formulario abaixo e clique em enviar
			</h2>
			<form method="post" action="processar.php">
				<label for="nome" style="font-size: 18pt;">Nome da classe (primeira letra maiuscula)</label><br>
				<input type="text" style="font-size: 18pt; background: #ccc;width: 500px;" id="nome" name="nome"><br><br>
				<label for="txt" style="font-size: 18pt;">Adicione os atributos da classe separados por virgula ','</label><br><br>
				<textarea rows="10" name="txt" style="font-size: 18pt; background: #ccc; width: 100%"></textarea><br><br>
				<button type="submit" style="width: 250px; height: 100px;font-size: 18pt;">Enviar</button>
			</form>
		</div>
	</body>
</html>
