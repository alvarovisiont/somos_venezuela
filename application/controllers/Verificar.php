<?
	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Verificar extends CI_Controller {
		
		public function __construct()
		{
			parent::__construct();
			//Do your magic here
			$this->load->model(['verificarmodel']);
		}

		public function no_verificados()
		{
			$datos['data'] = $this->verificarmodel->no_verificados();

			$this->load->view('dashboard/header');
	        $this->load->view('dashboard/menu');
	        $this->load->view('verificar/no_verificados',$datos);
	        $this->load->view('dashboard/footer');
	        $this->load->view('verificar/scripts');
		}

		public function verificados()
		{
			$datos['data'] = $this->verificarmodel->verificados();

			$this->load->view('dashboard/header');
	        $this->load->view('dashboard/menu');
	        $this->load->view('verificar/index',$datos);
	        $this->load->view('dashboard/footer');
	        $this->load->view('verificar/scripts');
		}

		public function registrar_verificacion()
		{
			$id = $this->input->post('registro');
			$verificar = $this->input->post('verificar');
			$id_medico = $this->session->userdata('id_usuario');

			if($this->verificarmodel->registrar_verificacion($id,$verificar,$id_medico))
			{
				echo json_encode(['r' => true]);
			}
			else
			{
				echo json_encode(['r' => false]);
			}
		}	
	}
	
	/* End of file Verificar.php */
	/* Location: ./application/controllers/Verificar.php */

/* End of file Verificar.php */
/* Location: ./application/controllers/Verificar.php */
?>
