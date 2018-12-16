<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Db_Emp extends CI_Model{
    function __construct() {
        $this->userTbl = 'emp';
    }
    
    function get_all(){
        $this->db->from($this->userTbl);
        $query = $this->db->get();
        return $query->result();
    }

    function get_provinsi(){
        $this->db->order_by('nama_provinsi', 'asc');
        return $this->db->get('provinsi')->result();
    }

    function get_kota(){
        $this->db->order_by('nama_kota', 'asc');
        $this->db->join('provinsi', 'kota.id_provinsi_fk = provinsi.id_provinsi');
        return $this->db->get('kota')->result();
    }

    function get_image($id){
    	$this->db->where('id', $id);
        $this->db->from('emp');
        $query = $this->db->get();
        return $query->result();
    }


    function delete($id){
    	$this->db->where('id',$id);
	    $query = $this->db->get('emp');
	    $row = $query->row();

	    unlink("./upload/$row->att_ktp");

	    $this->db->delete('emp', array('id' => $id));
    }

    function simpan_upload($att_ktp,$firstname,$lastname,$birthday,$phone,$email,$province,$city,$street,$zipcode,$ktp,$crnt_positon,$bank_name,$bank_acc,$time_add){
        $hasil=$this->db->query("INSERT INTO emp(att_ktp,firstname,lastname,birthday,phone,email,province,city,street,zipcode,ktp,crnt_positon,bank_name,bank_acc,time_add) VALUES ('$att_ktp','$firstname','$lastname','$birthday','$phone','$email','$province','$city','$street','$zipcode','$ktp','$crnt_positon','$bank_name','$bank_acc','$time_add')");
        return $hasil;
    }

    function get_data_by($id){
        $this->db->where('id', $id);
        $this->db->from('emp');
        $query = $this->db->get();
        return $query->result();
    }

}
