<?php
class Login extends CI_Controller
{
	public function index()
	{
		$this->load->view('login_view');
	}
	
	public function check_user()
	{
		$user = $this->input->post('user');
		$pass = $this->input->post('pass');
		
		if($user == "testmin" && $pass == "youshallnotpass")
		{
			$ses_data = $this->session->all_userdata();
			$ses_data['auth'] = true;
			$this->session->set_userdata($ses_data);
			$this->output->set_output('Welcome home.');
		}
		else
		{
			$ses_data = $this->session->all_userdata();
			$ses_data['auth'] = false;
			$this->session->set_userdata($ses_data);
			$this->output->set_output('User authorization failed.');
		}
	}	
}