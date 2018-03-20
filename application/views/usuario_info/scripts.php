
<script>
	$(function(){

		$('#form_info').submit(function(e) {
			
			let pass = $('#password').val(),
				repeat = $('#password_repeat').val()

			if(pass !== repeat)
			{
				alert('Las contraseñas no coinciden')
				return false
			}

		});

		$('#remove_img').click(function(e) {

			let agree = confirm('Esta seguro que desea borrar su imagen de perfil?')

			if(!agree)
			{
				return false
			}
		});

		$('#btn_activate_img_upload').click(function(e){

			e.preventDefault()
			$('#subir_img').click()
			$('#div_acciones').show('slow/400/fast')
		})

		$('#btn_upload_cancel').click(function(e) {
			$('#div_acciones').hide('slow/400/fast')
		});

		$('#btn_upload_submit').click(function(e) {
			$('#form_foto').submit()
		});
	})
</script>