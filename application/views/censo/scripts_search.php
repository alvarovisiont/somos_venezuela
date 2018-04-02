<script src="<?php echo base_url()?>assets_sistema/js/toastr.min.js"></script>

<script>
	$(function($){
		$('#form_buscar').submit(function(e) {
			
			e.preventDefault()

			$('#div_image').show()
			$('body').css('opacity',0.5)

			$.ajax({
				url: '<?= base_url()."index.php/censo/buscar_familia" ?>',
				type: 'GET',
				dataType: 'JSON',
				data: $(this).serialize(),
			})
			.done(function(data) {
				if(data.length > 0)
				{
					let html = ''

					$.grep(data,function(i,e){

						let genero = i.genero === '1' ? 'Masculino' : 'Femenino'
						let embarazada = genero === 'Masculino' ? '' : i.embarazada === 'f' ? 'No' : 'Si'

						let verificado = i.condicion !== '' ? i.verificado === 't' ? 'Si' : 'No' : ''

						html+= `<tr>
									<td>${i.nombre} ${i.apellido}</td>
									<td><span class="label label-md label-success arrowed arrowed-right">${i.cedula}</span></td>
									<td>${i.telefono}</td>
									<td>${i.condicion}</td>
									<td>${i.vivienda}</td>
									<td>${verificado}</td>
									<td><span class="label label-md label-primary arrowed arrowed-right">${i.nivel}</span></td>
								</tr>`
					})

					$('#tabla_familia').children('tbody').html(html)
					

				}
				else
				{
					$('#tabla_familia').children('tbody').empty()
					toastr.error('No se encontraron registros coincidentes', 'Lo sentimos!')	
					
				}
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				$('#div_image').hide()
				$('body').css('opacity',1)
			});
			
		});
	})
</script>