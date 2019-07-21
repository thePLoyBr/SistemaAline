function enviarDados(){
	$('#formulario').submit(function(){
		event.preventDefault();

		$.ajax({

			url: 'valida.php',
			method: 'POST',
			data: {
					'nome': $('#txtNome').val(),
					'marca': $('#txtMarca').val(),
					'metodo': $('#metodo').val(),
					},
			dataType: 'html'
		}).done(function(resposta){
			//Preenche Div Lista
			$('#lista')	.html(resposta);

			//Limpa Campos
			$('#txtNome').val('');
			$('#txtMarca').val('');
		});
	});
}


$(document).ready(function(){

		$.ajax({

			url: 'valida.php',
			method: 'POST',
			data: {
			   'status': $('#status').val()
			},
			dataType: 'html'
		}).done(function(resposta){
	
			//Preenche Div Lista
			$('#lista')	.html(resposta);
			//muda status
			$('status').val('');
		});

		$("#btn_excluir").click(function(){
			$('#metodo').val('excluir');


			if($('.check').is(':checked')){
				var result = $('input:checked').val();
				$.ajax({
					url: 'valida.php',
					method: 'POST',
					data: {
							'id': $('input:checked').val(),
							'metodo': $('#metodo').val(),
							},
					dataType: 'html'
				}).done(function(resposta){
					$('#lista').html(resposta);
				});
			} else {
				alert('Marque um produto para excluir');
			}
			
		});


		$("#btn_alterar").click(function(){
			$('#metodo').val('alterar');


			if($('.check').is(':checked')){
				var result = $('input:checked').val();
				$.ajax({
					url: 'valida.php',
					method: 'POST',
					data: {
							'id': $('input:checked').val(),
							'nome': $('#txtNome').val(),
							'marca': $('#txtMarca').val(),
							'metodo': $('#metodo').val()
							},
					dataType: 'html'
				}).done(function(resposta){
					$('#lista').html(resposta);
				});
			} else {
				alert('Marque um produto para alterar');
			}
			
		});

	$('#btn_cadastrar').click(function(){
		$('#metodo').val('cadastrar');
		enviarDados();
	});
});