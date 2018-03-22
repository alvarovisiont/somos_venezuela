<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="#">Sistema</a>
		</li>

		<li>
			<a href="#">Censo</a>
		</li>
		<li class=""><a href="#">Vivienda</a></li>
		<li class=""><a href="#">Jefe Familia</a></li>
		<li class=""><a href="#">Carga Familiar</a></li>
		<li class="active">Registrar Carga</li>
	</ul><!-- /.breadcrumb -->					
</div>

<div class="page-header text-center">
	<li class="bigger-200 orange">
	 	<i class="ace-icon fa fa-circle"></i>
	 	<?= $this->session->userdata('membrete') ?>
	 	<br>
	</li>

</div><!-- /.page-header -->

<div class="row no-gutters">	
	<div class="col-md-12 col-sm-12">
		<form action="<?= $ruta ?>" class="form-horizontal" method="POST" id="form_jefe">
			
			<input type="hidden" name="id_registro" value="<?= $edit ? $carga->id : '' ?>">
			<input type="hidden" name="verificado" value="<?= $edit ? $carga->verificado : 0 ?>">
			<input type="hidden" name="id_parentesco" value="2">
			<input type="hidden" name="id_padre" value="<?= $edit ? $carga->id_padre : $id_padre ?>">
			<input type="hidden" name="id_registrador" value="<?= $this->session->userdata('id_usuario') ?>">
			<input type="hidden" name="id_vivienda" value="<?=  $vivienda ?>">
			<input type="hidden" name="createdat" value="<?=  $edit ? $carga->createdat : date('Y-m-d H:i:s',strtotime('-4 hour')) ?>">
			<input type="hidden" name="updatedat" value="<?=  date('Y-m-d H:i:s',strtotime('-4 hour')) ?>">

			<input type="hidden" name="pensionado" id="pensionado" value="<?= $edit ? $carga->pensionado : '' ?>">

			<div class="form-group">
				<!-- nombre y apellido -->
				<label for="nombre" class="control-label col-md-2 col-sm-2">Nombre</label>
				<div class="col-md-4 col-sm-4">
					<input type="text" id="nombre" name="nombre" required="" class="form-control" value="<?= $edit ? $carga->nombre : '' ?>">
				</div>
				<label for="apellido" class="control-label col-md-2 col-sm-2">Apellido</label>
				<div class="col-md-4 col-sm-4">
					<input type="text" id="apellido" name="apellido" required="" class="form-control" value="<?= $edit ? $carga->apellido : '' ?>">
				</div>
			</div>
			<div class="form-group">
				
				<!-- cédula y fecha naci -->

				<label for="cedula" class="control-label col-md-2 col-sm-2">Cédula</label>
				<div class="col-md-4 col-sm-4">
					<input type="number" id="cedula" name="cedula" required="" class="form-control" value="<?= $edit ? $carga->cedula : '' ?>">
				</div>
				<label for="fecha_nac" class="control-label col-md-2 col-sm-2">Fecha Nacimiento</label>
				<div class="col-md-4 col-sm-4">
					<input type="date" id="fecha_nac" name="fecha_nac" required="" class="form-control" value="<?= $edit ? date('Y-m-d', strtotime($carga->fecha_nac)) : '' ?>">
				</div>
			</div>
			<div class="form-group">
				<!-- teléfono y genero -->
				<label for="telefono" class="control-label col-md-2 col-sm-2">Teléfono</label>
				<div class="col-md-4 col-sm-4">
					<input type="text" id="telefono" name="telefono" required="" class="form-control input-mask-phone" value="<?= $edit ? $carga->telefono : '' ?>">
				</div>
				<label for="genero" class="control-label col-md-2 col-sm-2">Genero</label>
				<div class="col-md-4 col-sm-4">
					<select name="genero" id="genero" class="form-control">
						<option <?= $edit ? '' : 'selected=""' ?> disabled="">Seleccione...</option>
						<option value="1" <?= $edit &&  $carga->genero === '1' ? 'selected=""' : '' ?> >Masculino</option>
						<option value="0" <?= $edit &&  $carga->genero === '0' ? 'selected=""' : '' ?> >Femenino</option>
					</select>
				</div>
			</div>
			<div class="form-group" id="div_embarazada_oculto" style="display: <?= $edit &&  $carga->genero === '0' ? 'block' : 'none' ?>">
				<!-- embarazada -->
				<label for="replace1" class="control-label col-md-2 col-sm-2">Embarazada</label>
				<div class="col-md-2 col-sm-2">
					<label for="si_embarazada" class="radio-inline">
						<input type="radio" id="si_embarazada" name="embarazada" value="1" 
						<?= $edit && $carga->embarazada === 't' ? 'checked=""' : '' ?> >
						Si
					</label>
				</div>
				<div class="col-md-2 col-sm-2">
					<label for="no_embarazada" class="radio-inline">
						<input type="radio" id="no_embarazada" name="embarazada" value="0"
						<?= $edit && $carga->embarazada === 'f' ? 'checked=""' : '' ?> 
						>
						No
					</label>
				</div>
			</div>
			<div class="form-group" id="div_pensionado_oculto">
				<!-- pensionado y tipo pensión -->
				<label for="" class="control-label col-md-2 col-sm-2">Pensionado</label>
				<div class="col-md-2 col-sm-2">
					<label for="si_pensionado" class="radio-inline">
						<input type="radio" id="si_pensionado" name="pensionado_check" value="1"
						<?= $edit && !empty($carga->pensionado) ? 'checked=""' : '' ?> 
						>
						Si
					</label>
				</div>
				<div class="col-md-2 col-sm-2">
					<label for="no_pensionado" class="radio-inline">
						<input type="radio" id="no_pensionado" name="pensionado_check" value="0"
						<?= $edit && empty($carga->pensionado) ? 'checked=""' : '' ?> >
						No
					</label>
				</div>
				<label for="" class="control-label col-md-2 col-sm-2 <?= $edit && !empty($carga->pensionado) ? '' : 'hidden' ?>" id="label_tipo_pension">Tipo Pensión</label>
				<div class="col-md-4 col-sm-4 <?= $edit && !empty($carga->pensionado) ? '' : 'hidden' ?> " id="div_tipo_pension">

					<select id="pensionado_select" class="form-control">
						<option <?= $edit && !empty($carga->pensionado) ? '' : 'selected=""' ?>  disabled="">Seleccione...</option>
						<option value="Ivss" <?= $edit && $carga->pensionado === 'Ivss' ? 'selected=""' : '' ?> >Ivss</option>
						<option value="Amor Mayor" <?= $edit && $carga->pensionado === 'Amor Mayor' ? 'selected=""' : '' ?> >Amor Mayor</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<!-- condición -->
				<label for="" class="control-label col-md-2 col-sm-2">Condición</label>
				<div class="col-md-4 col-sm-4">
					<textarea name="condicion" id="condicion" class="form-control" rows="2"><?= $edit ? $carga->condicion : '' ?></textarea>
				</div>
				<label for="" class="control-label col-md-2 col-sm-2">Parentesco</label>
				<div class="col-md-4 col-sm-4">
					<select name="id_parentesco" id="id_parentesco" class="form-control" required="">
						<option value="" disabled="" selected="">Seleccione</option>
						<?
							foreach ($parentescos as $row) 
							{
								if($edit && $row->id === $carga->id_parentesco)
								{
									echo '<option value="'.$row->id.'" selected="">'.$row->nombre.'</option>';
								}
								else
								{
									echo '<option value="'.$row->id.'">'.$row->nombre.'</option>';	
								}
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class=" col-md-offset-4 col-sm-offset-4 col-md-4 col-sm-4">
					<button type="submit" class="btn btn-pink btn-block">Guardar&nbsp;<i class="fa fa-check"></i></button>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-4 col-sm-4 col-sm-offset-4 col-md-offset-4">
					<a href="<?= base_url().'index.php/censo/carga_familiar/'.base64_encode($id_padre).'/'.base64_encode($vivienda) ?>" class="btn btn-default btn-block">Volver a Carga Familiar&nbsp;<i class="fa fa-users"></i></a>
				</div>
			</div>
		</form>
	</div>
</div>