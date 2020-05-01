<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Flutter extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data = "";
        $data = $this->M_DDS->getAnak();


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
    }

    function rekomendasi($usiaRekomendasi = 0){
        if ($usiaRekomendasi < 6) {
            $usiaRekomendasi = 0;
        } else if ($usiaRekomendasi < 25) {
            $usiaRekomendasi = 13;
        } else if ($usiaRekomendasi < 37) {
            $usiaRekomendasi = 25;
        } else if ($usiaRekomendasi >= 37) {
            $usiaRekomendasi = 37;
        }
        $dataRekomendasi = $this->M_DDS->getRekomendasi(" where usia = '" . $usiaRekomendasi . "'");
        echo json_encode($dataRekomendasi);
    }
}
