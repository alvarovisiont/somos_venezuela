<script>
	$(function($){

		$('#modal_registradores').on('show.bs.modal', function(e){

			$('#tabla_registradores').DataTable().destroy()

			$('#div_image').show()
			$('body').css('opacity',0.5)

			$.ajax({
				url: '<?= base_url()."index.php/dashboard/registradores_medicos_parroquia_modal" ?>',
				type: 'GET',
				dataType: 'JSON',
				data: {permiso: 9, muni: atob('<?= $municipio ?>'),parro: atob('<?= $parroquia ?>')},
			})
			.done(function(data) {
				
				let html = ''
				$.grep(data, function(i,e){


					html+= `<tr>
								<td>
									${i.nombre}
								</td>
								<td>
									${i.direccion}
								</td>
								<td>
									<span class='label label-lg label-success arrowed-right'>${i.telefono}</span>
								</td>
								<td>
									${i.email}
								</td>
								<td>
									${i.centro}
								</td>
							</tr>`

				})

				

				$('#tabla_registradores').children('tbody').html(html)
				$('#tabla_registradores').dataTable({
					order: [],
					language: {url: "<?= base_url().'assets_sistema/json/esp.json' ?>"}
				})

				$('#div_image').hide()
				$('body').css('opacity',1)

			})
		})

		$('#modal_medicos').on('show.bs.modal', function(e){

			$('#tabla_medicos_y_medicas').DataTable().destroy()

			$('#div_image').show()
			$('body').css('opacity',0.5)

			$.ajax({
				url: '<?= base_url()."index.php/dashboard/registradores_medicos_parroquia_modal" ?>',
				type: 'GET',
				dataType: 'JSON',
				data: {permiso: 8, muni: atob('<?= $municipio ?>'),parro: atob('<?= $parroquia ?>')},
			})
			.done(function(data) {
				
				let html = ''
				$.grep(data, function(i,e){


					html+= `<tr>
								<td>
									${i.nombre}
								</td>
								<td>
									${i.direccion}
								</td>
								<td>
									<span class='label label-lg label-success arrowed-right'>${i.telefono}</span>
								</td>
								<td>
									${i.email}
								</td>
								<td>
									${i.centro}
								</td>
							</tr>`

				})

				

				$('#tabla_medicos_y_medicas').children('tbody').html(html)
				$('#tabla_medicos_y_medicas').dataTable({
					order: [],
					language: {url: "<?= base_url().'assets_sistema/json/esp.json' ?>"}
				})

				$('#div_image').hide()
				$('body').css('opacity',1)

			}) // fin ajax
		}) // fin modal

		$('#modal_censados_municipio').on('show.bs.modal', function(e){

			$('#tabla_censados').DataTable().destroy()

			$('#div_image').show()
			$('body').css('opacity',0.5)

			$.ajax({
				url: '<?= base_url()."index.php/dashboard/censados_parroquia_modal" ?>',
				type: 'GET',
				dataType: 'JSON',
				data: {muni: atob('<?= $municipio ?>'),parro: atob('<?= $parroquia ?>')},
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

			}) // fin ajax
		}) // fin modal
	})
</script>