$(document).ready(function(){


	$('#formulario').submit(function(){
	event.preventDefault();

	$.ajax({

		url: 'valida.php',
		method: 'POST',
		data: {
				'nome': $('#txtNome').val(),
				'marca': $('#txtMarca').val(),
				'metodo': $('#metodo').val()
				},
		dataType: 'html'
	}).done(function(resposta){
		//Preenche Div Lista
		$('#lista')	.html(resposta)

		//Limpa Campos
		$('#txtNome').val('')
		$('#txtMarca').val('')
		
})
})
})
