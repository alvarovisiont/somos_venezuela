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
					toastr.success('Integrante registrado con éxito', 'Éxito!')
				}
				else
				{
					toastr.error('Ya existe un integrante en el sistema con estos datos', 'Error!')	
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

// ==================================== MODAL DE CENTROS MEDICOS ==============================================


		$('#modal_censados').on('shown.bs.modal', function(e){

			let centro = e.relatedTarget.dataset.centro

			$('#tabla_censados').DataTable().destroy()

			$('#div_image').show()
			$('body').css('opacity',0.5)

			$.ajax({
				url: '<?= base_url()."index.php/censo/censados_modal_centro_medico" ?>',
				type: 'GET',
				dataType: 'JSON',
				data: {centro},
			})
			.done(function(data) {
				
				let html = ''
				$.grep(data, function(i,e){

					let embarazada = i.embarazada === 't' ? 'Si' : 'No'
					let verificado = i.condicion ? i.verificado === 't' ? 'Si' : 'No' : '' 
					let pensionado = ''
					if(i.pensionado !== '')
					{
						pensionado = `<span class='label label-lg label-pink arrowed-in arrowed-in-right'>${i.pensionado}</span>`
					}


					html+= `<tr>
								<td>${i.nombre}</td>
								<td>
									<span class='label label-lg label-success arrowed-in arrowed-in-right'>${i.cedula}</span>
								</td>
								<td>${i.telefono}</td>
								<td>${i.vivienda}</td>
								<td>${pensionado}</td>
								<td>${embarazada}</td>
								<td>${verificado}</td>
								<td>${i.condicion}</td>
								<td>${i.registrador}</td>
							</tr>`

				})

				

				$('#tabla_censados').children('tbody').html(html)
				$('#tabla_censados').dataTable({
					order: [],
					language: {url: "<?= base_url().'assets_sistema/json/esp.json' ?>"}
				})

				$('#div_image').hide()
				$('body').css('opacity',1)

			})
		})

		$('#modal_censados').on('hide.bs.modal',function(e){
			$('#tabla_censados').children('tbody').empty()
		})

// ===================================== CAMBIAR CONSTRASEÑA =============================================

		let password_activo = "<?= $this->session->userdata('bpass') ?>"

		if(password_activo === 'f')
		{
			$('#modal_constraseña').modal('show')
		}

		$('#form_cambiar_contraseña').submit(function(e) {
			e.preventDefault()

			let pass = $('#contraseña').val(),
				new_pass = $('#nueva_contraseña').val()

			if(pass !== new_pass)
			{
				toastr.error('Las Contraseñas no Coinciden','Error!')	
				return false
			}

			$.ajax({
				url: $(this).attr('action'),
				type: 'POST',
				dataType: 'JSON',
				data: {pass},
			})
			.done(function(data) {
				if(data.r)
				{
					toastr.success('Su contraseña ha sido cambiada con éxito','Éxito!')

					$('#modal_constraseña').modal('hide')
				}
				else
				{
					toastr.error('Ha ocurrido un error al cambiar su contraseña','Error!')
				}
			})
		});
	})
</script>