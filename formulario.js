$(document).ready(function () {



	$.ajax({

		url: 'valida.php',
		method: 'POST',
		data: {
			'status': $('#status').val()
		},
		dataType: 'html'
	}).done(function (resposta) {

		//Preenche Div Lista
		$('#lista').html(resposta);
		//muda status
		$('status').val('');
	});

	$("#btn_excluir").click(function () {
		$('#metodo').val('excluir');


		if ($('.check').is(':checked')) {
			var result = $('input:checked').val();
			$.ajax({
				url: 'valida.php',
				method: 'POST',
				data: {
					'id': $('input:checked').val(),
					'metodo': $('#metodo').val(),
				},
				dataType: 'html'
			}).done(function (resposta) {
				$('#lista').html(resposta);
			});
		} else {
			alert('Marque um produto para excluir');
		}

	});

	$('#btn_cadastrar').click(function (e) {
		e.preventDefault();
		if ( $('#nome').val() == '' || $('#marca').val() == '' ){
			alert('Você precisa preencher os campos: NOME e MARCA');
		} else {
			
			var data = new FormData();
			data.append('imagem', $('#imagem')[0].files[0]);
			data.append('metodoCadastrar', $('#metodoCadastrar').val());
			data.append('nome', $('#nome').val());
			data.append('marca', $('#marca').val());
			
			
			console.log(data);
						
			$.ajax	({
				url: 'valida.php',
				method: 'POST',
				data: data,
				processData: false,
				contentType: false,
				success: function(data){
					$('#lista').html(data);
					$('#formularioCadastrar')[0].reset();
				}
			});



			
		}
	});

	$('#btn_alterar').click(function (e) {
		e.preventDefault();
		if (!$('.check').is(':checked')){
			alert('nao selecionado');
		}

		var id = $('.check:checked').val();

		if ( $('#nomeAlterar').val() == '' || $('#marcaAlterar').val() == '' ){
			alert('Você precisa preencher os campos: NOME e MARCA');
		} else {
			var data = new FormData();
			data.append('imagemAlterar', $('#imagemAlterar')[0].files[0]);
			data.append('metodoAlterar', $('#metodoAlterar').val());
			data.append('nomeAlterar', $('#nomeAlterar').val());
			data.append('marcaAlterar', $('#marcaAlterar').val());
			data.append('idAlterar', id);

			console.log(document.getElementById('metodoAlterar'));

			$.ajax	({
				url: 'valida.php',
				method: 'POST',
				data: data,
				processData: false,
				contentType: false,
				success: function(data){
					$('#lista').html(data);
					$('#formularioAlterar')[0].reset();
				}
			});
		}
	});


});






