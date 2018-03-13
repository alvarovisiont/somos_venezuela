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

	$('#perfiles_select').change(function(e) {

		// función al cambiar el perfil en el select

		const id_perfil = e.target.value

		$('#div_image').show()
		$('body').css('opacity',0.5);
		$('#div_oculto_tablas').addClass('hidden').removeClass('animated bounceInUp')

		$('.table').DataTable().destroy()

		$.ajax({
			url: '<?= base_url()."index.php/acceso/buscar_accesos" ?>',
			type: 'GET',
			dataType: 'JSON',
			data: {id: id_perfil ,type: "perfil"},
		})
		.done(function(data) {
			
			let filas = print_table_acceso(data)
			if(filas)
			{

				$('#tabla_acceso').children('tbody').html(filas)

				$('.table').dataTable({
					order: []
				})
			}
			else
			{
				filas = '<tr><td colspan="10">Este elemento no posee accesos del menú asignados</td></tr>'
				$('#tabla_acceso').children('tbody').html(filas)
			}

			

			$('#div_image').hide()
			$('body').css('opacity',1);
			$('#div_oculto_tablas').removeClass('hidden').addClass('animated bounceInUp')
		})
		
	});

	$('#usuario_select').change(function(e) {
		
		// función al cambiar el usuario en el select

		const id_usuario = e.target.value

		$('#div_image').show()
		$('body').css('opacity',0.5);
		$('#div_oculto_tablas').addClass('hidden').removeClass('animated bounceInUp')

		$('.table').DataTable().destroy()

		$.ajax({
			url: '<?= base_url()."index.php/acceso/buscar_accesos" ?>',
			type: 'GET',
			dataType: 'JSON',
			data: {id: id_usuario ,type: "usuario"},
		})
		.done(function(data) {

			let filas = print_table_acceso(data)

			if(filas)
			{

				$('#tabla_acceso').children('tbody').html(filas)

				$('.table').dataTable({
					order: []
				})
			}
			else
			{
				filas = '<tr><td colspan="10">Este elemento no posee accesos del menú asignados</td></tr>'
				$('#tabla_acceso').children('tbody').html(filas)
			}

				

			$('#div_image').hide()
			$('body').css('opacity',1);
			$('#div_oculto_tablas').removeClass('hidden').addClass('animated bounceInUp')
			
		})
	});

	$('#tabla_acceso').children('tbody').on('click','tr td .check_accion',function(e){

		// función al cambiar algún permiso en los checkbox

		let datos  = e.target.value.split('-'),
			type   = $('#tipo_perfil').val(),
			id     = type === 'manuales' ? $('#usuario_select').val() : $('#perfiles_select').val(),
			status = e.target.checked ? true : false

		datos.push(status)

		$.ajax({
			url: '<?= base_url()."index.php/acceso/modificar_acceso" ?>',
			type: 'POST',
			data: {datos,id,type},
		})
		.done(function() {
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	})

	$('.show_permissions').click(function(e) {
		
		$('#tabla_acceso').children('tbody').empty()
		$('#div_oculto').hide()
		$('#div_oculto_tablas').addClass('hidden').removeClass('animated bounceInUp')
		$('#form_perfil')[0].reset()
		$('#div_principal').show('slow/400/fast')
	});

	function print_table_acceso (data) {
		let filas = ''
		if(data.length > 0)
		{
			$.grep(data,function(i,e) {
					
				let crear_checked = i.n_accion === 't' ? 'checked=""' : '',
					modificar_checked = i.m_accion === 't' ? 'checked=""' : '',
					ver_checked = i.v_accion === 't' ? 'checked=""' : '',
					delete_checked = i.e_accion === 't' ? 'checked=""' : '',
					imprimir_checked = i.i_accion === 't' ? 'checked=""' : '',
					activar_checked = i.a_accion === 't' ? 'checked=""' : '',
					reporte_checked = i.r_accion === 't' ? 'checked=""' : ''

				filas += `<tr>
							<td>Modulo</td>
							<td>Área</td>
							<td>${i.nombre}</td>
							<td>
								<label class="">
									<small class="muted smaller-90"></small>
									<input id="id-button-borders" type="checkbox" 
									${crear_checked}
									class="ace ace-switch ace-switch-5 check_accion" 
									name="" value="${i.id_modulo}-n_accion"
									/>
									<span class="lbl middle"></span>
								</label>
							</td>
							<td>
								<label class="">
									<small class="muted smaller-90"></small>
									<input id="id-button-borders" type="checkbox" 
									${modificar_checked}
									class="ace ace-switch ace-switch-5 check_accion" 
									name="" value="${i.id_modulo}-m_accion"
									/>
									<span class="lbl middle"></span>
								</label>
							</td>
							<td>
								<label class="">
									<small class="muted smaller-90"></small>
									<input id="id-button-borders" type="checkbox"
									${ver_checked} 
									class="ace ace-switch ace-switch-5 check_accion" 
									name="" value="${i.id_modulo}-v_accion"
									/>
									<span class="lbl middle"></span>
								</label>
							</td>
							<td>
								<label class="">
									<small class="muted smaller-90"></small>
									<input id="id-button-borders" type="checkbox" 
									${delete_checked}
									class="ace ace-switch ace-switch-5 check_accion" 
									name="" value="${i.id_modulo}-e_accion"
									/>
									<span class="lbl middle"></span>
								</label>
							</td>
							<td>
								<label class="">
									<small class="muted smaller-90"></small>
									<input id="id-button-borders" type="checkbox" 
									${reporte_checked}
									class="ace ace-switch ace-switch-5 check_accion" 
									name="" value="${i.id_modulo}-r_accion"
									/>
									<span class="lbl middle"></span>
								</label>
							</td>
							<td>
								<label class="">
									<small class="muted smaller-90"></small>
									<input id="id-button-borders" type="checkbox" 
									${imprimir_checked}
									class="ace ace-switch ace-switch-5 check_accion" 
									name="" value="${i.id_modulo}-i_accion"
									/>
									<span class="lbl middle"></span>
								</label>
							</td>
							<td>
								<label class="">
									<small class="muted smaller-90"></small>
									<input id="id-button-borders" type="checkbox" 
									${activar_checked}
									class="ace ace-switch ace-switch-5 check_accion" 
									name="" value="${i.id_modulo}-a_accion"
									/>
									<span class="lbl middle"></span>
								</label>
							</td>
						</tr>`
			
				}) // fin grep	
			}
			else
			{
				filas = ``
			}

			return filas
	} // fin función
</script>