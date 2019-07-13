<html>
	<head>
	<meta charset="utf-8">
	</head>

	<body>
		<form id="formulario-ajax-form">
			<fieldset>
			<legend>Cadastro</legend>
			<p>
			<label for="txtNome">Nome:</label>
			<input type="text" name="txtNome" id="txtNome"></p>
			<p>
			<label for="txtMarca">Marca:</label>
			<input type="text" name="txtMarca" id="txtMarca"></p>

			<input type="submit" value="enviar">

			<input type="hidden" id="metodo" value="formulario-ajax">
			</fieldset>
		</form>


		<script type="text/javascript" src="formulario.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</body>
</html>