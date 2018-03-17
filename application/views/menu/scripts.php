<script>

	$('.eliminar').click(function(e){
		let agree = confirm('Esta seguro de querer eliminar este registro? Ten en cuenta que eliminaras todo lo relacionado'),
		id    = e.target.dataset.eliminar,
		ruta  = '<?= base_url()."index.php/menu/destroy/" ?>' + id

		if(agree)
		{
			window.location.replace(ruta)
		}
	})

	$('input[name="link"]').click(function(e){
		let value = e.target.value

		if(parseInt(value) === 1)
		{
			$('#ruta_oculta').show('slow/400/fast',function(){
				
				document.getElementById('ruta_area').setAttribute('required',true)
			})	
		}
		else
		{
			$('#ruta_oculta').hide('slow/400/fast',function(){
				document.getElementById('ruta_area').removeAttribute('required')
				document.getElementById('ruta_area').value = ''
			})	
		}
	})

	$('#modal_area').on('show.bs.modal',function(e){
		let padre = e.relatedTarget.dataset.modulo,
			edit  = e.relatedTarget.dataset.edit

		document.getElementById('id_padre_area').value = padre

		let ruta = ''

		if(!!edit)
		{
			ruta = '<?= base_url()."index.php/menu/update/" ?>'+edit
			let nombre = e.relatedTarget.dataset.nombre,
				link = e.relatedTarget.dataset.link,
				ruta_input = e.relatedTarget.dataset.ruta

			document.getElementById('nombre_area').value = nombre

			if(link === 't')
			{
				document.getElementById('ruta_oculta').style.display = 'block'
				document.getElementById('ruta_area').value = ruta_input

			}

			if(link === 't')
			{
				
				$('input[name="link"][value="1"]').prop('checked',true)
			}
			else
			{
				$('input[name="link"][value="0"]').prop('checked',true)
			}
		}
		else
		{
			ruta = '<?= base_url()."index.php/menu/store" ?>'
		}

		document.getElementById('form_area').removeAttribute('action')
		document.getElementById('form_area').setAttribute('action',ruta)

	})

	$('#modal_area').on('hidden.bs.modal',function(){
		$('#form_area')[0].reset()
	})

	$('#modal_sub_area').on('show.bs.modal',function(e){
		let area = e.relatedTarget.dataset.area,
			edit  = e.relatedTarget.dataset.edit

		document.getElementById('id_padre_sub_area').value = area

		let ruta = ''

		if(!!edit)
		{
			ruta = '<?= base_url()."index.php/menu/update/" ?>'+edit
			let nombre = e.relatedTarget.dataset.nombre,
				ruta_input = e.relatedTarget.dataset.ruta

			document.getElementById('nombre_sub_area').value = nombre
			document.getElementById('ruta_sub_area').value   = ruta_input 
		}
		else
		{
			ruta = '<?= base_url()."index.php/menu/store" ?>'
		}

		document.getElementById('form_sub_area').removeAttribute('action')
		document.getElementById('form_sub_area').setAttribute('action',ruta)

	})

	$('#modal_sub_area').on('hidden.bs.modal',function(){
		$('#form_sub_area')[0].reset()
	})



</script>