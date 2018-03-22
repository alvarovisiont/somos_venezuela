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
	<li class="bigger-200 orange">
	 	<i class="ace-icon fa fa-circle"></i>
	 	<?= $this->session->userdata('membrete') ?>
	 	<br>
	</li>

</div><!-- /.page-header -->

<div class="row no-gutters">
    <div class="col-md-12 col-sm-12 pull-right">
    	<button class="btn btn-app btn-purple btn-block">
    		<i class="ace-icon fa fa-users bigger-250"></i>
    		Censo
    		<span class="badge badge-warning badge-left"><?= count($data) ?></span>
    	</button>	
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