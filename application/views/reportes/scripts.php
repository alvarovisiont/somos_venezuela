<script>
	$(function($){
		$('#id_municipio').change(function(e) {
			
			let id = e.target.value

			$('#id_parroquia').html('<option disabled="" selected="">Cargando...</option>')

			$.ajax({
				url: '<?= base_url()."index.php/reportes/buscar_parroquias" ?>',
				type: 'GET',
				dataType: 'JSON',
				data: {id},
			})
			.done(function(data) {
				
				let html = '<option disabled="" selected="">Seleccione...</option>'

				$.grep(data, function(i,e){

					html+= `<option value="${i.id}">${i.nombre}</option>`
				})

				$('#id_parroquia').html(html)
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		});
	})
</script>