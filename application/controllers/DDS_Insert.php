<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DDS_Insert extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $dataBB = $this->M_DDS->getBBAPU060();
        echo json_encode($dataBB);
    }

    function insertDataIbu()
    {
        $registerS =
            "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            Data <strong>Berhasil!</strong> Dibuat. Klik <a href='" . base_url() . "index.php/DDS/index/tambahanak' class='alert-link'>Disini</a>. Untuk Lihat.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        $registerG =
            "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Username Telah Digunakan!</strong>.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";

        $random = rand(1, 2);

        //random pass//
        // function password_generate($chars) {
        //     $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        //     return substr(str_shuffle($data), 0, $chars);
        // }
        // $pass = password_generate(7);
        //----------//

        if (isset($_POST['submit'])) {
            if ($this->M_DDS_Insert->insertDataIbu(
                [
                    "nama" => $_POST['inputNama'],
                    "email" => strtolower($_POST['inputEmail']),
                    "hp" => $_POST['inputHp'],
                    "alamat" => $_POST['inputAlamat'],
                    "password" => strtolower($_POST['inputEmail']) . '123',
                    "nik" => $_POST['inputNik'],

                    //CONTOH//
                    "hak" => 1,
                    "id_pos" => $_SESSION['id_pos']
                    //CONTOH//

                ]
            )) {
                $this->session->set_flashdata("register", $registerS);
            } else {
                $this->session->set_flashdata("register", $registerG);
            }
        }
        redirect('DDS/index/tambahibu'); //tanpa index.php
    }

    function insertDataAdmin()
    {
        $registerS =
            "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            Data <strong>Berhasil!</strong> Dibuat. Klik <a href='" . base_url() . "index.php/DDS/index/daftarkader' class='alert-link'>Disini</a>. Untuk Lihat.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        $registerG =
            "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Email Telah Digunakan!</strong>.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";

        $random = rand(1, 2);

        //random pass//
        // function password_generate($chars) 
        // {
        // $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        // return substr(str_shuffle($data), 0, $chars);
        // }
        // $pass = password_generate(7);
        //----------//

        if (isset($_POST['submit'])) {
            if ($this->M_DDS_Insert->insertDataIbu(
                [
                    "nama" => $_POST['inputNama'],
                    "email" => strtolower($_POST['inputEmail']),
                    "hp" => $_POST['inputHp'],
                    "alamat" => $_POST['inputAlamat'],
                    "password" => strtolower($_POST['inputEmail']) . '123',

                    //CONTOH//
                    "hak" => 2,
                    "id_pos" => $_POST['inputIdPos']
                    //CONTOH//

                ]
            )) {
                $this->session->set_flashdata("register", $registerS);
            } else {
                $this->session->set_flashdata("register", $registerG);
            }
        }
        redirect('DDS/index/tambahkader'); //tanpa index.php
    }

    function insertDataAnak()
    {
        $tambahS =
            "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            Anak <strong>Berhasil!</strong> Ditambahkan. Klik <a href='" . base_url() . "index.php/DDS/index/daftaranakibu' class='alert-link'>Disini</a>. Untuk Melihat.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        $tambahG =
            "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Anak Gagal Ditambahkan!</strong>.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";

        if (isset($_POST['submit'])) {

            $diff = date_diff($_POST['inputTanggal'], date('Y-m-d'));
            $umur = $diff->days / 30;

            $tinggi = $_POST['inputTB'];
            if ($_POST['inputJU'] == "b" && $umur < 24) {
                $tinggi = $tinggi + 0.7;
            } else if ($_POST['inputJU'] == "t" && $umur > 24) {
                $tinggi = $tinggi - 0.7;
            }

            if ($this->M_DDS_Insert->insertDataAnak(
                [
                    "nama" => $_POST['inputNama'],
                    "jenis_kelamin" => $_POST['inputJK'],
                    "tgl_lahir" => $_POST['inputTanggal'],
                    "bb_lahir" => $_POST['inputBB'],
                    "nik" => $_POST['inputNik'],
                    "tb_lahir" => $tinggi,
                    "id_ibu" => $_SESSION['id_ibu']
                ]
            )) {
                $_SESSION['dilarang'] = "uasu"; //PAKE FLASH DATA AJA COK
                $this->insertDataAnakBaru();
                $this->session->set_flashdata("tambah", $tambahS);
            } else {
                $this->session->set_flashdata("tambah", $tambahG);
            }
        }
        redirect('DDS/index/tambahanakibu'); //tanpa index.php
    }

    function insertDataAnakBaru()
    {
        $bulan = "";
        if (isset($_SESSION['dilarang'])) {
            if ($_SESSION['dilarang'] == "uasu") {
                $id_anak = $this->M_DDS->getAnak(' order by id desc limit 1');
                foreach ($id_anak as $a) {
                    $bulan = date_create($a['tgl_lahir']);
                    $tahun = date_format($bulan, 'Y');
                    $bulan = date_format($bulan, 'm');
                    $bulan = ($bulan + $_POST['inputUmur']) % 12;
                    if ($bulan == 0) {
                        $bulan = 12;
                    }
                    $zS = $this->hitungZscore(0, $a['bb_lahir'], $a['tb_lahir'], $a['jenis_kelamin'], "t");
                    $this->M_DDS_Insert->insertDataRecord(
                        [
                            "bb_skrg" => $a['bb_lahir'],
                            "tb_skrg" => $a['tb_lahir'],
                            "id_anak" => $a['id'],
                            "usia" => 0,
                            "zbb" => round($zS['BB'], 2),
                            "ztb" => round($zS['TB'], 2),
                            "zimt" => round($zS['IMT'], 2),
                            "zbbtb" => round($zS['BBTB'], 2),
                            "bulan" => $bulan,
                            "tahun" => $tahun
                        ]
                    );
                    $this->M_DDS_Update->updateData(
                        "anak",
                        [
                            "zbb" => round($zS['BB'], 2),
                            "ztb" => round($zS['TB'], 2),
                            "zimt" => round($zS['IMT'], 2),
                            "zbbtb" => round($zS['BBTB'], 2),
                        ],
                        [
                            "id" => $a['id']
                        ]
                    );
                }
                $_SESSION['dilarang'] == "";
            } else {
                redirect('DDS');
            }
        } else {
            redirect('DDS');
        }
    }

    function insertDataRecord()
    {
        $tambahS =
            "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            Record <strong>Berhasil Ditambahkan!</strong>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        $tambahG =
            "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Record Gagal Ditambahkan!</strong>.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";

        if (isset($_POST['submit'])) {
            $res = $this->M_DDS->getAnak('where anak.id = ' . "'" . $_SESSION['id_anak'] . "'");

            $dataRecord = $this->M_DDS->getRecord('where id_anak = ' . "'" . $_SESSION['id_anak'] . "'");
            $countDistinct = 0;
            $bulan = "";
            $tahun = "";
            foreach ($dataRecord as $d) {
                if ($_POST['inputUmur'] == $d['usia']) {
                    $countDistinct = $countDistinct + 1;
                }
            }


            $jk = "";
            $tinggi = $_POST['inputTB'];
            if ($_POST['inputJU'] == "b" && $_POST['inputUmur'] < 24) {
                $tinggi = $tinggi + 0.7;
            } else if ($_POST['inputJU'] == "t" && $_POST['inputUmur'] > 24) {
                $tinggi = $tinggi - 0.7;
            }

            foreach ($res as $r) {
                $jk = $r['jenis_kelamin'];
                $bulan = date_create($r['tgl_lahir']); //tahun = inputumur/12
            }
            $bulan = date_format($bulan, 'm');

            $zS = $this->hitungZscore($_POST['inputUmur'], $_POST['inputBB'], $_POST['inputTB'], $jk, $_POST['inputJU']);

            $bulan = ($bulan + $_POST['inputUmur']) % 12;
            if ($bulan == 0) {
                $bulan = 12;
            }

            $bulan2 = "";
            $dataRecord2 = $this->M_DDS->getRecord('where id_anak = ' . "'" . $_SESSION['id_anak'] . "' and usia = 0");
            foreach ($dataRecord2 as $data) {
                $bulan2 = $data['bulan'];
                $tahun = (int) (($bulan2 + $_POST['inputUmur']) / 12);
                if (($bulan2 + $_POST['inputUmur']) % 12 == 0) {
                    $tahun = $tahun - 1;
                }
                $tahun = $tahun + $data['tahun'];
            }

            $dataRecordCek = $this->M_DDS->getRecord(" where id_anak = " . "'" . $_SESSION['id_anak'] . "'" . " ORDER BY usia desc LIMIT 1");
            $dataLastCheck = false;
            foreach ($dataRecordCek as $data) {
                if ($_POST['inputUmur'] >= $data['usia']) {
                    $dataLastCheck = true;
                }
            }

            if ($countDistinct == 0) {
                if ($this->M_DDS_Insert->insertDataRecord(
                    [
                        "bb_skrg" => $_POST['inputBB'],
                        "tb_skrg" => $tinggi,
                        "id_anak" => $_SESSION['id_anak'],
                        "usia" => $_POST['inputUmur'],
                        "zbb" => round($zS['BB'], 2),
                        "ztb" => round($zS['TB'], 2),
                        "zimt" => round($zS['IMT'], 2),
                        "zbbtb" => round($zS['BBTB'], 2),
                        "bulan" => $bulan,
                        "tahun" => $tahun
                    ]
                )) {
                    if ($dataLastCheck) {
                        if ($this->M_DDS_Update->updateData(
                            "anak",
                            [
                                "zbb" => round($zS['BB'], 2),
                                "ztb" => round($zS['TB'], 2),
                                "zimt" => round($zS['IMT'], 2),
                                "zbbtb" => round($zS['BBTB'], 2),
                            ],
                            [
                                "id" => $_SESSION['id_anak']
                            ]
                        )) {
                            $this->session->set_flashdata("tambah", $tambahS);
                        } else {
                            $this->session->set_flashdata("tambah", $tambahG);
                        }
                    }
                    $this->session->set_flashdata("tambah", $tambahS);
                } else {
                    $this->session->set_flashdata("tambah", $tambahG);
                }
            } else {
                if ($this->M_DDS_Update->updateData(
                    "record",
                    [
                        // "jenis_kelamin" => $_POST['inputJK'],
                        "bb_skrg" => $_POST['inputBB'],
                        "tb_skrg" => $tinggi,
                        "zbb" => round($zS['BB'], 2),
                        "ztb" => round($zS['TB'], 2),
                        "zimt" => round($zS['IMT'], 2),
                        "zbbtb" => round($zS['BBTB'], 2),
                        "update" => date("Y-m-d h:i:s")
                    ],
                    [
                        "usia" => $_POST['inputUmur'],
                        "id_anak" => $_SESSION['id_anak']
                    ]
                )) {
                    if ($dataLastCheck) {
                        if ($this->M_DDS_Update->updateData(
                            "anak",
                            [
                                "zbb" => round($zS['BB'], 2),
                                "ztb" => round($zS['TB'], 2),
                                "zimt" => round($zS['IMT'], 2),
                                "zbbtb" => round($zS['BBTB'], 2),
                            ],
                            [
                                "id" => $_SESSION['id_anak']
                            ]
                        )) {
                            $this->session->set_flashdata("tambah", $tambahS);
                        } else {
                            $this->session->set_flashdata("tambah", $tambahG);
                        }
                    }
                    $this->session->set_flashdata("tambah", $tambahS);
                } else {
                    $this->session->set_flashdata("tambah", $tambahG);
                }
            }
        }
        redirect('DDS/index/daftarriwayat'); //tanpa index.php
    }

    function insertDataPosyandu()
    {
        $registerS =
            "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            Data <strong>Berhasil!</strong> Dibuat. Klik <a href='" . base_url() . "index.php/DDS/index/daftarposyandu' class='alert-link'>Disini</a>. Untuk Lihat.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        $registerG =
            "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Input Data Gagal!</strong>.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";

        if (isset($_POST['submit'])) {
            if ($this->M_DDS_Insert->insertDataPosyandu(
                [
                    "nama" => $_POST['inputNama'],
                    "alamat" => $_POST['inputAlamat'],
                    "kodepos" => $_POST['inputKodePos']
                ]
            )) {
                $this->session->set_flashdata("register", $registerS);
            } else {
                $this->session->set_flashdata("register", $registerG);
            }
        }
        redirect('DDS/index/tambahposyandu'); //tanpa index.php
    }

    function updateCatatan()
    {
        if (isset($_POST['submit'])) {
            $this->M_DDS_Update->updateData(
                "anak",
                [
                    "cekCat" => 1,
                    "catatan" => $_POST['catatan'],
                ],
                [
                    "id" => $_SESSION['id_anak']
                ]
            );
            redirect('DDS/index/statusanak');
        } else if (isset($_POST['submit1_2'])) {
            $this->M_DDS_Update->updateData(
                "anak",
                [
                    "cekCat" => 1,
                ],
                [
                    "id" => $_SESSION['id_anak']
                ]
            );
            redirect('DDS/index/statusanak');
        } else if (isset($_POST['submit2'])) {
            $this->M_DDS_Update->updateData(
                "anak",
                [
                    "cekCat" => 2,
                ],
                [
                    "id" => $_SESSION['id_anak']
                ]
            );
            redirect('DDS/index/statusanak');
        } else if (isset($_POST['submit3'])) {
            $this->M_DDS_Update->updateData(
                "anak",
                [
                    "cekCat" => 0,
                    "catatan" => null,
                ],
                [
                    "id" => $_SESSION['id_anak']
                ]
            );
            redirect('DDS/index/statusanak');
        }
        redirect('DDS');
    }

    function updateProfile($content = "")
    {
        $updateS =
            "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            Profile <strong>Berhasil!</strong> Diupdate. Klik <a href='" . base_url() . "index.php/DDS/index/tambahanak' class='alert-link'>Disini</a> kembali ke menu ibu
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        $updateG =
            "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Username telah digunakan!</strong>.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        if (isset($_POST['submit'])) {
            $id = $_SESSION['id'];
            if ($content == "edit") {
                $id = $_SESSION['id_ibu'];
            }
            if ($this->M_DDS_Update->updateData(
                "ibu",
                [
                    "nama" => $_POST['inputNama'],
                    "email" => strtolower($_POST['inputEmail']),
                    "nik" => $_POST['inputNik'],
                    "password" => strtolower($_POST['inputPassword']),
                    "hp" => $_POST['inputHp'],
                    "alamat" => $_POST['inputAlamat']
                ],
                [
                    "id" => $id
                ]
            )) {
                $this->session->set_flashdata("update", $updateS);
                if ($content == "edit") {
                    redirect('DDS/index/editIbu');
                }
                redirect('DDS/index/home');
            } else {
                $this->session->set_flashdata("update", $updateG);
                if ($content == "edit") {
                    redirect('DDS/index/editIbu');
                }
                redirect('DDS/index/home');
            }
        }
        redirect('DDS');
    }

    function updateAnak()
    {
        $updateS =
            "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            Data <strong>Berhasil!</strong> Diedit. Klik <a href='" . base_url() . "index.php/DDS/index/' class='alert-link'>Disini</a> Kembali Ke Menu Utama
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        $updateG =
            "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Edit Gagal!</strong>.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        if (isset($_POST['submit'])) {
            $dataRecordCek = $this->M_DDS->getRecord(" where id_anak = " . "'" . $_SESSION['id_anak'] . "'" . " ORDER BY usia desc LIMIT 1");
            $dataLastCheck = false;
            foreach ($dataRecordCek as $data) {
                if ($data['usia'] == 0) {
                    $dataLastCheck = true;
                }
            }
            $zS = $this->hitungZscore(0, $_POST['inputBB'], $_POST['inputTB'], $_POST['inputJK'], 't');
            if ($dataLastCheck) {
                if ($this->M_DDS_Update->updateData(
                    "anak",
                    [
                        "nama" => $_POST['inputNama'],
                        "jenis_kelamin" => $_POST['inputJK'],
                        "bb_lahir" => $_POST['inputBB'],
                        "tb_lahir" => $_POST['inputTB'],
                        "nik" => $_POST['inputNik'],
                        "zbb" => round($zS['BB'], 2),
                        "ztb" => round($zS['TB'], 2),
                        "zimt" => round($zS['IMT'], 2),
                        "zbbtb" => round($zS['BBTB'], 2)
                    ],
                    [
                        "id" => $_SESSION['id_anak']
                    ]
                )) {

                    $this->session->set_flashdata("update", $updateS);
                    //redirect('DDS/index/editanak');
                } else {
                    $this->session->set_flashdata("update", $updateG);
                    redirect('DDS/index/editanak');
                }
            } else {
                if ($this->M_DDS_Update->updateData(
                    "anak",
                    [
                        "nama" => $_POST['inputNama'],
                        "nik" => $_POST['inputNik'],
                        "jenis_kelamin" => $_POST['inputJK'],
                        "bb_lahir" => $_POST['inputBB'],
                        "tb_lahir" => $_POST['inputTB'],
                        //"tgl_lahir" => $_POST['inputTgl']
                    ],
                    [
                        "id" => $_SESSION['id_anak']
                    ]
                )) {
                    $this->session->set_flashdata("update", $updateS);
                    //redirect('DDS/index/editanak');
                } else {
                    $this->session->set_flashdata("update", $updateG);
                    redirect('DDS/index/editanak');
                }
            }
            if ($this->M_DDS_Update->updateData(
                "record",
                [
                    "bb_skrg" => $_POST['inputBB'],
                    "tb_skrg" => $_POST['inputTB'],
                    "zbb" => round($zS['BB'], 2),
                    "ztb" => round($zS['TB'], 2),
                    "zimt" => round($zS['IMT'], 2),
                    "zbbtb" => round($zS['BBTB'], 2),
                ],
                [
                    "id_anak" => $_SESSION['id_anak'],
                    "usia" => 0
                ]
            )) {
                $this->session->set_flashdata("update", $updateS);
            } else {
                $this->session->set_flashdata("update", $updateG);
            }
            redirect('DDS/index/editanak');
        }
        redirect('DDS');
    }

    function deleteRecord()
    {
        if (isset($_POST['submit'])) {
            $usia = $_POST['valueUsia'];
            $this->M_DDS_Update->deleteData(
                "record",
                [
                    "id_anak" => $_SESSION['id_anak'],
                    "usia" => $usia
                ]
            );
            $data = $this->M_DDS->getRecord(" where id_anak = " . "'" . $_SESSION['id_anak'] . "'" . " ORDER BY usia desc LIMIT 1");
            foreach ($data as $zS) {
                $this->M_DDS_Update->updateData(
                    "anak",
                    [
                        "zbb" => round($zS['zbb'], 2),
                        "ztb" => round($zS['ztb'], 2),
                        "zimt" => round($zS['zimt'], 2),
                        "zbbtb" => round($zS['zbbtb'], 2)
                    ],
                    [
                        "id" => $_SESSION['id_anak']
                    ]
                );
            }

            redirect('DDS/index/tambahriwayat');
        }
        redirect('DDS');
    }

    function deleteAnak($content = "")
    {
        if (isset($_POST['submit'])) {
            $dataAnak = $this->M_DDS->getAnak('WHERE anak.id = "' . $_SESSION['id_anak'] . '"');
            $file = "test.txt";
            foreach ($dataAnak as $data) {
                $file = $data['foto'];
            }
            unlink($file);
            $this->M_DDS_Update->deleteData(
                "record",
                [
                    "id_anak" => $_POST['inputId']
                ]
            );
            $this->M_DDS_Update->deleteData(
                "anak",
                [
                    "id" => $_POST['inputId']
                ]
            );
            if ($content == "tambahanak") {
                redirect('DDS/index/daftaranakibu');
            }
            redirect('DDS/index/home');
        }
        redirect('DDS');
    }

    function deleteIbu()
    {
        if (isset($_POST['submit'])) {
            $dataAnak = $this->M_DDS->getAnak("where id_ibu = " . $_POST['inputId']);
            foreach ($dataAnak as $a) {
                $this->M_DDS_Update->deleteData(
                    "record",
                    [
                        "id_anak" => $a['id']
                    ]
                );
            }
            $file = "test.txt";
            foreach ($dataAnak as $data) {
                $file = $data['foto'];
                unlink($file);
            }
            $this->M_DDS_Update->deleteData(
                "anak",
                [
                    "id_ibu" => $_POST['inputId']
                ]
            );
            $this->M_DDS_Update->deleteData(
                "ibu",
                [
                    "id" => $_POST['inputId']
                ]
            );
            redirect('DDS/index/tambahanak');
        }
        redirect('DDS');
    }

    function deletePosyandu()
    {
        if (isset($_POST['submit'])) {
            $dataIbu = $this->M_DDS->getIbu(" Where id_pos = " . $_POST['id_pos']);
            foreach ($dataIbu as $i) {
                $dataAnak = $this->M_DDS->getAnak("where id_ibu = " . $i['id']);
                foreach ($dataAnak as $a) {
                    $this->M_DDS_Update->deleteData(
                        "record",
                        [
                            "id_anak" => $a['id']
                        ]
                    );
                }
                $file = "test.txt";
                foreach ($dataAnak as $data) {
                    $file = $data['foto'];
                    unlink($file);
                }
                $this->M_DDS_Update->deleteData(
                    "anak",
                    [
                        "id_ibu" => $i['id']
                    ]
                );
                $this->M_DDS_Update->deleteData(
                    "ibu",
                    [
                        "id" => $i['id']
                    ]
                );
            }
            $this->M_DDS_Update->deleteData(
                "posyandu",
                [
                    "id" => $_POST['id_pos']
                ]
            );
            redirect('DDS/index/daftarposyandu');
        }
        redirect('DDS');
    }

    function deleteAdmin()
    {
        if (isset($_POST['submit'])) {
            $this->M_DDS_Update->deleteData(
                "ibu",
                [
                    "id" => $_POST['inputId']
                ]
            );
            redirect('DDS/index/daftarkader');
        }
        redirect('DDS');
    }

    function updatePosyandu($content = "")
    {
        $updateS =
            "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            Data <strong>Berhasil!</strong> Diupdate.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        $updateG =
            "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Gagal Update!</strong>.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        if (isset($_POST['submit'])) {
            if ($this->M_DDS_Update->updateData(
                "posyandu",
                [
                    "nama" => $_POST['inputNama'],
                    "kodepos" => $_POST['inputKode'],
                    "alamat" => $_POST['inputAlamat']
                ],
                [
                    "id" => $_SESSION['id_pos']
                ]
            )) {
                $this->session->set_flashdata("update", $updateS);
                redirect('DDS/index/editPosyandu');
            } else {
                $this->session->set_flashdata("update", $updateG);
                redirect('DDS/index/editPosyandu');
            }
        }
        redirect('DDS');
    }

    function hitungZscore($umur, $bb, $tb, $jk, $ju)
    {
        if ($ju == "b" && $umur < 24) {
            $tb = $tb + 0.7;
        } else if ($ju == "t" && $umur > 24) {
            $tb = $tb - 0.7;
        }
        //select data
        $taksirTinggi = 0;
        $t1 = (int) $tb;
        $t2 = $t1 + 0.5;
        $t3 = $t1 + 1;
        $rowx = 0;
        $taksir1 = abs($tb -  $t1);
        $taksir2 = abs($tb -  $t2);
        $taksir3 = abs($tb -  $t3);
        $min = min($taksir1, $taksir2, $taksir3);
        if ($min == $taksir1) {
            $taksirTinggi = $t1;
        } else if ($min == $taksir2) {
            $taksirTinggi = $t2;
        } else if ($min == $taksir3) {
            $taksirTinggi = $t3;
        }

        $dataBB = $dataBBTB = $dataTB = $dataIMT = 0;

        if ($jk == "l") {
            if ($umur < 25) {
                $dataBBTB = $this->M_DDS->getBBTBALU024('where tinggi =' . $taksirTinggi);
            } else {
                $dataBBTB = $this->M_DDS->getBBTBALU2560('where tinggi =' . $taksirTinggi);
            }

            $dataBB = $this->M_DDS->getBBALU060('where umur =' . $umur);
            if ($umur != 24) {
                $dataTB = $this->M_DDS->getTBALU060('where umur =' . $umur);
                $dataIMT = $this->M_DDS->getIMTALU060('where umur =' . $umur);
            } else if ($ju == "t") {
                $dataTB = $this->M_DDS->getTBALU060('where umur = 24');
                $dataIMT = $this->M_DDS->getIMTALU060('where umur = 24');
            } else if ($ju == "b") {
                $dataTB = $this->M_DDS->getTBALU060('where umur = 24.5');
                $dataIMT = $this->M_DDS->getIMTALU060('where umur = 24.5');
            }
        } else if ($jk == "p") {
            if ($umur < 25) {
                $dataBBTB = $this->M_DDS->getBBTBAPU024('where tinggi =' . $taksirTinggi);
            } else {
                $dataBBTB = $this->M_DDS->getBBTBAPU2560('where tinggi =' . $taksirTinggi);
            }

            $dataBB = $this->M_DDS->getBBAPU060('where umur =' . $umur);
            if ($umur != 24) {
                $dataTB = $this->M_DDS->getTBAPU060('where umur =' . $umur);
                $dataIMT = $this->M_DDS->getIMTAPU060('where umur =' . $umur);
            } else if ($ju == "t") {
                $dataTB = $this->M_DDS->getTBAPU060('where umur = 24');
                $dataIMT = $this->M_DDS->getIMTAPU060('where umur = 24');
            } else if ($ju == "b") {
                $dataTB = $this->M_DDS->getTBAPU060('where umur = 24.5');
                $dataIMT = $this->M_DDS->getIMTAPU060('where umur = 24.5');
            }
        }

        //DATA BB BAYI

        $simpBR = false; //Untuk Mengecek sama dengan Median

        $msd1['BB'] = $med['BB'] = $sd1['BB'] = "";
        $msd3['BB'] = $msd2['BB'] = $sd2['BB'] = $sd3['BB'] = "";

        $simpB1 = 0;
        $simpB2 = 0;
        $sts['BB'] = "";
        $zS['BB'] = 0;

        //IMT
        $imt = ($bb) / pow($tb / 100, 2);

        foreach ($dataBB as $row) {
            $msd3['BB'] = $row['-3sd'];
            $msd2['BB'] = $row['-2sd'];
            $msd1['BB'] = $row['-1sd'];
            $med['BB'] = $row['median'];
            $sd1['BB'] = $row['+1sd'];
            $sd2['BB'] = $row['+2sd'];
            $sd3['BB'] = $row['+3sd'];
        }
        if ($bb == $med['BB']) {
            $simpBR = true;
        }
        if ($bb < $med['BB']) {
            $simpB1 = $med['BB'];
            $simpB2 = $msd1['BB'];
        } else if ($bb > $med['BB']) {
            $simpB2 = $med['BB'];
            $simpB1 = $sd1['BB'];
        }
        if ($bb == $med['BB']) {
            $zS['BB'] = 0;
        } else {
            $zS['BB'] = ($bb - $med['BB']) / ($simpB1 - $simpB2);
        }

        if ($zS['BB'] < -3) {
            $sts['BB'] = "Gizi Buruk";
        } else if ($zS['BB'] > 2) {
            $sts['BB'] = "Gizi Lebih";
        } else if ($zS['BB'] < -2) {
            $sts['BB'] = "Gizi Kurang";
        } else if ($zS['BB'] <= 2 && $zS['BB'] >= -2) {
            $sts['BB'] = "Gizi Baik";
        }

        //TB/U
        $msd1['TB'] = $med['TB'] = $sd1['TB'] = "";
        $msd3['TB'] = $msd2['TB'] = $sd2['TB'] = $sd3['TB'] = "";
        $simpBR = false;
        $sts['TB'] = "";
        $zS['TB'] = 0;

        foreach ($dataTB as $row) {
            $msd3['TB'] = $row['-3sd'];
            $msd2['TB'] = $row['-2sd'];
            $msd1['TB'] = $row['-1sd'];
            $med['TB'] = $row['median'];
            $sd1['TB'] = $row['+1sd'];
            $sd2['TB'] = $row['+2sd'];
            $sd3['TB'] = $row['+3sd'];
        }
        if ($tb == $med['TB']) {
            $simpBR = true;
        }
        if ($tb < $med['TB']) {
            $simpB1 = $med['TB'];
            $simpB2 = $msd1['TB'];
        } else if ($tb > $med['TB']) {
            $simpB2 = $med['TB'];
            $simpB1 = $sd1['TB'];
        }
        if ($tb == $med['TB']) {
            $zS['TB'] = 0;
        } else {
            $zS['TB'] = ($tb - $med['TB']) / ($simpB1 - $simpB2);
        }

        if ($zS['TB'] < -3) {
            $sts['TB'] = "Sangat Pendek";
        } else if ($zS['TB'] > 2) {
            $sts['TB'] = "Tinggi";
        } else if ($zS['TB'] < -2) {
            $sts['TB'] = "Pendek";
        } else if ($zS['TB'] <= 2 && $zS['TB'] >= -2) {
            $sts['TB'] = "Normal";
        }

        //IMT/U
        $msd1['IMT'] = $med['IMT'] = $sd1['IMT'] = "";
        $msd3['IMT'] = $msd2['IMT'] = $sd2['IMT'] = $sd3['IMT'] = "";
        $simpBR = false;
        $sts['IMT'] = "";
        $zS['IMT'] = 0;

        foreach ($dataIMT as $row) {
            $msd3['IMT'] = $row['-3sd'];
            $msd2['IMT'] = $row['-2sd'];
            $msd1['IMT'] = $row['-1sd'];
            $med['IMT'] = $row['median'];
            $sd1['IMT'] = $row['+1sd'];
            $sd2['IMT'] = $row['+2sd'];
            $sd3['IMT'] = $row['+3sd'];
        }
        if ($imt == $med['IMT']) {
            $simpBR = true;
        }
        if ($imt < $med['IMT']) {
            $simpB1 = $med['IMT'];
            $simpB2 = $msd1['IMT'];
        } else if ($imt > $med['IMT']) {
            $simpB2 = $med['IMT'];
            $simpB1 = $sd1['IMT'];
        }
        if ($imt == $med['IMT']) {
            $zS['IMT'] = 0;
        } else {
            $zS['IMT'] = ($imt - $med['IMT']) / ($simpB1 - $simpB2);
        }

        if ($zS['IMT'] < -3) {
            $sts['IMT'] = "Sangat Kurus";
        } else if ($zS['IMT'] > 2) {
            $sts['IMT'] = "Gemuk";
        } else if ($zS['IMT'] < -2) {
            $sts['IMT'] = "Kurus";
        } else if ($zS['IMT'] <= 2 && $zS['IMT'] >= -2) {
            $sts['IMT'] = "Normal";
        }

        //BB/TB
        $msd1['BBTB'] = $med['BBTB'] = $sd1['BBTB'] = "";
        $msd3['BBTB'] = $msd2['BBTB'] = $sd2['BBTB'] = $sd3['BBTB'] = "";
        $simpBR = false;
        $sts['BBTB'] = "";
        $zS['BBTB'] = 0;
        $check = false;

        foreach ($dataBBTB as $row) {
            $msd3['BBTB'] = $row['-3sd'];
            $msd2['BBTB'] = $row['-2sd'];
            $msd1['BBTB'] = $row['-1sd'];
            $med['BBTB'] = $row['median'];
            $sd1['BBTB'] = $row['+1sd'];
            $sd2['BBTB'] = $row['+2sd'];
            $sd3['BBTB'] = $row['+3sd'];
            $rowx = $rowx + 1;
        }

        if ($rowx != 0) {
            if ($bb == $med['BBTB']) {
                $simpBR = true;
            }
            if ($bb < $med['BBTB']) {
                $simpB1 = $med['BBTB'];
                $simpB2 = $msd1['BBTB'];
            } else if ($bb > $med['BBTB']) {
                $simpB2 = $med['BBTB'];
                $simpB1 = $sd1['BBTB'];
            }
            if ($bb == $med['BBTB']) {
                $zS['BBTB'] = 0;
            } else {
                $zS['BBTB'] = ($bb - $med['BBTB']) / ($simpB1 - $simpB2);
            }
        } else {
            $msd1['BBTB'] =  $med['BBTB'] = $sd1['BBTB'] = "N/A";
            $msd3['BBTB'] = $msd2['BBTB'] = $sd2['BBTB'] = $sd3['BBTB'] = "N/A";
        }

        if ($zS['BBTB'] < -3) {
            $sts['BBTB'] = "Sangat Kurus";
        } else if ($zS['BBTB'] > 2) {
            $sts['BBTB'] = "Gemuk";
        } else if ($zS['BBTB'] < -2) {
            $sts['BBTB'] = "Kurus";
        } else if ($zS['BBTB'] <= 2 && $zS['BBTB'] >= -2) {
            $sts['BBTB'] = "Normal";
        }

        if ($rowx == 0) {
            $sts['BBTB'] = "Tidak Terdefinisi";
            $zS['BBTB'] = "999999";
            $check = true;
        }
        return $zS;
    }
}
