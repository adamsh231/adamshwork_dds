<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_DDS extends CI_Model{
    function getBBALU060($where=''){
        $res = $this->db->query('SELECT * FROM bbalu060 '.$where);
        return $res->result_array();
    }
    
    function getTBALU060($where=''){
        $res = $this->db->query('SELECT * FROM tbalu060 '.$where);
        return $res->result_array();
    }

    function getIMTALU060($where=''){
        $res = $this->db->query('SELECT * FROM imtalu060 '.$where);
        return $res->result_array();
    }

    function getBBTBALU024($where=''){
        $res = $this->db->query('SELECT * FROM bbtbalu024 '.$where);
        return $res->result_array();
    }

    function getBBTBALU2560($where=''){
        $res = $this->db->query('SELECT * FROM bbtbalu2560 '.$where);
        return $res->result_array();
    }

    function getBBAPU060($where=''){
        $res = $this->db->query('SELECT * FROM bbapu060 '.$where);
        return $res->result_array();
    }
    
    function getTBAPU060($where=''){
        $res = $this->db->query('SELECT * FROM tbapu060 '.$where);
        return $res->result_array();
    }

    function getIMTAPU060($where=''){
        $res = $this->db->query('SELECT * FROM imtapu060 '.$where);
        return $res->result_array();
    }

    function getBBTBAPU024($where=''){
        $res = $this->db->query('SELECT * FROM bbtbapu024 '.$where);
        return $res->result_array();
    }

    function getBBTBAPU2560($where=''){
        $res = $this->db->query('SELECT * FROM bbtbapu2560 '.$where);
        return $res->result_array();
    }

    function getIbu($where=''){
        // $res = $this->db->query('SELECT * FROM ibu '.$where);
        $res = $this->db->query('SELECT ibu.id, ibu.nik, ibu.nama, email, password, hak, hp, ibu.alamat, posyandu.nama as nama_pos, id_pos from ibu inner join posyandu on id_pos = posyandu.id '.$where);
        return $res->result_array();
    }

    function getAnak($where=''){
        $res = $this->db->query('SELECT anak.id, anak.nik, ibu.nik as nik_ibu, anak.nama, jenis_kelamin, bb_lahir, tb_lahir, foto, id_ibu, ibu.nama as nama_ibu, id_pos, tgl_lahir, zbb, ztb, zimt, zbbtb, catatan, cekCat FROM `anak` INNER JOIN ibu on id_ibu = ibu.id  '.$where);
        return $res->result_array();
    }

    function getLaporan($where=''){
        $res = $this->db->query('SELECT anak.id, anak.nik, ibu.nik as nik_ibu, anak.nama, jenis_kelamin, bb_lahir, tb_lahir, id_ibu, ibu.nama as nama_ibu , id_pos, posyandu.nama as nama_pos, tgl_lahir FROM `anak` INNER JOIN ibu on id_ibu = ibu.id INNER JOIN posyandu ON id_pos = posyandu.id '.$where);
        return $res->result_array();
    }

    function getRecord($where=''){
        $res = $this->db->query('SELECT * FROM record '.$where);
        return $res->result_array();
    }

    function getRekomendasi($where=''){
        $res = $this->db->query('SELECT * FROM rekomendasi '.$where);
        return $res->result_array();
    }

    function getRecordJson($where=''){
        $res = $this->db->query('SELECT * FROM '.$where);
        return $res->result_array();
    }

    function getPosyandu($where=''){
        $res = $this->db->query('SELECT * FROM posyandu '.$where);
        return $res->result_array();
    }

    //APLIKASI SMAOTHER
    function get($where=''){
        $res = $this->db->query('SELECT * FROM '.$where);
        return $res->result_array();
    }
}