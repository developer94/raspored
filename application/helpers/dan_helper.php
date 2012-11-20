<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	if(!function_exists("get_dan"))
	{
		function get_dan()
		{
			$dow = array('Nedelja', 'Ponedeljak', 'Utorak', 'Sreda', 'Cetvrtak', 'Petak', 'Subota');
			return $dow[date('w')];
		}
	}

?>