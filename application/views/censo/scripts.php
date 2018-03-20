<script>
	$(function(){


		$('input[name="tipo_vivienda"]').click(function(e){

			// ========== |creación de la vivienda| ================= //

			if(e.target.value === '0')
			{
				$('#piso').prop({
					disabled: false,
					required: true
				})
			}
			else
			{
				$('#piso').prop({
					disabled: true,
					required: false
				})
			}
		})

		$('.eliminar').click(function(){

			// ========== |Eliminar cualquier registro del censo| ================= //

			let agree = confirm('Esta seguro de querer eliminar este registo?')

			if(!agree)
			{
				return false
			}

		})

		$('#genero').change(function(e){
			
			let val = e.target.value

			if(val === '0')
			{
				$('#div_embarazada_oculto').show('slow/400/fast')
				$('input[name="embarazada"]').prop('required',true)
			}
			else
			{
				$('#div_embarazada_oculto').hide('slow/400/fast')	
				$('input[name="embarazada"]').prop('required',false)
			}

		})

		$('input[name="pensionado_check"]').click(function(e) {
			
			if(e.target.value === '1')
			{
				
				$('#label_tipo_pension').removeClass('hidden')
				$('#div_tipo_pension').removeClass('hidden')

				$('#pensionado_select').prop('required',true)
			}
			else
			{

				$('#label_tipo_pension').addClass('hidden')
				$('#div_tipo_pension').addClass('hidden')

				$('#pensionado_select').prop('required',false)

				$('#pensionado').val('')
			}
		});

		$('#pensionado_select').change(function(e) {
			
			$('#pensionado').val(e.target.value)
		});
	})
</script>