<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	 public function __construct()
	 	{
	 		parent::__construct();
			$this->load->helper('url');
	 		$this->load->model('book_model');
	 	}


	public function index()
	{

		$data['books']=$this->book_model->get_all_books();
		$this->load->view('book_view',$data);
	}
	public function book_add()
		{
			$data = array(
					'phone' => $this->input->post('phone'),
					'other_names' => $this->input->post('other_names'),
					'surname' => $this->input->post('surname'),
					'gender' => $this->input->post('gender'),
					'department' => $this->input->post('department'),
					'member_status' => $this->input->post('member_status'),
					'address' => $this->input->post('address'),
					'occupation' => $this->input->post('occupation'),
					'email' => $this->input->post('email'),
					'state' => $this->input->post('state'),
					'lga' => $this->input->post('lga'),
					'home_town' => $this->input->post('home_town'),
					'marital_status' => $this->input->post('marital_status'),
					'year_joined' => $this->input->post('year_joined'),
					'nok' => $this->input->post('nok'),
					'nok_phone' => $this->input->post('nok_phone'),
					'nok_addr' => $this->input->post('nok_addr'),
					'status' => $this->input->post('status'),
					'bday' => $this->input->post('bday'),
					'bmonth' => $this->input->post('bmonth'),

				);
			$insert = $this->book_model->book_add($data);
			echo json_encode(array("status" => TRUE));
		}
		public function ajax_edit($id)
		{
			$data = $this->book_model->get_by_id($id);



			echo json_encode($data);
		}

		public function ajax_view($id)
		{
			$data = $this->book_model->get_by_id($id);



			echo json_encode($data);
		}

		public function book_update()
	{
		$data = array(
			'phone' => $this->input->post('phone'),
			'other_names' => $this->input->post('other_names'),
			'surname' => $this->input->post('surname'),
			'gender' => $this->input->post('gender'),
			'department' => $this->input->post('department'),
			'member_status' => $this->input->post('member_status'),
			'address' => $this->input->post('address'),
			'occupation' => $this->input->post('occupation'),
			'email' => $this->input->post('email'),
			'state' => $this->input->post('state'),
			'lga' => $this->input->post('lga'),
			'home_town' => $this->input->post('home_town'),
			'marital_status' => $this->input->post('marital_status'),
			'year_joined' => $this->input->post('year_joined'),
			'nok' => $this->input->post('nok'),
			'nok_phone' => $this->input->post('nok_phone'),
			'nok_addr' => $this->input->post('nok_addr'),
			'status' => $this->input->post('status'),
			'bday' => $this->input->post('bday'),
			'bmonth' => $this->input->post('bmonth'),
			);
		$this->book_model->book_update(array('book_id' => $this->input->post('book_id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function book_delete($id)
	{
		$this->book_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}



}
