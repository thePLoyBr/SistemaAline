<html>
	<head>
	<meta charset="utf-8">
	</head>

	<body>
		
		<form id="formulario">
			<fieldset>
				<legend>Cadastro</legend>
				
				<p>
					<label for="txtNome">Nome:</label>
					<input type="text" id="txtNome" required>
				</p>
				
				<p>
					<label for="txtMarca">Marca:</label>
					<input type="text" id="txtMarca" required>
				</p>
				
				<input type="hidden" id="metodo" value="salvar">
				<input type="submit" value="enviar" onclick="salvar()">
			</fieldset>
		</form>

		<div id="texto"></div>


		<script type="text/javascript" src="formulario.js"></script>
		<script src="js/jquery-3.4.1.min.js"></script>
	</body>
</html>