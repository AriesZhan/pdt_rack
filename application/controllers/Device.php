<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Device extends CI_Controller {

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
		$field_name = $this->uri->segment(3, 0);
		$keyword = $this->uri->segment(4, 0);
		if ($field_name && $keyword) {
			$this->load->model('rack_mod');
			#$vars['devices'] = $this->rack_mod->getDevice('pdt_regression',$field_name, $keyword);
			$vars['devices'] = $this->rack_mod->getDevice('shuang_team',$field_name, $keyword);
			$this->load->view('header_view');
			$this->load->view('device_view', $vars);
			$this->load->view('footer_view');
		}
	}
}
