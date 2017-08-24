<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->model('rack_mod');
		$data = $this->rack_mod->getAll();
		$vars['mods'] = $this->rack_mod->getMods($data);
		$vars['racks'] = $this->rack_mod->getRacks($data);
		$this->load->view('header_view');
		$this->load->view('rack_view', $vars);
		$this->load->view('footer_view');
	}
}
