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
			var form = $('form')[0];
			var formulario = new FormData(form);
			
			$.ajax	({
				url: 'valida.php',
				method: 'POST',
				data: formulario,
				processData: false,
				contentType: false,
				success: function(data){
					$('#lista').html(data);
					$('#formulario')[0].reset();
				}
			});
		}
	});

	$('#btn_alterar').click(function (e) {
		e.preventDefault();
		if (!$('.check').is(':checked')){
			alert('nao selecionado');
		}

		if ( $('#nomeAlterar').val() == '' || $('#marcaAlterar').val() == '' ){
			alert('Você precisa preencher os campos: NOME e MARCA');
		} else {
			var idAlterar = $('.check:checked').val();
			$("#idAlterar").attr("value", idAlterar);
			var form = $('#formularioAlterar').serialize();
			console.log(form);

			

			console.log(document.getElementById('idAlterar').value);
			
			
			$.ajax	({
				url: 'valida.php',
				method: 'POST',
				data: form,
				
				success: function(data){
					$('#lista').html(data);
					//$('#form')[1].reset();
				}
			});
		}
	});


});






