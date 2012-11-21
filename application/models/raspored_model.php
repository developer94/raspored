<?php 

class raspored_model extends CI_Model
{
	function _construct()
	{
		parent::_construct();
		$this->load->helper("smena_helper");
	}
	
	function get_raspored($_odeljenje, $_dan, $_smena, $_grupa, $_skraceni)
	{
		$raspored = $this->db->query("SELECT c.cas, c.mix, c.predmet, c.ucionica, time_format(z.vreme, \"%H:%i\") as vreme FROM casovi AS c INNER JOIN zvona".$_skraceni." AS z ON c.cas = z.cas AND c.mix = z.mix WHERE c.odeljenje = " . $_odeljenje . " AND c.dan = \"" . $_dan . "\" AND c.smena = \"" . $_smena . "\" AND (c.Grupa = 0 or c.Grupa = " . $_grupa . ") ORDER BY vreme ASC");
		return $raspored;
	}
	
	function add_class($odeljenje, $dan, $grupa, $smena, $mix, $cas, $predmet)
	{
		$this->db->query("INSERT INTO casovi (odeljenje, dan, grupa, smena, mix, cas, predmet) VALUES (".$odeljenje.", '".$dan."', ".$grupa.", '".$smena."', '".$mix."', ".$cas.", '".$predmet."')");
	}
	
	function update_cas($_odeljenje, $_dan, $_smena, $_mix, $_cas, $_mix, $_ucionica, $cas_old)
	{
		$this->db->query("UPDATE casovi SET cas=".$_cas." WHERE odeljenje=\"".$_odeljenje."\" AND dan=\"".$dan."\" AND smena=\"".$_smena."\" AND cas=".$_cas_old." AND mix=\"".$_mix."\" AND ucionica=".$_ucionica." AND predmet=\"".$_predmet."\"");
	}
	
	function update_predmet($_odeljenje, $_dan, $_smena, $_cas, $_mix, $_ucionica, $predmet_old)
	{
		$this->db->query("UPDATE casovi SET cas=".$_cas." WHERE odeljenje=\"".$_odeljenje."\" AND dan=\"".$dan."\" AND smena=\"".$_smena."\" AND cas=".$_cas." AND mix=\"".$_mix."\" AND ucionica=".$_ucionica." AND predmet=\"".$_predmet."\"");
	}
	
	function update_mix($_odeljenje, $_dan, $_smena, $_cas, $_mix, $_ucionica, $_mix_old)
	{
		$this->db->query("UPDATE casovi SET cas=".$_cas." WHERE odeljenje=\"".$_odeljenje."\" AND dan=\"".$dan."\" AND smena=\"".$_smena."\" AND cas=".$_cas." AND mix=\"".$_mix."\" AND ucionica=".$_ucionica." AND predmet=\"".$_predmet."\"");
	}
	
	function update_ucionica($_odeljenje, $_dan, $_smena, $_cas, $_mix, $_ucionica, $_ucionica_old)
	{
		$this->db->query("UPDATE casovi SET ucionica=".$_ucionica." WHERE odeljenje=\"".$_odeljenje."\" AND dan=\"".$dan."\" AND smena=\"".$_smena."\" AND cas=".$_cas." AND mix=\"".$_mix."\" AND ucionica=".$_ucionica." AND predmet=\"".$_predmet."\"");
	}
}
?>