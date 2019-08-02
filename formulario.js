function escutarCheckbox(){

	$(".check").change(function(){
		var id = $(this).val();
		$.ajax({
			url: 'valida.php',
			method: 'POST',
			data: {
				'id': id,
				'metodo': 'usado',
			},
			dataType: 'html'
		}).done(function (resposta) {
			$('#lista').html(resposta);
			escutarCheckbox();
			escutarExcluir();
		});
	
});
}

function escutarExcluir(){

	$(".modalExcluir").click(function(){
		var id = $(this).val();
		var name =$(this).attr('name');
		$('.corpoExcluir').html('<p> Deseja excluir o produto? </p> <p>'+ name +'</p>');

		if($('#btnExcluir').click(function(){
				$('#linha').val(id).hide();
		}));
			// $.ajax({
			// 	url: 'valida.php',
			// 	method: 'POST',
			// 	data: {
			// 		'id':id,
			// 		'metodo': 'excluir',
			// 	},
			// 	dataType: 'html'
			// }).done(function (resposta) {
			// 	$('#lista').html(resposta);
			// 	escutarCheckbox();
			// 	escutarExcluir();
			// });
		

		
	
	});
}

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
		escutarCheckbox();
		escutarExcluir();
	});
				
	$('#btn_cadastrar').click(function (e) {
		e.preventDefault();
		if ( $('#nome').val() == '' || $('#marca').val() == '' ){
			alert('Você precisa preencher os campos: NOME e MARCA');
		} else {
			
			var data = new FormData();
			data.append('imagem', $('#imagem')[0].files[0]);
			data.append('metodo', 'cadastrar');
			data.append('nome', $('#nome').val());
			data.append('marca', $('#marca').val());
			data.append('estado', '0');
			
			
			$.ajax	({
				url: 'valida.php',
				method: 'POST',
				data: data,
				processData: false,
				contentType: false,
				success: function(data){
					$('#lista').html(data);
					$('#formularioCadastrar')[0].reset();
					escutarCheckbox();
					escutarExcluir();
				}
			});
		}
	});




	$('#btnChamaModalAlterar').click(function(e){
		if (!$('.check').is(':checked')){
			alert('Selecione o produto que deseja alterar');
			return false;
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
			data.append('metodo', 'alterar');
			data.append('nomeAlterar', $('#nomeAlterar').val());
			data.append('marcaAlterar', $('#marcaAlterar').val());
			data.append('idAlterar', id);
			
			
			$.ajax	({
				url: 'valida.php',
				method: 'POST',
				data: data,
				processData: false,
				contentType: false,
				success: function(data){
					$('#lista').html(data);
					$('#formularioAlterar')[0].reset();
					escutarCheckbox();
					escutarExcluir();
				}
			});
		}
	});


});  
  



