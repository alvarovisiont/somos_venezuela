<script>
	$(function($){
		$('#btn_mostrar_estructura').click(function(){
			$('#div_tabla').hide('slow/400/fast', function() {
				$('#div_estructura').show('slow/400/fast')
				$('#btn_mostrar_estructura').hide()
				$('#btn_mostrar_tabla').show()
			});
		})

		$('#btn_mostrar_tabla').click(function(){
			$('#div_estructura').hide('slow/400/fast', function() {
				$('#div_tabla').show('slow/400/fast')
				$('#btn_mostrar_tabla').hide()
				$('#btn_mostrar_estructura').show()
			});
		})

		$('#form_estructura').submit(function(e) {
			
			e.preventDefault()
			
			$('#btn_guardar').text('Guardando...')

			$.ajax({
				url: $(this).attr('action'),
				type: 'POST',
				dataType: 'JSON',
				data: $(this).serialize(),
			})
			.done(function(data) {
				if(data.r)
				{
					$('#form_estructura')[0].reset()
					$('#btn_guardar').text('Guardar')
					alert('Registro Agregado con Éxito')
				}
				else
				{
					alert('Ya este registro existe y no ha podido guardarse')
					$('#form_estructura')[0].reset()
					$('#btn_guardar').text('Guardar')
				}
			})
			
		});


		$('#modal_estructura').on('hide.bs.modal',function(){
			window.location.reload()
		})

		$('.editar').click(function(e){


			let x = e.target.dataset.id 
				$('#id_edit').val(x)
				x = e.target.dataset.nombre 
				$('#nombre_estruc').val(x)
				x = e.target.dataset.apellido 
				$('#apellido_estruc').val(x)
				x = e.target.dataset.cedula 
				$('#cedula_estruc').val(x)
				x = e.target.dataset.email 
				$('#email_estruc').val(x)
				x = e.target.dataset.cargo 
				$('#cargo_estruc').val(x)
				x = e.target.dataset.telefono 
				$('#telefono_estruc').val(x)

			$('#modal_editar').modal('show')	
		})

		$('.eliminar').click(function(e){
			let agree = confirm('Esta seguro de querer eliminar este registro?')

			if(agree)
			{
				let id = e.target.dataset.id,
					centro = e.target.dataset.centro

				window.location.href = '<?= base_url()."index.php/censo/estructura_delete/" ?>'+id+'/'+centro
			}
		})
	})
</script>