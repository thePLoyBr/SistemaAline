<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<script src="_js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="formulario.js"></script>
	<link rel="stylesheet" type="text/css" href="_css/estilo.css">
	</head>

	<body>

		<form id="formulario">
			<fieldset>
				<legend>Cadastro</legend
				
				<p>
					<label for="txtNome">Nome:</label>
					<input type="text" id="txtNome" required>
				</p>
				
				<p>
					<label for="txtMarca">Marca:</label>
					<input type="text" id="txtMarca" required>
				</p>
				
				<input type="hidden" id="metodo" value="salvar">
				<input type="submit" value="enviar">
			</fieldset>
		</form>

		<div id="lista"></div>

        <input type="hidden" value="online" id="status">
		
	</body>
</html>