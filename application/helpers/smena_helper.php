<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	if(!function_exists("get_smena"))
	{
		function get_smena()
		{
			$first_week = date('W', mktime(0, 0, 0, 9, 3, 2012));
			//$last_week = date('W', mktime(0, 0, 0, 12, 31, 2012));
			$smena = 'Poslepodne';
			$kontra_smena = 'Prepodne';
			
			$cur_week = date('W');
			if(abs($first_week - $cur_week + 1) % 2 != 0)
				return $smena;
			else
				return $kontra_smena;
		}
	}
?>