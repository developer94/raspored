<?php 
class Raspored extends CI_Controller
{
	public function index()
	{
		$data = array();
		
		$this->load->database();
		$this->load->model("raspored_model");
		$this->load->helper("dan_helper");
		
		//$data['dan'] = get_dan();
		$data['dan'] = "Petak";
		$data['raspored'] = $this->raspored_model->get_raspored("409", $data['dan']);
		$this->load->view('raspored_view', $data);
	}
	
	public function dodaj_cas()
	{
		$this->load->view('addclass_view');
	}
	
	public function add()
	{
		$dan 		= $this->input->post('dan');
		$cas 		= $this->input->post('cas');
		$smena 		= $this->input->post('smena');
		$grupa 		= $this->input->post('grupa');
		$predmet 	= $this->input->post('predmet');
		$odeljenje 	= $this->input->post('odeljenje');
		$mix 		= $this->input->post('mix');
		
		$this->db->query("INSERT INTO casovi (odeljenje, dan, grupa, smena, mix, cas, predmet) 
		VALUES (".$odeljenje.", '".$dan."', ".$grupa.", '".$smena."', '".$mix."', ".$cas.", '".$predmet."')");
	}
}
?>