<script>
	$('.show_div').click(function(e) {
		
		/* 	=======================================================
				 	FUNCIÓN PARA BUSCAR LOS PERFILES
			======================================================= */

		const type = $(this).data('type')

		$('#div_principal').hide('slow/400/fast', function(){

			$('#div_image').show()

			$.ajax({
				url: '<?= base_url()."index.php/permiso/buscar_perfiles_ajax" ?>',
				type: 'GET',
				dataType: 'JSON',
				data: {type},
			})
			.done(function(data) {

				let options = '<option selected="" disabled="">Seleccione</option>'

				$.grep(data,function(i,e){

					if(i.activo === 't')
					{
						options+= `<option value="${i.id}">${i.nombre}</option>`
					}
					else
					{
						options+= `<option value="${i.id}">${i.nombre}</option>`	
					}
				})

				$('#perfiles_select').html(options)
				$('#div_image').hide()

				$('#div_oculto').show('slow/400/fast')
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		})
	})

	$('#perfiles_select').change(function(e){

		/* 	=======================================================================
				 	FUNCIÓN PARA BUSCAR LOS MÓDULOS AL ESCOGER UN PERFIL
			======================================================================= */

		const perfil = e.target.value

		$('#div_image').show()

		$.ajax({
			url: '<?= base_url()."index.php/permiso/buscar_modulos_ajax" ?>',
			type: 'GET',
			dataType: 'JSON',
			data: {perfil},
		})
		.done(function(data) {

			$('#div_image').hide()

			$('#div_oculto_modulos').show('slow/400/fast')
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});	
		
	})

	$('.show_permissions').on('click',function(e){
		$('#div_oculto').hide()
		$('#div_oculto_modulos').hide()
		$('#div_principal').show('slow/400/fast')
	})
</script>