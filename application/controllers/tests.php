<?php
class Tests extends CI_Controller
{
	function json()
	{
		$data = $this->input->post('array');
		//$obj = json_decode($data[0]);
		echo $data[0]["key3"];
	}
}

?>