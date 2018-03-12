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

	$('#perfiles_select').change(function(e){

		/* 	=======================================================================
				 	|FUNCIÓN PARA BUSCAR LOS ACCESOS AL ESCOGER UN PERFIL|
			======================================================================= */

		const perfil = e.target.value

		$('#div_image').show()
		$('body').css('opacity',0.5);

		$.ajax({
			url: '<?= base_url()."index.php/permiso/buscar_modulos_ajax" ?>',
			type: 'GET',
			dataType: 'JSON',
			data: {perfil},
		})
		.done(function(data) {

			if(data.length > 0)
			{
				$('input[type="checkbox"]').prop('checked',false)
				$('.div_sub_areas_tab').removeClass('active')
				$('.li_areas').removeClass('active')
				$('.div_visible_modulo').addClass('hidden')
				$('.div_sub_areas').hide()
				$('.div_areas').hide()

				$.grep(data,function(i,e){

					$('input[name="modulos[]"][value="'+i.id_modulo+'"]').prop({
						'checked':true,
						'disabled': true
					})



					$('#div_visible_modulo_'+i.id_modulo).removeClass('hidden')

					let valor = i.visible.toString() === 't' ? true : false

					$('input[name="modulos_visible[]"][value="'+i.id_modulo+'"]').prop('checked',valor)
					
					
					let area = i.id_area
					area = area.replace('{','')
					area = area.replace('}','')
					area = area.split(',')
					
					area.forEach(function(area,index){

						$(`input[name="areas_${i.id_modulo}[]"][value="${area}"]`).prop('checked',true)
						$('#div_areas_'+i.id_modulo).show()

						if(index === 0)
						{
							$('#li_area_'+area).addClass('active')
							$('#'+area).addClass('active')
						}

						$('#div_sub_areas_'+area).show('slow/400/fast')



						let sub_area = i.id_sub_area

						sub_area = sub_area.replace('{','')
						sub_area = sub_area.replace('}','')
						sub_area = sub_area.split(',')

						sub_area.forEach(function(sub_area,index1){
							$(`input[name="sub_areas_${area}[]"][value="${sub_area}"]`).prop('checked',true)
						})

					})
				})
			}
			else
			{
				$('input[type="checkbox"]').prop('checked',false)
				$('.div_sub_areas_tab').removeClass('active')
				$('.li_areas').removeClass('active')
				$('.div_visible_modulo').addClass('hidden')
				$('.div_sub_areas').hide()
				$('.div_areas').hide()

			}

			$('#div_image').hide()
			$('body').css('opacity',1);

			$('#div_oculto_modulos').show('slow/400/fast')
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});	
		
	})

	$('#usuario_select').change(function(e) {
		
		/* 	=======================================================================
				 	|FUNCIÓN PARA BUSCAR LOS ACCESOS AL ESCOGER UN USUARIO|
			======================================================================= */

		let user = e.target.value

		$('#div_image').show()
		$('body').css('opacity',0.5);

		$.ajax({
			url: '<?= base_url()."index.php/permiso/buscar_modulos_ajax_user" ?>',
			type: 'GET',
			dataType: 'JSON',
			data: {user},
		})
		.done(function(data) {

			if(data.length > 0)
			{
				$('input[type="checkbox"]').prop('checked',false)
				$('.div_sub_areas_tab').removeClass('active')
				$('.li_areas').removeClass('active')
				$('.div_visible_modulo').addClass('hidden')
				$('.div_sub_areas').hide()
				$('.div_areas').hide()

				$.grep(data,function(i,e){

					$('input[name="modulos[]"][value="'+i.id_modulo+'"]').prop({
						'checked':true,
						'disabled': true
					})

					$('#div_visible_modulo_'+i.id_modulo).removeClass('hidden')

					let valor = i.visible.toString() === 't' ? true : false

					$('input[name="modulos_visible[]"][value="'+i.id_modulo+'"]').prop('checked',valor)
					
					
					let area = i.id_area
					area = area.replace('{','')
					area = area.replace('}','')
					area = area.split(',')
					
					area.forEach(function(area,index){

						$(`input[name="areas_${i.id_modulo}[]"][value="${area}"]`).prop('checked',true)
						$('#div_areas_'+i.id_modulo).show()

						if(index === 0)
						{
							$('#li_area_'+area).addClass('active')
							$('#'+area).addClass('active')
						}

						$('#div_sub_areas_'+area).show('slow/400/fast')



						let sub_area = i.id_sub_area

						sub_area = sub_area.replace('{','')
						sub_area = sub_area.replace('}','')
						sub_area = sub_area.split(',')

						sub_area.forEach(function(sub_area,index1){
							$(`input[name="sub_areas_${area}[]"][value="${sub_area}"]`).prop('checked',true)
						})

					})
				})
			}
			else
			{
				$('input[type="checkbox"]').prop('checked',false)
				$('.div_sub_areas_tab').removeClass('active')
				$('.li_areas').removeClass('active')
				$('.div_visible_modulo').addClass('hidden')
				$('.div_sub_areas').hide()
				$('.div_areas').hide()


			}

			$('#div_image').hide()
			$('body').css('opacity',1);

			$('#div_oculto_modulos').show('slow/400/fast')
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});


	});

	$('.show_permissions').on('click',function(e){
		/* 	=======================================================================
				 	|FUNCIÓN PARA MOSTRAR LOS TIPOS DE PERFILES DE NUEVO|
			======================================================================= */

		$('#div_oculto').hide()
		$('#div_oculto_modulos').hide()
		$('.div_visible_modulo').addClass('hidden')
		$('#form_perfil')[0].reset()
		$('#div_principal').show('slow/400/fast')
	})

	$('.modulos_visible').click(function(e){
		
		/* 	===================================================================================
				|FUNCIÓN PARA OCULTAR Y DESCHECKEAR TODO LO REFERENTE AL MÓDULO O MOSTRARLOS|
			=================================================================================== */

		let id_modulo = e.target.value

		if(e.target.checked)
		{
			let link = e.target.dataset.link
			if(link.toString() !== 't')
			{
				$('#div_areas_'+id_modulo).show('slow/400/fast')
			}

			$('#div_visible_modulo_'+id_modulo).removeClass('hidden')
			$('input[name="modulos_visible[]"][value="'+id_modulo+'"]').prop('checked',true)
			
		}
		else
		{
			$('#div_areas_'+id_modulo).hide('slow/400/fast')

			$('.div_sub_areas_modulo_'+id_modulo).hide('slow/400/fast')

			$('#div_visible_modulo_'+id_modulo).addClass('hidden')

			$('input[name="modulos_visible[]"][value="'+id_modulo+'"]').prop('checked',false)

			$('.check_modulo_'+id_modulo).each(function(e){
				$(this).prop('checked',false)
			})
		}
	})

	$('.areas_visible').click(function(e){

		/* 	=============================================================================================
				|FUNCIÓN PARA OCULTAR Y DESCHECKEAR TODAS LAS SUB-ÁREAS REFERENTE AL ÁREA O MOSTRARLAS|
			============================================================================================= */

		let id_area = e.target.value

		if(e.target.checked)
		{
			let link = e.target.dataset.link
			if(link.toString() !== 't')
			{
				$('#div_sub_areas_'+id_area).show('slow/400/fast')
			}
		}
		else
		{
			$('#div_sub_areas_'+id_area).hide('slow/400/fast')

			$('.check_area_'+id_area).each(function(e){
				$(this).prop('checked',false)
			})
		}
	})
	
</script>