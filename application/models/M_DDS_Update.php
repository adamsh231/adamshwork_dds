<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_DDS_Update extends CI_Model{

    public function updateData($tableName,$data,$where){
		$res = $this->db->update($tableName,$data,$where);
		return $res;
	}

	public function deleteData($tableName,$where){
		$res = $this->db->delete($tableName,$where);
		return $res;
	}
}