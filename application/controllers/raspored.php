<?php 
class Raspored extends CI_Controller
{
	public function index($grupa = 1, $odeljenje = 409, $dan = NULL, $smena = NULL)
	{
		$data = array();
		
		$this->load->database();
		$this->load->model("raspored_model");
		
		if($dan == NULL)
			$data['dan'] = get_dan();
		else
			$data['dan'] = $dan;
		
		if($smena == NULL)
			$data['smena'] = get_smena();
		else
			$data['smena'] = $smena;

		$data['odeljenje'] = $odeljenje;
		$data['grupa'] = $grupa;
			
		//$data['smena'] = "Poslepodne";
			
		$data['raspored'] = $this->raspored_model->get_raspored($data['odeljenje'], $data['dan'], $data['smena'], $data['grupa']);
		$this->load->view('raspored_view', $data);
	}
	
	public function dodaj_cas()
	{
		if($this->session->userdata('auth') == true)
		{
			$this->load->view('addclass_view');
		}
		else
		{
			$this->load->view('authfailed_view');
		}
	}
	
	public function izmeni($grupa = NULL, $odeljenje = NULL, $dan = NULL, $smena = NULL)
	{
		if($this->session->userdata('auth') == true)
		{
			$data = array();
					
			$this->load->database();
			$this->load->model("raspored_model");
			
			if($odeljenje == NULL)
				$data['odeljenje'] = 409;
			else
				$data['odeljenje'] = $odeljenje;
			
			if($dan == NULL)
				$data['dan'] = get_dan();
			else
				$data['dan'] = $dan;
			
			if($smena == NULL)
				$data['smena'] = get_smena();
			else
				$data['smena'] = $smena;
				
			if($grupa == NULL)
				$data['grupa'] = 1;
			else
				$data['grupa'] = $grupa;
			
			$data['raspored'] = $this->raspored_model->get_raspored($odeljenje, $data['dan'], $data['smena'], $data['grupa']);
			$this->load->view('izmeni_view', $data);
		}
		else
		{
			$this->load->view('authfailed_view');
		}
	}
	
	public function add()
	{
		if($this->session->userdata('auth') == true)
		{
			$dan 		= $this->input->post('dan');
			$cas 		= $this->input->post('cas');
			$smena 		= $this->input->post('smena');
			$grupa 		= $this->input->post('grupa');
			$predmet 	= $this->input->post('predmet');
			$odeljenje 	= $this->input->post('odeljenje');
			$mix 		= $this->input->post('mix');
			
			$this->load->model('raspored_model');		
			$this->raspored_model->add_class($odeljenje, $dan, $grupa, $smena, $mix, $cas, $predmet);
			
			echo "Predmet je dodat!";
		}
		else
		{
			$this->load->view('auth');
		}
	}
	
	public function update_cas($_odeljenje, $_dan, $_smena, $_mix, $_cas, $_mix, $_ucionica, $cas_old)
	{
		$this->load->model('raspored_model');
		$this->raspored_model->update_cas($_odeljenje, $_dan, $_smena, $_mix, $_cas, $_mix, $_ucionica, $cas_old);
	}
	
	public function update_predmet($_odeljenje, $_dan, $_smena, $_cas, $_mix, $_ucionica, $predmet_old)
	{
		$this->load->model('raspored_model');
		$this->raspored_model->update_predmet($_odeljenje, $_dan, $_smena, $_cas, $_mix, $_ucionica, $predmet_old);
	}
	
	public function update_ucionica($_odeljenje, $_dan, $_smena, $_cas, $_mix, $_ucionica, $_ucionica_old)
	{
		$this->load->model('raspored_model');
		$this->raspored_model->update_ucionica($_odeljenje, $_dan, $_smena, $_cas, $_mix, $_ucionica, $_ucionica_old);
	}
	
	public function update_mix($_odeljenje, $_dan, $_smena, $_cas, $_mix, $_ucionica, $_mix_old)
	{
		$this->load->model('raspored_model');
		$this->raspored_model->update_mix($_odeljenje, $_dan, $_smena, $_cas, $_mix, $_ucionica, $_mix_old);
	}
	
	public function overview($_grupa = '1', $_odeljenje = '409', $_smena = 'Prepodne')
	{
		$data = array();
		$this->load->database();
		$this->load->model('raspored_model');
		$data['smena']= $_smena;
		$data['grupa']= $_grupa;
		$data['odeljenje'] = $_odeljenje;
		$data['raspored']= $this->raspored_model->get_overview($data['smena'], $data['grupa'], $data['odeljenje']);
		$this->load->view('overview_view', $data);
	}
}
?>