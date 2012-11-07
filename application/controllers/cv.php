<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CV extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('CVModel');
	}

	public function index() {
		$this->load->view('template_view');
	}
	
	public function printable() {
		$viewData = array();
		$this->load->view('printable_view');
	}
	
	public function category() {
		if ($this->uri->segment(3) === false)
			$this->load->view('category_view');
		else {
			$viewData = array('data' => $this->CVModel->loadCategory($this->uri->segment(3)));
			$this->load->view('json_view', $viewData);
		}
	}
	
	public function jobdetail() {
		if ($this->uri->segment(3) === false)
			$this->load->view('jobDetail_view');
		else {
			$viewData['data'] = array(
				'occupations' => $this->CVModel->loadOccupation($this->uri->segment(3)),
				'items' => $this->CVModel->loadOccupationMetaCategory($this->uri->segment(3), $this->uri->segment(4))
			);
			$this->load->view('json_view', $viewData);
		}
	}
		
	public function printData() {
		$viewData = array();
		$viewData['data'] = array(
			'occupations' => $this->CVModel->loadOccupations(),
			'refs' => $this->CVModel->loadMetaCategory('References'),
                        'projects' => $this->CVModel->loadProjects(),
			'achievements' => $this->CVModel->loadMetaCategory('Achievements')
		);
		$this->load->view('json_view', $viewData);
	}
	
	public function about() {
		$this->load->view('about_view');
	}
	
	public function search() {
		if ($this->uri->segment(3) === false)
			$this->load->view('search_view');
		else {
			$viewData = array();
			$viewData['data'] = $this->CVModel->search($this->uri->segment(3));
			$this->load->view('json_view', $viewData);
		}
	}
	
	public function project() {
		if ($this->uri->segment(3) === false)
			$this->load->view('project_view');
		else {
			$project = $this->CVModel->loadProject($this->uri->segment(3));
			$viewData['data'] = array('project' => $project[0], 'items' => '');
			if ($this->uri->segment(4) !== false)
				 $viewData['data']['items'] = $this->CVModel->loadProjectMetaCategory($this->uri->segment(3), $this->uri->segment(4));
			$this->load->view('json_view', $viewData);
		}
	}
}