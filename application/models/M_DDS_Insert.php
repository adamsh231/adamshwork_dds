<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_DDS_Insert extends CI_Model{

    function insertDataIbu($data){
        $res = $this->db->insert('ibu', $data);
        return $res;
    }

    function insertDataDetail($data){
        $res = $this->db->insert('detail', $data);
        return $res;
    }

    function insertDataAnak($data){
        $res = $this->db->insert('anak', $data);
        return $res;
    }

    function insertDataRecord($data){
        $res = $this->db->insert('record', $data);
        return $res;
    }

    function insertDataPosyandu($data){
        $res = $this->db->insert('posyandu', $data);
        return $res;
    }

    // function updateEditDataAnak($usia,$bulan,$tahun,$bb,$tb,$zS,$id,$diff){
    //     $this->db->query("update record set usia = , bulan = , tahun = , bb_skrg = , tb_skrg = ,update = CURRENT_TIMESTAMP(),zbb = ,ztb = ,zimt = ,zbbtb =   where id_anak =  and usia = 0");
    //     $this->db->query("update record set bulan = abs(bulan+...%12), tahun = tahun+... where id_anak = ");
    // }

}