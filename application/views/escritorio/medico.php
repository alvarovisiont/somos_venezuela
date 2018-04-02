<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="#">Sistema</a>
		</li>

		<li>
			<a href="#">Escritorio</a>
		</li>
		<li class="active">Registradores</li>
	</ul><!-- /.breadcrumb -->					
</div>

<div class="page-header text-center">
	<li class="bigger-200 purple">
	 	<i class="ace-icon fa fa-circle"></i>
	 	<?= $this->session->userdata('membrete') ?>
	 	<br>
	</li>

</div><!-- /.page-header -->

<div class="row no-gutters">
    <div class="col-md-12 col-sm-12 pull-right">
    	<button class="btn btn-app btn-purple btn-block" data-tool="tooltip" title="No Verificados">
    		<i class="ace-icon fa fa-users bigger-250"></i>
    		Censados
    		<span class="badge badge-warning badge-left"><?= $total->total ?></span>
    	</button>	
        <?
        if($this->session->userdata('id_permiso') <= '7')
        {
        ?>
            <a href="<?= base_url().'index.php/dashboard/centro_medico/'.$centro ?>" class="btn btn-app btn-pink pull-right" data-tool="tooltip" title="Volver al dashboard de Centro Médico">
                <i class="ace-icon fa fa-undo bigger-250"></i>
                Centro
                <span class="badge badge-warning badge-left"></span>
            </a>
        <?  
        }
        ?>
    </div>
</div>
<br/><br/>
<div class="row no-gutters">	
	<div class="col-md-12 col-sm-12">
		<table class="table table-bordered table-responsive" id="tabla">
			<thead>
				<tr>
					<th class="text-center text-primary" width="12.5%">#</th>
	                <th class="text-center text-primary" width="12.5%">Nombre</th>
	                <th class="text-center text-primary" width="12.5%">Cédula</th> 
	                <th class="text-center text-primary" width="12.5%">Teléfono</th>
	                <th class="text-center text-primary" width="12.5%">Edad</th>                      
	                <th class="text-center text-primary" width="12.5%">Condición</th>
	                <th class="text-center text-primary" width="12.5%">Casa</th>
	                <th class="text-center text-primary" width="12.5%">Verificado</th>
				</tr>
			</thead>
			<tbody class="text-center">
				<?
                $con = 1;

                foreach ($data as $row) 
                {
                    
                    $verificado = !empty($row->verificado) ? 'Si' : 'No';

                    $embarazada = '';

                    $fecha1 = new DateTime($row->fecha_nac);
                    $fecha2 = new DateTime();
                    $diff = $fecha1->diff($fecha2);

                    $edad = $diff->y;

                    $pensionado = '';

                    if(!empty($row->pensionado))
                    {
                        $pensionado = '<span class="label label-sm label-pink arrowed arrowed-right">
                                            Pension: '.$row->pensionado.'
                                        </span>';
                    }

                    echo    "<tr>
                                    <td class='text-center'>{$con}</td>
                                    <td class='text-center'>{$row->nombre} {$row->apellido}</td>
                                    <td class='text-center'>
                                    	<span class='label label-lg label-success arrowed-in arrowed-in-right'>{$row->cedula}</span>
                                    </td>
                                    <td class='text-center'>{$row->telefono}</td>
                                    <td class='text-center'>{$edad} <br/> {$pensionado}</td>
                                    <td class='text-center'>{$row->condicion}</td>
                                    <td class='text-center'>{$row->vivienda}</td>
                                    <td class='text-center'>{$verificado}</td>
                                </tr>";
                    $con++;
                }
            ?>
			</tbody>
		</table>
	</div>
</div>

<!-- =============================== MODAL CAMBIAR CONTRASEÑA ==================================== -->
    
    <div id="modal_constraseña" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header modalHeader">
                    <h4 class="modal-title">Cambiar Contraseña por Defecto&nbsp;<i class="fa fa-pencil"></i></h4>
                </div>
                <form action="<?= base_url().'index.php/usuario/cambiar_contra' ?>" id="form_cambiar_contraseña" method="POST">
                    <div class="modal-body">
                        <div class="row no-gutters">
                            <div class="form-group">
                                <label for="" class="control-label">Contraseña</label>
                                <input type="password" class="form-control" name="contraseña" id="contraseña">
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Nueva Contraseña</label>
                                <input type="password" class="form-control" name="nueva_contraseña" id="nueva_contraseña">
                            </div>
                        </div>
                    </div><!-- fin modal-body -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Cambiar&nbsp;<i class="fa fa-thumbs-up"></i></button>
                    </div>
                </form>
            </div><!-- fin modal-content -->
        </div><!-- fin modal-dialog -->
    </div> <!-- fin modal -->