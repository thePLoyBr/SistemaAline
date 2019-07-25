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


	$("#btn_alterar").click(function () {
		$('#metodo').val('alterar');
		
		var form = $('form')[1];
		var formulario = new FormData(form);
		

		if ($('.check').is(':checked') && $('#nomeAlt').val() != '') {
		
			$.ajax	({
			url: 'valida.php',
			method: 'POST',
			data: formulario,
			processData: false,
			contentType: false,
			success: function(data){
				$('#lista').html(data);
				$('#formularioAlterar')[1].reset();
			}
		});
		} else {
			alert('Marque um produto para alterar');
		}

	});

	$('#btn_cadastrar').click(function (e) {
		e.preventDefault();
		$('#metodo').val('cadastrar');
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
	});

	$('#btnChamaModalAlterar').click(function () {
		if (!$('.check').is(':checked')){
			alert('nao selecionado');
		}
	});


});






