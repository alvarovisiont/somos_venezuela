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
	})
</script>