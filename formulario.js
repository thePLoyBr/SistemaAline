function enviarDados(){
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
}


$(document).ready(function(){
	
	$('#btn_excluir').click(function(){
		$('#metodo').val('excluir')	

		if($('#check').is(':checked')){
			alert('CHECADO')
		}	
		
		enviarDados()
	})

	$('#btn_cadastrar').click(function(){
		alert('boot')
		$('#metodo').val('cadastrar')
		enviarDados()
	})


})


$(document).ready(function () {

    $.ajax({

        url: 'valida.php',
        method: 'POST',
        data: {
           'status': $('#status').val()
        },
        dataType: 'html'
    }).done(function(resposta){

        //Preenche Div Lista
        $('#lista')	.html(resposta)
		//muda status
		$('status').val('')
	})
})