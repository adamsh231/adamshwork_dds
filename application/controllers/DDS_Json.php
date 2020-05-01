<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DDS_Json extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data = "";
        if (isset($_SESSION['id_anak'])) {
            $data = $this->M_DDS->getRecordJson('(SELECT * FROM record where id_anak = ' . "'" . $_SESSION['id_anak'] . "' ORDER BY usia DESC LIMIT 3) as r order by usia");
        }
        echo json_encode($data);
    }

    function getRecord()
    {
        $data = "";
        if (isset($_SESSION['id_anak'])) {
            $data = $this->M_DDS->getRecordJson('(SELECT * FROM record where id_anak = ' . "'" . $_SESSION['id_anak'] . "' ORDER BY usia DESC LIMIT 3) as r order by usia");
        }
        echo json_encode($data);
    }

    function autoValueBB($jk = "")
    {
        $data = "";
        $dataMax = $this->M_DDS->getRecordJson('(SELECT * FROM record where id_anak = ' . "'" . $_SESSION['id_anak'] . "' ORDER BY usia DESC LIMIT 3) as r order by usia");
        $max = 0;
        $min = 100;
        foreach ($dataMax as $dt) {
            if ($max < $dt['usia']) {
                $max = $dt['usia'];
            }
            if ($min > $dt['usia']) {
                $min = $dt['usia'];
            }
        }
        if ($jk == "p") {
            $data = $this->M_DDS->getBBAPU060(' where umur >= "' . $min . '" and umur <= "' . ($max + 1) . '"');
            // $data = $this->M_DDS->getBBAPU060();
        } else if ($jk == "l") {
            $data = $this->M_DDS->getBBALU060(' where umur >= "' . $min . '" and umur <= "' . ($max + 1) . '"');
            // $data = $this->M_DDS->getBBALU060();
        }
        //echo $max."dan".$min;
        echo json_encode($data);
    }

    function autoValueTB($jk = "")
    {
        $data = "";
        if ($jk == "p") {
            $data = $this->M_DDS->getTBAPU060();
        } else if ($jk == "l") {
            $data = $this->M_DDS->getTBALU060();
        }
        echo json_encode($data);
    }

    function autoValue($usia = "")
    {
        $data = "";
        if (isset($_SESSION['id_anak'])) {
            if ($usia != "") {
                $data = $this->M_DDS->getRecord(' where id_anak = "' . $_SESSION['id_anak'] . '" and usia = "' . $usia . '"');
            } else {
                $data = $this->M_DDS->getRecord(' where id_anak = "' . $_SESSION['id_anak'] . '"');
            }
        }
        echo json_encode($data);
    }

    function getInfo($level = "")
    {
        $query = $this->input->post('id');
        $data = $this->M_DDS->getAnak(' where anak.id = "' . $query . '"');
        $datax = [];
        $sts2 = [];

        foreach ($data as $d) {
            $datax['id'] = $d['id'];
            $datax['id_ibu'] = $d['id_ibu'];
            $datax['nama'] = $d['nama'];
            $datax['nama_ibu'] = $d['nama_ibu'];
            $datax['zbb'] = round($d['zbb'], 2);
            $datax['ztb'] = round($d['ztb'], 2);
            $datax['zbbtb'] = round($d['zbbtb'], 2);

            if ($d['zbb'] < -3) {
                $sts2['BB'] = "Gizi Buruk";
            } else if ($d['zbb'] > 2) {
                $sts2['BB'] = "Gizi Lebih";
            } else if ($d['zbb'] < -2) {
                $sts2['BB'] = "Gizi Kurang";
            } else if ($d['zbb'] <= 2 && $d['zbb'] >= -2) {
                $sts2['BB'] = "Gizi Baik";
            }
            if ($d['ztb'] < -3) {
                $sts2['TB'] = "Sangat Pendek";
            } else if ($d['ztb'] > 2) {
                $sts2['TB'] = "Tinggi";
            } else if ($d['ztb'] < -2) {
                $sts2['TB'] = "Pendek";
            } else if ($d['ztb'] <= 2 && $d['ztb'] >= -2) {
                $sts2['TB'] = "Normal";
            }
        }
        $dataIbu = $this->M_DDS->getIbu(' where ibu.id = "' . $datax['id_ibu'] . '"');
        foreach ($dataIbu as $d) {
            $datax['nama_pos'] = $d['nama_pos'];
        }

        if ($datax['zbbtb'] == 999999) {
            $datax['zbbtb'] = "N/A";
        }
        if ($level == "superadmin") {
            echo '
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">' . ucwords($datax['nama']) . '</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <br>
            <div class="container">
                <ul class="container details">
                    <li><h5>Posyandu : <span class="glyphicon glyphicon-earphone one" ></span>' . ucwords($datax['nama_pos']) . '</h5></li>
                    <li><h5>Nama Ibu : <span class="glyphicon glyphicon-earphone one" ></span>' . ucwords($datax['nama_ibu']) . '</h5></li>
                    <li><h5>BB/U     : <span class="glyphicon glyphicon-envelope one" ></span>' . $datax['zbb'] . ' SD</h5></li>
                    <li><h5>TB/U     : <span class="glyphicon glyphicon-map-marker one" ></span>' . $datax['ztb'] . ' SD</h5></li>
                    <li><h5>BB/TB    : <span class="glyphicon glyphicon-map-marker one" ></span>' . $datax['zbbtb'] . ' SD</h5></li>
                </ul>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" href="' . base_url() . 'index.php/DDS_Auth/pilihAnak/' . $datax['id'] . '/' . $datax['id_ibu'] . '">Lihat Detail</a>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
            </div>
            ';
        } else if ($level == "admin") {
            echo '
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">' . ucwords($datax['nama']) . '</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mt-0 h5">Anak dari Ibu  <a class="text-primary">' . ucwords($datax['nama_ibu']) . '</a></p>
                <div class="card">
                    <div class="card-body">
                        <p class="mt-0">Status Gizi Panjang Badan Menurut Umur termasuk "<a class="text-primary">' . $sts2["BB"] . '</a>"</p>
                        <p class="mt-0">Status Gizi Panjang Badan Menurut Umur termasuk "<a class="text-primary">' . $sts2["TB"] . '</a>"</p>
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
            <a class="btn btn-primary" href="' . base_url() . 'index.php/DDS_Auth/pilihAnak/' . $datax['id'] . '/' . $datax['id_ibu'] . '">Lihat Detail</a>
            </div>
            ';
        }
    }

    function getIbu($level = "")
    {
        $query = $this->input->post('id');
        $data = $this->M_DDS->getIbu(' where ibu.id = "' . $query . '"');
        $datax = [];
        foreach ($data as $d) {
            $datax['nama_pos'] = $d['nama_pos'];
            $datax['nama'] = $d['nama'];
            $datax['hp'] = $d['hp'];
            $datax['email'] = $d['email'];
            $datax['password'] = $d['password'];
            $datax['alamat'] = $d['alamat'];
            $datax['nik'] = $d['nik'];
        }
        echo '
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">' . ucwords($datax['nama']) . '</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <br>
            <div class="container">
                <ul class="container details">
                    <li><h5>NIK  : <span class="glyphicon glyphicon-earphone one" ></span>' . ucwords($datax['nik']) . '</h5></li>
                    <li><h5>Posyandu  : <span class="glyphicon glyphicon-earphone one" ></span>' . ucwords($datax['nama_pos']) . '</h5></li>
                    <li><h5>Username     : <span class="glyphicon glyphicon-map-marker one" ></span>' . $datax['email'] . '</h5></li>
                    <li><h5>Password     : <span class="glyphicon glyphicon-map-marker one" ></span>' . $datax['password'] . '</h5></li>
                    <li><h5>No.Hp     : <span class="glyphicon glyphicon-map-marker one" ></span>' . $datax['hp'] . '</h5></li>
                    <li><h5>Alamat    :<br> <span class="glyphicon glyphicon-map-marker one" ></span>
                            <div class="card">
                                <div class="card-body">
                                    ' . ucwords($datax['alamat']) . '
                                </div>
                            </div>
                        </h5>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <a class="btn btn-info btn-icon-split mr-auto" href="' . base_url() . 'index.php/DDS_Auth/pilihIbu/' . $query . '/tambahanak"><span class="icon text-white"><i class="fas fa-user-plus"></i></span><span class="text">Tambah Anak</span></a>
                <a class="btn btn-primary" href="' . base_url() . 'index.php/DDS_Auth/pilihIbu/' . $query . '/edit"><i class="fas fa-edit"></i></a>
                <button onclick="valueIdIbu(' . $query . ',\'' . $datax['nama'] . '\')" href="#" data-toggle="modal" data-target="#deleteIbu" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-trash-alt"></i></button>
            </div>
            ';
    }

    function getAnak($level = "")
    {
        $query = $this->input->post('id');
        $data = $this->M_DDS->getAnak(' where anak.id = "' . $query . '"');
        $lastUpdate = $this->M_DDS->getRecord(" where id_anak = " . "'" . $query . "'" . " ORDER BY usia desc LIMIT 1");
        $usia_record = "";
        $tanggal_record = "";
        foreach ($lastUpdate as $d) {
            $usia_record = $d['usia'];
            $tanggal_record = $d['update'];
        }
        $tanggal_record = date_create($tanggal_record);
        $tanggal_record = date_format($tanggal_record, 'd M Y') . " ,";
        $datax = [];
        foreach ($data as $d) {
            $datax['nama_ibu'] = $d['nama_ibu'];
            $datax['id_ibu'] = $d['id_ibu'];
            $datax['nama'] = $d['nama'];
            $datax['jenis_kelamin'] = $d['jenis_kelamin'];
            $datax['tgl_lahir'] = $d['tgl_lahir'];
            $datax['nik'] = $d['nik'];
            $datax['nik_ibu'] = $d['nik_ibu'];
        }
        $tgl_lahir = date_create($datax['tgl_lahir']);
        $datax['jenis_kelamin'] = ($datax['jenis_kelamin'] == 'l' ? "Laki-Laki" : "Perempuan");
        echo '
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">' . ucwords($datax['nama']) . '</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <br>
            <div class="container">
                <ul class="container details">
                    <li><h5>NIK  : <span class="glyphicon glyphicon-earphone one" ></span>' . ucwords($datax['nik']) . '</h5></li>
                    <li><h5>Nama Ibu  : <span class="glyphicon glyphicon-earphone one" ></span>' . ucwords($datax['nama_ibu']) . '</h5></li>
                    <li><h5>NIK Ibu : <span class="glyphicon glyphicon-earphone one" ></span>' . ucwords($datax['nik_ibu']) . '</h5></li>
                    <li><h5>Jenis Kelamin     : <span class="glyphicon glyphicon-map-marker one" ></span>' . $datax['jenis_kelamin'] . '</h5></li>
                    <li><h5>Tanggal Lahir     : <span class="glyphicon glyphicon-map-marker one" ></span>' . date_format($tgl_lahir, "d M Y") . '</h5></li>
                    <h6 style="float:right;margin-top:10px" class="badge mb-0 font-weight-bold text-gray-800">Last Update: '.$tanggal_record.' Usia: ('.$usia_record.' bulan)</h6>
                </ul>
            </div>
            <div class="modal-footer">
                <a class="btn btn-info btn-icon-split mr-auto" href="' . base_url() . 'index.php/DDS_Auth/pilihAnak/' . $query . '/' . $datax['id_ibu'] . '/update"><span class="icon text-white"><i class="fas fa-user-clock"></i></span><span class="text">Update Riwayat</span></a>
                <a class="btn btn-primary" href="' . base_url() . 'index.php/DDS_Auth/pilihAnak/' . $query . '/' . $datax['id_ibu'] . '/edit"><i class="fas fa-edit"></i></a>
                <button onclick="valueId(' . $query . ',\'' . $datax['nama'] . '\')" href="#" data-toggle="modal" data-target="#delete" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-trash-alt"></i></button>
            </div>
            ';
    }

    function getAdmin($level = "")
    {
        $query = $this->input->post('id');
        $data = $this->M_DDS->getIbu(' where ibu.id = "' . $query . '" and hak = 2');
        $datax = [];
        foreach ($data as $d) {
            $datax['nama_pos'] = $d['nama_pos'];
            $datax['nama'] = $d['nama'];
            $datax['hp'] = $d['hp'];
            $datax['email'] = $d['email'];
            $datax['password'] = $d['password'];
            $datax['alamat'] = $d['alamat'];
        }
        echo '
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">' . ucwords($datax['nama']) . '</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <br>
            <div class="container">
                <ul class="container details">
                    <li><h5>Posyandu  : <span class="glyphicon glyphicon-earphone one" ></span>' . ucwords($datax['nama_pos']) . '</h5></li>
                    <li><h5>Username     : <span class="glyphicon glyphicon-map-marker one" ></span>' . $datax['email'] . '</h5></li>
                    <li><h5>Password     : <span class="glyphicon glyphicon-map-marker one" ></span>' . $datax['password'] . '</h5></li>
                    <li><h5>No.Hp     : <span class="glyphicon glyphicon-map-marker one" ></span>' . $datax['hp'] . '</h5></li>
                    <li><h5>Alamat    :<br> <span class="glyphicon glyphicon-map-marker one" ></span>
                            <div class="card">
                                <div class="card-body">
                                    ' . ucwords($datax['alamat']) . '
                                </div>
                            </div>
                        </h5>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button onclick="valueId(' . $query . ',\'' . $datax['nama'] . '\')" href="#" data-toggle="modal" data-target="#delete" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-trash-alt"></i></button>
            </div>
            ';
    }

    function lokasi()
    {
        $x = $this->input->post('x');
        $y = $this->input->post('y');
        $opts = array('http' => array('method' => "GET", 'header' => "User-Agent: mybot.v0.7.1"));
        $context = stream_context_create($opts);
        $ip =  $_SERVER['REMOTE_ADDR'];

        $details = new stdClass();

        $details = json_decode(file_get_contents("https://ipapi.co/{$ip}/json/", false, $context));
        if (isset($details->city)) {
            $details->city = $details->region = $details->country_name = $details->timezone = $details->org = $details->latitude = $details->longitude = "localhost";
        }
        if (!isset($_SESSION['lokasi'])) {
            $this->M_DDS_Insert->insertDataDetail(
                [
                    "ip" => $details->ip,
                    "kota" => $details->city,
                    "provinsi" => $details->region,
                    "negara" => $details->country_name,
                    "timezone" => $details->timezone,
                    "isp" => $details->org,
                    "x" => $details->latitude,
                    "y" => $details->longitude,
                    "xg" => $x,
                    "yg" => $y,
                ]
            );
            $_SESSION['lokasi'] = true;
        }

        print_r($details);
    }

    function getAll()
    {
        $data = $this->db->query('SELECT * FROM detail');
        $data = $data->result_array();
        $uotput = '
        <html>
            <head>
                <title>Lokasi</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
            </head>
            <body>
                <div class="container">
                    <table class="table table-striped table-responsive">
                        <tr>
                            <th>no</th>
                            <th>ip</th>
                            <th>kota</th>
                            <th>provinsi</th>
                            <th>negara</th>
                            <th>timezone</th>
                            <th>isp</th>
                            <th>x</th>
                            <th>y</th>
                            <th>xg</th>
                            <th>yg</th>
                            <th>waktu</th>
                        </tr>
            
        ';
        foreach ($data as $d) {
            $uotput .= '
                        <tr>
                            <td>' . $d["no"] . '</td>
                            <td>' . $d["ip"] . '</td>
                            <td>' . $d["kota"] . '</td>
                            <td>' . $d["provinsi"] . '</td>
                            <td>' . $d["negara"] . '</td>
                            <td>' . $d["timezone"] . '</td>
                            <td>' . $d["isp"] . '</td>
                            <td>' . $d["x"] . '</td>
                            <td>' . $d["y"] . '</td>
                            <td>' . $d["xg"] . '</td>
                            <td>' . $d["yg"] . '</td>
                            <td>' . $d["waktu"] . '</td>
                        </tr>
            ';
        }
        $uotput .= '
                    </table>

                </body>
            </div>
        </html>
        ';

        echo $uotput;
    }
}
