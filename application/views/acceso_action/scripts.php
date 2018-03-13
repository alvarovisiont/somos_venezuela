<script>
	$('.show_div').click(function(e) {
		
		/* 	================================================
				 	|FUNCIÓN PARA BUSCAR LOS PERFILES|
			================================================ */

		const type = $(this).data('type')

		$('#tipo_perfil').val(type)

		$('#div_principal').hide('slow/400/fast', function(){

			$('#div_image').show()
			$('body').css('opacity',0.5);

			$.ajax({
				url: '<?= base_url()."index.php/permiso/buscar_perfiles_ajax" ?>',
				type: 'GET',
				dataType: 'JSON',
				data: {type},
			})
			.done(function(data) {

				let options = ''

				let options_users
				if(type === 'manuales')
				{

					$.grep(data.perfiles,function(i,e){

						options+= `<option value="${i.id}">${i.nombre}</option>`
					})
					
					options_users = '<option disabled="" selected="">Seleccione Usuario</option>'

					$.grep(data.usuarios, function(i,e){
						options_users+= `<option value="${i.id}">${i.login}</option>`
					})

					$('#div_select_usuarios').show()
					$('#usuario_select').html(options_users)
						
				}
				else
				{
					options = '<option selected="" disabled="">Seleccione</option>'

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

					$('#div_select_usuarios').hide()
					$('#usuario_select').html('')
				}
					

				$('#perfiles_select').html(options)
				$('#div_image').hide()
				$('body').css('opacity',1);

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
</script>