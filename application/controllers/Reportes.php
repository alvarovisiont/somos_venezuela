<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model(['reportemodel']);
	}

	public function censo()
	{
		$datos = ['municipios' => $this->reportemodel->buscar_municipios()];

		$this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('reportes/censo',$datos);
        $this->load->view('dashboard/footer');
        $this->load->view('reportes/scripts');
	}

	public function buscar_parroquias()
	{
		$id = $this->input->get('id');

		echo json_encode($this->reportemodel->buscar_parroquias($id));
	}

	public function show_censo_pdf()
	{
		$where = '';

		if(isset($_POST['cedula']))
		{
			if(!empty($_POST['cedula']))
			{
				if(!empty($where))
				{
					$where.= " AND CAST(c.cedula as varchar) like '%".$_POST['cedula']."%'";
				}
				else
				{
					$where= "WHERE CAST(c.cedula as varchar) like '%".$_POST['cedula']."%'";
				}
			}
				
		}


		if(isset($_POST['hasta']))
		{
			if(!empty($_POST['hasta']))
			{
				if(!empty($where))
				{
					$where.= " AND c.fecha_nac <= '".$_POST['hasta']."'";
				}
				else
				{
					$where= "WHERE c.fecha_nac <= '".$_POST['hasta']."'";
				}
			}
				
		}

		if(isset($_POST['desde']))
		{
			if(!empty($_POST['desde']))
			{
				if(!empty($where))
				{
					$where.= " AND c.fecha_nac >= '".$_POST['desde']."'";
				}
				else
				{
					$where= "WHERE c.fecha_nac >= '".$_POST['desde']."'";
				}
			}
				
		}

		if(isset($_POST['genero']))
		{
			
			if(!empty($where))
			{
				$where.= " AND c.genero = ".$_POST['genero'];
			}
			else
			{
				$where = "WHERE c.genero = ".$_POST['genero'];
			}
		}

		if(isset($_POST['embarazada']))
		{
			
			if(!empty($where))
			{
				$where.= " AND c.embarazada = '".$_POST['embarazada']."'";
			}
			else
			{
				$where = "WHERE c.embarazada = '".$_POST['embarazada']."'";
			}
		}


		if(isset($_POST['verificado']))
		{
			
			if(!empty($where))
			{
				$where.= " AND c.verificado = '".$_POST['verificado']."'";
			}
			else
			{
				$where = "WHERE c.verificado = '".$_POST['verificado']."'";
			}
		}

		if(isset($_POST['condicion']))
		{
			if(!empty($_POST['condicion']))
			{
				if(!empty($where))
				{
					$where.= " AND LOWER(c.condicion) like LOWER('%".$_POST['condicion']."%')";
				}
				else
				{
					$where = "WHERE LOWER(c.condicion) like LOWER('%".$_POST['condicion']."%')";
				}
			}	
		}

		if(isset($_POST['pensionado']))
		{
			if(!empty($where))
			{
				$where.= " AND c.pensionado <> ''";
			}
			else
			{
				$where = "WHERE c.pensionado <> ''";
			}
		}

		if(isset($_POST['id_municipio']))
		{
			if($_POST['id_municipio'] === '1')
			{
				if(!empty($where))
				{
					$where.= " AND u.id_municipio = ".$_POST['id_municipio'];
				}
				else
				{
					$where = "WHERE u.id_municipio = ".$_POST['id_municipio'];
				}
			}
				
		}

		if(isset($_POST['id_parroquia']))
		{
			if($_POST['id_parroquia'] === '1')
			{
				if(!empty($where))
				{
					$where.= " AND u.id_parroquia = ".$_POST['id_parroquia'];
				}
				else
				{
					$where = "WHERE u.id_parroquia = ".$_POST['id_parroquia'];
				}
			}
				
		}
		//echo $where;
		//exit();
		$this->output_pdf($where);
	}

	private function output_pdf($where)
	{
		//load mPDF library
		$this->load->library('m_pdf'); 
		

		$data['data'] = $this->reportemodel->datos_pdf($where);
		$html=$this->load->view('reportes/censo_pdf',$data, true);
		
		$pdfFilePath ="censo-".date('Y-m-d').".pdf";		
		
		$this->m_pdf->pdf->addPage('L');
		$this->m_pdf->pdf->WriteHTML($html);
		

		$this->m_pdf->pdf->Output($pdfFilePath, "D");
		exit;
	}

}

/* End of file Reportes.php */
/* Location: ./application/controllers/Reportes.php */
?>
