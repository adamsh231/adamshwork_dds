<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Flutter_Auth extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function login()
    {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $data = $this->M_DDS->getIbu(" where email='$email' and password='$password' and hak=1");
            echo json_encode($data);
        } else {
            redirect('DDS');
        }
    }

    function childList()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $data = $this->M_DDS->getAnak(" where id_ibu=$id");
            
            for ($i = 0; $i < count($data); $i++) {
                $diff = date_diff(date_create($data[$i]['tgl_lahir']), date_create(date('Y-m-d')));
                $umur = (int)($diff->days / 30);
                $day = $diff->days % 30;
                $tgl_lahir = date_create($data[$i]['tgl_lahir']);
    
                $data[$i]['bulan'] = strval($umur);
                $data[$i]['day'] = strval($day);
                $data[$i]['tanggal'] = date_format($tgl_lahir, 'd M Y');
    
                if ($data[$i]['zbb'] < -3) {
                    $data[$i]['stsBB'] = "Gizi Buruk";
                    $data[$i]['stsBBcolor'] = "d";
                } else if ($data[$i]['zbb'] > 2) {
                    $data[$i]['stsBB'] = "Gizi Lebih";
                    $data[$i]['stsBBcolor'] = "d";
                } else if ($data[$i]['zbb'] < -2) {
                    $data[$i]['stsBB'] = "Gizi Kurang";
                    $data[$i]['stsBBcolor'] = "w";
                } else if ($data[$i]['zbb'] <= 2 && $data[$i]['zbb'] >= -2) {
                    $data[$i]['stsBB'] = "Gizi Baik";
                    $data[$i]['stsBBcolor'] = "s";
                }
    
                if ($data[$i]['zbb'] < -3) {
                    $data[$i]['stsTB'] = "Sangat Pendek";
                    $data[$i]['stsTBcolor'] = "d";
                } else if ($data[$i]['zbb'] > 2) {
                    $data[$i]['stsTB'] = "Tinggi";
                    $data[$i]['stsTBcolor'] = "s";
                } else if ($data[$i]['zbb'] < -2) {
                    $data[$i]['stsTB'] = "Pendek";
                    $data[$i]['stsTBcolor'] = "w";
                } else if ($data[$i]['zbb'] <= 2 && $data[$i]['zbb'] >= -2) {
                    $data[$i]['stsTB'] = "Normal";
                    $data[$i]['stsTBcolor'] = "s";
                }
                
            }

            echo json_encode($data);
         } else {
            redirect('DDS');
        }
    }
}
