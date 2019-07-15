function salvar(){

$('#formulario').submit(function(){
	event.preventDefault();
})

$.ajax({

		url: 'valida.php',
		method: 'POST',
		data: {
				'nome': $('#txtNome').val(),
				'marca': $('#txtMarca').val(),
				'metodo': $('#metodo').val()
				}
	}).done(function(resposta){
		$('#texto')	.text("DIV:   "+resposta)
					.css("background", "#f66")
})


}