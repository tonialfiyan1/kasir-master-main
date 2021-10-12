<?php 
	function isAdmin()
	{
		$ci = get_instance();
		$role = $ci->session->userdata('role');
		if ($role != 'Admin') {
			redirect('auth');
		}
	}
	function isKasir()
	{
		$ci = get_instance();
		$role = $ci->session->userdata('role');
		if ($role != 'Kasir') {
			redirect('auth');
		}
	}
	function do_formal_date($date='',$delimiter = '',$is_day=false)
	{
		if (empty($date)) 
		{
			$date = date('d M Y');
		}

		if (!empty($date)) 
		{
			$day = '';
			if ($is_day) 
			{
				$days = ['Saturday' => 'Sabtu',
								 'Sunday' 	=> 'Minggu', 
								 'Monday' 	=> 'Senin', 
								 'Tuesday'  => 'Selasa', 
								 'Wednesday'=> 'Rabu', 
								 'Thursday' => 'Kamis',
								 'Friday' 	=> 'Jum\'at'];
				$day = $days[date('l', strtotime($date))].', ';
			}
			$months =['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
			$d = date('d', strtotime($date));
			$m = date('m', strtotime($date));
			$y = date('Y', strtotime($date));

			$delimiter = !empty($delimiter) ? $delimiter : ' ';
			return $day.$d.$delimiter.$months[intval($m)].$delimiter.$y;
		}
	}