<?
	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Verificar extends CI_Controller {
		
		public function __construct()
		{
			parent::__construct();
			//Do your magic here
			$this->load->model(['censomodel']);
		}

		public function no_verificados()
		{
			$datos['data'] = $this->censomodel->no_verificados();

			$this->load->view('dashboard/header');
	        $this->load->view('dashboard/menu');
	        $this->load->view('verificar/no_verificados',$datos);
	        $this->load->view('dashboard/footer');
	        $this->load->view('censo/scripts');
		}
	
	}
	
	/* End of file Verificar.php */
	/* Location: ./application/controllers/Verificar.php */

/* End of file Verificar.php */
/* Location: ./application/controllers/Verificar.php */
?>
