<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        $this->load->library('upload');
        $this->load->helper('form');
        $this->load->model('db_Emp');
    }

	public function index()
	{
		$data = array(
            'provinsi' => $this->db_Emp->get_provinsi(),
            'kota' => $this->db_Emp->get_kota(),
            'provinsi_selected' => '',
            'kota_selected' => '',
        );
        $data['list_data'] = $this->db_Emp->get_all();
		$this->load->view('home', $data);
	}

	public function save(){
		
		$data = array(
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname'),
			'birthday' => $this->input->post('birthday'),
			'phone' => $this->input->post('phone'),
			'email' => $this->input->post('email'),
			'province' => $this->input->post('province'),
			'city' => $this->input->post('city'),
			'street' => $this->input->post('street'),
			'zipcode' => $this->input->post('zipcode'),
			'ktp' => $this->input->post('ktp'),
			'crnt_positon' => $this->input->post('crnt_positon'),
			'bank_name' => $this->input->post('bank_name'),
			'bank_acc' => $this->input->post('bank_acc'),
			'time_add' => date('Y-m-d H:i:s')
		);

		$msg = $this->db_Emp->insert($data);

		if($msg){
			$this->session->set_flashdata("notif","<div class='alert alert-success'>Data Berhasil Disimpan</div>");
			redirect('home');
		}else{
			$this->session->set_flashdata("notif","<div class='alert alert-success'>Data Tidak Berhasil Di Simpan</div>");
			redirect('home');
		}

	}

	public function delete($id){
		$this->db_Emp->delete($id);
		redirect('home');
	}

	public function add(){
		$config['upload_path'] = './upload/'; //path folder
	    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	    $config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload

	    $this->upload->initialize($config);
	    if(!empty($_FILES['filefoto']['name'])){

	        if ($this->upload->do_upload('filefoto')){
	            $gbr = $this->upload->data();
	            $att_ktp=$gbr['file_name'];
				$firstname = $this->input->post('firstname');
				$lastname = $this->input->post('lastname');
				$birthday = $this->input->post('birthday');
				$phone = $this->input->post('phone');
				$email = $this->input->post('email');
				$province = $this->input->post('province');
				$city = $this->input->post('city');
				$street = $this->input->post('street');
				$zipcode = $this->input->post('zipcode');
				$ktp = $this->input->post('ktp');
				$crnt_positon = $this->input->post('crnt_positon');
				$bank_name = $this->input->post('bank_name');
				$bank_acc = $this->input->post('bank_acc');
				$time_add = date('Y-m-d H:i:s');

				$this->db_Emp->simpan_upload($att_ktp,$firstname,$lastname,$birthday,$phone,$email,$province,$city,$street,$zipcode,$ktp,$crnt_positon,$bank_name,$bank_acc,$time_add);

				$this->session->set_flashdata("notif","<div class='alert alert-success'>Image Berhasil Disimpan</div>");
				redirect('home');
			}
	                 
	    }else{
			$this->session->set_flashdata("notif","<div class='alert alert-danger'>Image Gagal Disimpan</div>");
		}		
	}

	public function edit($id){
		$data = $this->db_Emp->get_data_by($id);
        echo json_encode($data);
	}
}
