<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
    {
    	parent::__construct();
		$this->load->model('UserModel');
		isAdmin();
	}
	public function index()
	{
		$data = [
			'title' => 'Dashboard'
		];

		$this->load->view('admin/dashboard/index', $data);
	}
	public function ham($value='')
	{
		
	}
}
