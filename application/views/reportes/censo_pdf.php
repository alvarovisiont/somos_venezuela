<!DOCTYPE html>
<html lang="en">  
<head>
  <link rel="stylesheet" href="<?php echo base_url();?>assets_sistema/css/bootstrap.min.css">
  <link href="<?php echo base_url()?>assets_sistema/css/ace.min.css" rel="stylesheet" type="text/css">

  <style>

         html {
          margin: 0;
        }
        body {
          font-family: "Arial", serif;
          margin: 20mm 8mm 15mm 8mm;
          background-color: white;
        }

        table {     font-family: "Arial", "Lucida Grande", Sans-Serif;
            font-size: 12px;    margin: 45px;     width: 100%; text-align: center;    border-collapse: collapse; }

        th {     font-size: 13px;     font-weight: bold;     padding: 8px;
            border-top: 4px solid #aabcfe;    border-bottom: 1px solid black; }

        td {    padding: 8px; border-bottom: 1px solid black;
                border-top: 1px solid transparent; }

  </style>
</head>
<title>Censo Reporte pdf</title>
<body>
    
    <div class="text-center">
        Censados del Estado Sucre ¡Somos Venezuela!
    </div>
    <table class="">
        <thead>
            <tr class="">
                <th class="text-center text-primary" width="11.1%">#</th>
                <th class="text-center text-primary" width="11.1%">Nombre</th>
                <th class="text-center text-primary" width="11.1%">Cédula</th> 
                <th class="text-center text-primary" width="11.1%">Teléfono</th>
                <th class="text-center text-primary" width="11.1%">Edad</th>                      
                <th class="text-center text-primary" width="11.1%">Genero</th>
                <th class="text-center text-primary" width="11.1%">Condición</th>
                <th class="text-center text-primary" width="11.1%">Embarazada</th>
                <th class="text-center text-primary" width="11.1%">Verificado</th>
            </tr>
        </thead>
        <tbody>
            <?
                $con = 1;

                foreach ($data as $row) 
                {
                    $embarazada = '';
                    
                    $verificado = $row->verificado === 't' ? 'Si' : 'No';

                    $genero = $row->genero === '1' ? 'Masculino' : 'Femenino';

                    if($genero === 'Femenino')
                    {
                        $embarazada = $row->embarazada === 'f' ? 'No' : 'Si';
                    }

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
                                    <td class='text-center'><span class=''>{$row->cedula}</span></td>
                                    <td class='text-center'>{$row->telefono}</td>
                                    <td class='text-center'>{$edad} <br/> {$pensionado}</td>
                                    <td class='text-center'>{$genero}</td>
                                    <td class='text-center'>{$row->condicion}</td>
                                    <td class='text-center'>{$embarazada}</td>
                                    <td class='text-center'>{$verificado}</td>
                                </tr>";
                    $con++;
                }
            ?>
 
        </tbody>
    </table>
</body>
</html>