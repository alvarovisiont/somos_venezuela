<script>
	$(function($){
		$('.verificar').click(function(e){

			let registro = e.target.value,
				verificar = false

			if(e.target.checked)
			{
				verificar = true
			}

			$.ajax({
				url: '<?= base_url()."index.php/verificar/registrar_verificacion" ?>',
				type: 'POST',
				dataType: 'JSON',
				data: {registro, verificar},
			})
			.done(function(data) {
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		})
	})
</script>