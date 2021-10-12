<?php
	//function ganti nama sesuai yang login
	function userData()
	{
		$ci = get_instance();
		$ci->db->where('id =', $ci->session->userdata('id'));
		return $ci->db->get('user')->row();
	}