
$('#formulario-ajax-form').submit(function(e){
	e.preventDefaul();

	$.ajax({
		url: 'valida.php',
		type: 'post',
		dataType: 'html',
		data: {
			'nome': $('#txtNome').val(),
			'marca': $('#txtMarca').val(),
			'metodo':$('#metodo').val(),
		}
	}).done(function(data){
		alert(data);
	})
})