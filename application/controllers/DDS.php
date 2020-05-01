<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DDS extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index($page = "")
    {
        if (!isset($_SESSION['id_ibu'])) {
            $_SESSION['id_ibu'] = 0;
        }
        $bulan = [1 => "JANUARI", "FEBRUARI", "MARET", "APRIL", "MEI", "JUNI", "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", "DESEMBER"];
        $title = $page;
        $dataIbu = "";
        $dataAnak = "";
        $dataAnakId = "";
        $dataRecord = "";
        $dataRecordId = "";
        $dataRekomendasi = "";
        $dataPosyandu = $this->M_DDS->getPosyandu(' where id != 666');
        $cek = isset($_SESSION['level']);
        if (isset($_SESSION['level'])) {
            $cek = $_SESSION['level'];
        }
        if (isset($_SESSION['id'])) {
            $dataIbu = $this->M_DDS->getIbu(" where ibu.id = " . "'" . $_SESSION['id'] . "'");
            $dataIbuPos = $this->M_DDS->getIbu(" where id_pos = " . "'" . $_SESSION['id_pos'] . "' and hak = '1'");
            if ($_SESSION['id_pos'] != "-1") {
                $dataIbuAdmin = $this->M_DDS->getIbu(" where hak = '2' and id_pos = " . "'" . $_SESSION['id_pos'] . "'");
            } else {
                $dataIbuAdmin = $this->M_DDS->getIbu(" where hak = '2' ");
            }
            if ($_SESSION['level'] == 1) {
                $dataAnak = $this->M_DDS->getAnak(" where id_ibu = " . "'" . $_SESSION['id'] . "'");
            } else if ($_SESSION['level'] == 2 || $_SESSION['level'] == 3) {
                if ($_SESSION['id_pos'] != "-1") {
                    $dataAnak = $this->M_DDS->getAnak(" where id_pos = " . "'" . $_SESSION['id_pos'] . "' order by id");
                } else {
                    $dataAnak = $this->M_DDS->getAnak("");
                }
            }
        }
        if (isset($_SESSION['id_anak'])) {
            $dataAnakId = $this->M_DDS->getAnak(" where id_ibu = " . "'" . $_SESSION['id_ibu'] . "'" . "and anak.id =" . "'" . $_SESSION['id_anak'] . "'");
            $dataRecord = $this->M_DDS->getRecord(" where id_anak = " . "'" . $_SESSION['id_anak'] . "' ORDER BY usia");
            $dataRecordId = $this->M_DDS->getRecord(" where id_anak = " . "'" . $_SESSION['id_anak'] . "'" . " ORDER BY usia desc LIMIT 1");
            $usiaRekomendasi = "";
            foreach ($dataRecordId as $d) {
                $usiaRekomendasi = $d['usia'];
            }
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
        }
        switch ($page) {
            case "":
                if (!$cek) {
                    $title = "homepage";
                    $this->load->view('homepage/header.php', ['title' => $title]);
                    $this->load->view('homepage/home.php');
                    $this->load->view('homepage/footer.php');
                    break;
                } else {
                    redirect("DDS/index/home");
                }
            case "login":
                if (!$cek) {
                    $this->load->view('login.php');
                    break;
                } else {
                    redirect("DDS/index/home");
                }
                break;

                //HOMEPAGE
            case "about":
                if (!$cek) {
                    $this->load->view('homepage/header.php', ['title' => $title]);
                    $this->load->view('homepage/about.php');
                    $this->load->view('homepage/footer.php');
                    break;
                } else {
                    redirect("DDS/index/home");
                }
            case "blog":
                if (!$cek) {
                    $this->load->view('homepage/header.php', ['title' => $title]);
                    $this->load->view('homepage/blog.php');
                    $this->load->view('homepage/footer.php');
                    break;
                } else {
                    redirect("DDS/index/home");
                }
            case "contact":
                if (!$cek) {
                    $this->load->view('homepage/header.php', ['title' => $title]);
                    $this->load->view('homepage/contact.php');
                    $this->load->view('homepage/footer.php');
                    break;
                } else {
                    redirect("DDS/index/home");
                }
            case "portofolioSingle":
                if (!$cek) {
                    $this->load->view('homepage/header.php', ['title' => $title]);
                    $this->load->view('homepage/portfolio-single.php');
                    $this->load->view('homepage/footer.php');
                    break;
                } else {
                    redirect("DDS/index/home");
                }
            case "portofolio":
                if (!$cek) {
                    $this->load->view('homepage/header.php', ['title' => $title]);
                    $this->load->view('homepage/portfolio.php');
                    $this->load->view('homepage/footer.php');
                    break;
                } else {
                    redirect("DDS/index/home");
                }
            case "services":
                if (!$cek) {
                    $this->load->view('homepage/header.php', ['title' => $title]);
                    $this->load->view('homepage/services.php');
                    $this->load->view('homepage/footer.php');
                    break;
                } else {
                    redirect("DDS/index/home");
                }
            case "singleBlog":
                if (!$cek) {
                    $this->load->view('homepage/header.php', ['title' => $title]);
                    $this->load->view('homepage/single-blog.php');
                    $this->load->view('homepage/footer.php');
                    break;
                } else {
                    redirect("DDS/index/home");
                }
                //HOMEPAGE

                //? DOKUMENTASI
            case "superadmin":
                $this->load->view('dokumentasi/header.php', ['title' => $title]);
                $this->load->view('dokumentasi/superadmin.php');
                $this->load->view('dokumentasi/footer.php');
                break;
            case "admin":
                $this->load->view('dokumentasi/header.php', ['title' => $title]);
                $this->load->view('dokumentasi/admin.php');
                $this->load->view('dokumentasi/footer.php');
                break;
            case "user":
                $this->load->view('dokumentasi/header.php', ['title' => $title]);
                $this->load->view('dokumentasi/user.php');
                $this->load->view('dokumentasi/footer.php');
                break;
                //? DOKUMENTASI

            case "hitungcepat":
                $this->load->view('hitungcepat.php');
                $this->load->view('user/footer.php');
                break;
            case "home":
                if ($cek == 1) {
                    $jk = "";
                    $usia = "";
                    $standar = "";
                    if (isset($_SESSION['id_anak'])) {
                        foreach ($dataAnakId as $d) {
                            $jk = $d['jenis_kelamin'];
                        }
                        foreach ($dataRecordId as $d) {
                            $usia = $d['usia'];
                        }
                        $standar = $this->getStandarBBTB($jk, $usia);
                    }
                    $this->load->view('user/header.php', ['title' => $title, 'ibu' => $dataIbu]);
                    $this->load->view('user/home.php', ['title' => $title, 'ibu' => $dataIbu, 'anak' => $dataAnakId, "record" => $dataRecordId, "standar" => $standar]);
                    $this->load->view('user/footer.php', ['ibu' => $dataIbu]);
                    break;
                } else if ($cek == 2) {
                    $cek = [];
                    $icr = 1;
                    foreach ($dataAnak as $a) {
                        $usia_skrg = $usia_record = 0;
                        $diff = date_diff(date_create($a['tgl_lahir']), date_create(date('Y-m-d')));
                        $usia_skrg = $diff->days / 30;
                        $dataRecordId = $this->M_DDS->getRecord(" where id_anak = " . "'" . $a['id'] . "'" . " ORDER BY usia desc LIMIT 1");
                        foreach ($dataRecordId as $d) {
                            $usia_record = $d['usia'];
                        }
                        if ((int) $usia_skrg == (int) $usia_record) {
                            $cek[$icr] = false;
                        } else {
                            $cek[$icr] = true;
                        }
                        $icr++;
                    }
                    $this->load->view('admin/header.php', ['title' => $title, 'ibu' => $dataIbu]);
                    $this->load->view('admin/home.php', ['cek' => $cek, 'anak' => $dataAnak]);
                    $this->load->view('admin/footer.php', ['ibu' => $dataIbu]);
                    break;
                } else if ($cek == 3) {
                    $cek = [];
                    $icr = 1;
                    foreach ($dataAnak as $a) {
                        $usia_skrg = $usia_record = 0;
                        $diff = date_diff(date_create($a['tgl_lahir']), date_create(date('Y-m-d')));
                        $usia_skrg = $diff->days / 30;
                        $dataRecordId = $this->M_DDS->getRecord(" where id_anak = " . "'" . $a['id'] . "'" . " ORDER BY usia desc LIMIT 1");
                        foreach ($dataRecordId as $d) {
                            $usia_record = $d['usia'];
                        }
                        if ((int) $usia_skrg == (int) $usia_record) {
                            $cek[$icr] = false;
                        } else {
                            $cek[$icr] = true;
                        }
                        $icr++;
                    }
                    // $dataRecordId= $this->M_DDS->getRecord("ORDER BY id_anak");
                    $this->load->view('superadmin/header.php', ['title' => $title, 'ibu' => $dataIbu, 'pos' => $dataPosyandu]);
                    $this->load->view('superadmin/home.php', ['cek' => $cek, 'anak' => $dataAnak]);
                    $this->load->view('superadmin/footer.php', ['ibu' => $dataIbu]);
                    break;
                } else {
                    redirect("DDS");
                }
            case "daftarriwayat":
                if ($cek == 1) {
                    $this->load->view('user/header.php', ['title' => $title, 'ibu' => $dataIbu]);
                    $this->load->view('user/recordlist.php', ['bulan' => $bulan, 'title' => $title, 'ibu' => $dataIbu, 'anak' => $dataAnakId, "record" => $dataRecord]);
                    $this->load->view('user/footer.php', ['ibu' => $dataIbu]);
                    break;
                } else if ($cek == 2) {
                    $this->load->view('admin/header.php', ['title' => $title, 'ibu' => $dataIbu]);
                    $this->load->view('admin/daftarriwayat.php', ['bulan' => $bulan, 'title' => $title, 'ibu' => $dataIbu, 'anak' => $dataAnakId, "record" => $dataRecord]);
                    $this->load->view('admin/footer.php', ['ibu' => $dataIbu]);
                    break;
                } else if ($cek == 3) {
                    $this->load->view('superadmin/header.php', ['title' => $title, 'ibu' => $dataIbu, 'pos' => $dataPosyandu]);
                    $this->load->view('superadmin/daftarriwayat.php', ['bulan' => $bulan, 'title' => $title, 'ibu' => $dataIbu, 'anak' => $dataAnakId, "record" => $dataRecord]);
                    $this->load->view('superadmin/footer.php', ['ibu' => $dataIbu]);
                    break;
                } else {
                    redirect("DDS");
                }
            case "daftaranak":
                if ($cek == 1) {
                    $this->load->view('user/header.php', ['title' => $title, 'ibu' => $dataIbu]);
                    $this->load->view('user/listanak.php', ['title' => $title, 'ibu' => $dataIbu, 'anak' => $dataAnak]);
                    $this->load->view('user/footer.php', ['ibu' => $dataIbu]);
                    break;
                } else {
                    redirect("DDS");
                }
            case "daftaranakibu":
                if ($cek == 2) {
                    $cek = [];
                    $icr = 1;
                    foreach ($dataAnak as $a) {
                        $usia_skrg = $usia_record = 0;
                        $diff = date_diff(date_create($a['tgl_lahir']), date_create(date('Y-m-d')));
                        $usia_skrg = $diff->days / 30;
                        $dataRecordId = $this->M_DDS->getRecord(" where id_anak = " . "'" . $a['id'] . "'" . " ORDER BY usia desc LIMIT 1");
                        foreach ($dataRecordId as $d) {
                            $usia_record = $d['usia'];
                        }
                        if ((int) $usia_skrg == (int) $usia_record) {
                            $cek[$icr] = false;
                        } else {
                            $cek[$icr] = true;
                        }
                        $icr++;
                    }
                    $dataIbuId = $this->M_DDS->getIbu(" where ibu.id = " . "'" . $_SESSION['id_ibu'] . "'");
                    $dataAnak = $this->M_DDS->getAnak(" where id_ibu = " . "'" . $_SESSION['id_ibu'] . "'");
                    $this->load->view('admin/header.php', ['title' => "tambahanak", 'ibu' => $dataIbu]);
                    $this->load->view('admin/listanakibu.php', ['cek' => $cek, 'ibu' => $dataIbuId, 'anak' => $dataAnak]);
                    $this->load->view('admin/footer.php', ['ibu' => $dataIbu]);
                    break;
                }
            case "tambahanak":
                if ($cek == 2) {
                    $jmlAnak = [];
                    $icr = 1;

                    foreach ($dataIbuPos as $d) {
                        $dataAnak = $this->M_DDS->getAnak(" where id_ibu = " . "'" . $d['id'] . "'");
                        $jmlAnak[$icr] = count($dataAnak);
                        $icr++;
                    }
                    $this->load->view('admin/header.php', ['title' => $title, 'ibu' => $dataIbu]);
                    $this->load->view('admin/listibu.php', ['ibu' => $dataIbuPos, 'jml' => $jmlAnak]);
                    $this->load->view('admin/footer.php', ['ibu' => $dataIbu]);
                    break;

                    //CONTOH//
                    // }else if($cek == 1){
                    //     $this->load->view('user/header.php',['title' => $title, 'ibu' => $dataIbu]);
                    //     $this->load->view('user/tambahanak.php',['title' => $title, 'ibu' => $dataIbu]);
                    //     $this->load->view('user/footer.php');
                    //     break;
                    //CONTOH//

                } else {
                    redirect("DDS");
                }
            case "tambahanakibu":
                if ($cek == 2) {
                    $dataIbuId = $this->M_DDS->getIbu(" where ibu.id = " . "'" . $_SESSION['id_ibu'] . "'");
                    $this->load->view('admin/header.php', ['title' => "tambahanak", 'ibu' => $dataIbu]);
                    $this->load->view('admin/tambahanakibu.php', ['ibu' => $dataIbuId]);
                    $this->load->view('admin/footer.php', ['ibu' => $dataIbu]);
                    break;
                } else {
                    redirect("DDS");
                }
            case "tambahibu":
                if ($cek == 2) {
                    $this->load->view('admin/header.php', ['title' => "tambahanak", 'ibu' => $dataIbu]);
                    $this->load->view('admin/tambahibu.php', ['ibu' => $dataIbuPos]);
                    $this->load->view('admin/footer.php', ['ibu' => $dataIbu]);
                    break;
                } else {
                    redirect("DDS");
                }
            case "tambahkader":
                if ($cek == 3) {
                    $this->load->view('superadmin/header.php', ['title' => $title, 'ibu' => $dataIbu, 'pos' => $dataPosyandu]);
                    $this->load->view('superadmin/tambahadmin.php', ['ibu' => $dataIbuPos]);
                    $this->load->view('superadmin/footer.php', ['ibu' => $dataIbu]);
                    break;
                } else {
                    redirect("DDS");
                }
            case "tambahposyandu":
                if ($cek == 3) {
                    $this->load->view('superadmin/header.php', ['title' => $title, 'ibu' => $dataIbu, 'pos' => $dataPosyandu]);
                    $this->load->view('superadmin/tambahposyandu.php', ['ibu' => $dataIbuPos]);
                    $this->load->view('superadmin/footer.php', ['ibu' => $dataIbu]);
                    break;
                } else {
                    redirect("DDS");
                }
            case "daftarkader":
                if ($cek == 3) {
                    $this->load->view('superadmin/header.php', ['title' => $title, 'ibu' => $dataIbu, 'pos' => $dataPosyandu]);
                    $this->load->view('superadmin/listadmin.php', ['ibu' => $dataIbuAdmin, 'pos' => $dataPosyandu]);
                    $this->load->view('superadmin/footer.php', ['ibu' => $dataIbu]);
                    break;
                } else {
                    redirect("DDS");
                }
            case "daftarposyandu":
                if ($cek == 3) {
                    $jmlAnak = [];
                    $icr = 1;
                    
                    foreach ($dataPosyandu as $p) {
                        $emak = $this->M_DDS->getIbu(" where id_pos = " . "'" . $p['id'] . "'");
                        $jmlAnak[$icr] = 0;
                        foreach ($emak as $e) {
                            $dataAnak = $this->M_DDS->getAnak(" where id_ibu = " . "'" . $e['id'] . "'");
                            $jmlAnak[$icr] = $jmlAnak[$icr] + count($dataAnak);
                        }
                        $icr++;
                    }
                    // print_r($jmlAnak);
                    $this->load->view('superadmin/header.php', ['title' => $title, 'ibu' => $dataIbu, 'pos' => $dataPosyandu]);
                    $this->load->view('superadmin/listposyandu.php', ['jml' => $jmlAnak, 'pos' => $dataPosyandu]);
                    $this->load->view('superadmin/footer.php', ['ibu' => $dataIbu]);
                    break;
                } else {
                    redirect("DDS");
                }

                //CONTOH//
                // case "register": 
                //     if(!$cek){ 
                //         $this->load->view('user/register.php'); 
                //         break;
                //     }else{
                //         redirect("DDS/index/home");
                //     }
                //CONTOH//

            case "statusanak":
                $jk = "";
                $usia = "";
                $standar = "";
                if (isset($_SESSION['id_anak'])) {
                    foreach ($dataAnakId as $d) {
                        $jk = $d['jenis_kelamin'];
                    }
                    foreach ($dataRecordId as $d) {
                        $usia = $d['usia'];
                    }
                    $standar = $this->getStandarBBTB($jk, $usia);
                }
                if ($cek == 2) {
                    $dataIbuId = $this->M_DDS->getIbu(" where ibu.id = " . "'" . $_SESSION['id_ibu'] . "'");
                    $this->load->view('admin/header.php', ['title' => $title, 'ibu' => $dataIbu, 'ibu2' => $dataIbuId]);
                    $this->load->view('admin/statusanak.php', ['standar' => $standar, 'ibu' => $dataIbu, 'anak' => $dataAnakId, "record" => $dataRecordId]);
                    $this->load->view('admin/footer.php', ['ibu' => $dataIbu]);
                    break;
                } else if ($cek == 3) {
                    $dataIbuId = $this->M_DDS->getIbu(" where ibu.id = " . "'" . $_SESSION['id_ibu'] . "'");
                    $this->load->view('superadmin/header.php', ['title' => $title, 'ibu' => $dataIbu, 'ibu2' => $dataIbuId, 'pos' => $dataPosyandu]);
                    $this->load->view('superadmin/statusanak.php', ['standar' => $standar, 'anak' => $dataAnakId, "record" => $dataRecordId]);
                    $this->load->view('superadmin/footer.php', ['ibu' => $dataIbu]);
                    break;
                } else {
                    redirect("DDS");
                }
            case "tambahriwayat":
                if ($cek == 2) {
                    $this->load->view('admin/header.php', ['title' => $title, 'ibu' => $dataIbu]);
                    $this->load->view('admin/tambahrecord.php', ['ibu' => $dataIbu, 'anak' => $dataAnakId]);
                    $this->load->view('admin/footer.php', ['ibu' => $dataIbu]);
                    break;

                    //CONTOH//
                    // }else if($cek == 1){
                    //     $this->load->view('user/header.php',['title' => $title, 'ibu' => $dataIbu]);
                    //     $this->load->view('user/tambahrecord.php',['title' => $title, 'ibu' => $dataIbu, 'anak' => $dataAnakId]);
                    //     $this->load->view('user/footer.php');
                    //     break;
                    //CONTOH//

                } else {
                    redirect("DDS");
                }
            case "editanak":
                if ($cek == 2 && isset($_SESSION['id_anak'])) {
                    $this->load->view('admin/header.php', ['title' => $title, 'ibu' => $dataIbu]);
                    $this->load->view('admin/editanak.php', ['ibu' => $dataIbu, 'anak' => $dataAnakId]);
                    $this->load->view('admin/footer.php', ['ibu' => $dataIbu]);
                    break;
                } else {
                    redirect("DDS");
                }
            case "editIbu":
                if ($cek == 2) {
                    $dataIbuId = $this->M_DDS->getIbu(" where ibu.id = " . "'" . $_SESSION['id_ibu'] . "'");
                    $this->load->view('admin/header.php', ['title' => $title, 'ibu' => $dataIbu]);
                    $this->load->view('admin/editIbu.php', ['ibu' => $dataIbuId]);
                    $this->load->view('admin/footer.php', ['ibu' => $dataIbu]);
                    break;
                } else {
                    redirect("DDS");
                }
            case "editPosyandu":
                if ($cek == 3) {
                    if ($_SESSION['id_pos'] == -1) {
                        redirect('DDS/index/daftarposyandu');
                    }
                    $dataPosyanduId = $this->M_DDS->getPosyandu(' where id = "' . $_SESSION['id_pos'] . '"');
                    $this->load->view('superadmin/header.php', ['title' => $title, 'ibu' => $dataIbu, 'pos' => $dataPosyandu]);
                    $this->load->view('superadmin/editPosyandu.php', ['pos2' => $dataPosyanduId]);
                    $this->load->view('superadmin/footer.php');
                    break;
                } else {
                    redirect("DDS");
                }
            case "upload":
                if ($cek == 1) {
                    $this->load->view('user/header.php', ['title' => $title, 'ibu' => $dataIbu]);
                    $this->load->view('user/uploadFoto.php', ['anak' => $dataAnakId]);
                    $this->load->view('user/footer.php');
                    break;
                } else {
                    redirect("DDS");
                }
            case "rekomendasi":
                if ($cek == 1) {
                    $this->load->view('user/header.php', ['title' => $title, 'ibu' => $dataIbu]);
                    $this->load->view('user/rekomendasi.php', ['ibu' => $dataIbu, 'anak' => $dataAnakId, 'rekomendasi' => $dataRekomendasi]);
                    $this->load->view('user/footer.php');
                    break;
                } else {
                    redirect("DDS");
                }
            case "artikel":
                $this->load->view('user/artikel/index.php', ['title' => $title]);
                break;
            default:
                redirect("404_override");
        }
    }

    function getStandarBBTB($jk, $umur)
    {
        if (isset($_SESSION['id_anak'])) {
            $dataBB = "";
            $dataTB = "";
            $standar = [];
            if ($jk == "l") {
                $dataBB = $this->M_DDS->getBBALU060('where umur =' . $umur);
                $dataTB = $this->M_DDS->getTBALU060('where umur =' . $umur);
            } else if ($jk == "p") {
                $dataBB = $this->M_DDS->getBBAPU060('where umur =' . $umur);
                $dataTB = $this->M_DDS->getTBAPU060('where umur =' . $umur);
            }
            foreach ($dataBB as $d) {
                $standar['BB'] = $d['median'];
            }
            foreach ($dataTB as $d) {
                $standar['TB'] = $d['median'];
            }
            return $standar;
        } else {
            redirect("DDS");
        }
    }

    function hitungcepat()
    {
        if (isset($_GET['submit'])) {

            $umur = $_GET['inputUmur'];
            $tinggi = $_GET['inputTB'];
            if ($_GET['inputJU'] == "b" && $umur < 24) {
                $tinggi = $tinggi + 0.7;
            } else if ($_GET['inputJU'] == "t" && $umur > 24) {
                $tinggi = $tinggi - 0.7;
            }
            //select data
            $taksirTinggi = 45;
            $t1 = (int) $tinggi;
            $t2 = $t1 + 0.5;
            $t3 = $t1 + 1;
            $rowx = 0;
            $taksir1 = abs($tinggi -  $t1);
            $taksir2 = abs($tinggi -  $t2);
            $taksir3 = abs($tinggi -  $t3);
            $min = min($taksir1, $taksir2, $taksir3);
            if ($min == $taksir1) {
                $taksirTinggi = $t1;
            } else if ($min == $taksir2) {
                $taksirTinggi = $t2;
            } else if ($min == $taksir3) {
                $taksirTinggi = $t3;
            }

            $dataBB = $dataBBTB = $dataTB = $dataIMT = 0;

            if ($_GET['inputJK'] == "l") {
                if ($umur < 25) {
                    $dataBBTB = $this->M_DDS->getBBTBALU024('where tinggi =' . $taksirTinggi);
                } else {
                    $dataBBTB = $this->M_DDS->getBBTBALU2560('where tinggi =' . $taksirTinggi);
                }

                $dataBB = $this->M_DDS->getBBALU060('where umur =' . $umur);
                if ($umur != 24) {
                    $dataTB = $this->M_DDS->getTBALU060('where umur =' . $umur);
                    $dataIMT = $this->M_DDS->getIMTALU060('where umur =' . $umur);
                } else if ($_GET['inputJU'] == "t") {
                    $dataTB = $this->M_DDS->getTBALU060('where umur = 24');
                    $dataIMT = $this->M_DDS->getIMTALU060('where umur = 24');
                } else if ($_GET['inputJU'] == "b") {
                    $dataTB = $this->M_DDS->getTBALU060('where umur = 24.5');
                    $dataIMT = $this->M_DDS->getIMTALU060('where umur = 24.5');
                }
            } else if ($_GET['inputJK'] == "p") {
                if ($umur < 25) {
                    $dataBBTB = $this->M_DDS->getBBTBAPU024('where tinggi =' . $taksirTinggi);
                } else {
                    $dataBBTB = $this->M_DDS->getBBTBAPU2560('where tinggi =' . $taksirTinggi);
                }

                $dataBB = $this->M_DDS->getBBAPU060('where umur =' . $umur);
                if ($umur != 24) {
                    $dataTB = $this->M_DDS->getTBAPU060('where umur =' . $umur);
                    $dataIMT = $this->M_DDS->getIMTAPU060('where umur =' . $umur);
                } else if ($_GET['inputJU'] == "t") {
                    $dataTB = $this->M_DDS->getTBAPU060('where umur = 24');
                    $dataIMT = $this->M_DDS->getIMTAPU060('where umur = 24');
                } else if ($_GET['inputJU'] == "b") {
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
            $imt = ($_GET['inputBB']) / pow($_GET['inputTB'] / 100, 2);

            foreach ($dataBB as $row) {
                $msd3['BB'] = $row['-3sd'];
                $msd2['BB'] = $row['-2sd'];
                $msd1['BB'] = $row['-1sd'];
                $med['BB'] = $row['median'];
                $sd1['BB'] = $row['+1sd'];
                $sd2['BB'] = $row['+2sd'];
                $sd3['BB'] = $row['+3sd'];
            }
            if ($_GET['inputBB'] == $med['BB']) {
                $simpBR = true;
            }
            if ($_GET['inputBB'] < $med['BB']) {
                $simpB1 = $med['BB'];
                $simpB2 = $msd1['BB'];
            } else if ($_GET['inputBB'] > $med['BB']) {
                $simpB2 = $med['BB'];
                $simpB1 = $sd1['BB'];
            }
            if ($_GET['inputBB'] == $med['BB']) {
                $zS['BB'] = 0;
            } else {
                $zS['BB'] = ($_GET['inputBB'] - $med['BB']) / ($simpB1 - $simpB2);
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
            if ($_GET['inputTB'] == $med['TB']) {
                $simpBR = true;
            }
            if ($_GET['inputTB'] < $med['TB']) {
                $simpB1 = $med['TB'];
                $simpB2 = $msd1['TB'];
            } else if ($_GET['inputTB'] > $med['TB']) {
                $simpB2 = $med['TB'];
                $simpB1 = $sd1['TB'];
            }
            if ($_GET['inputTB'] == $med['TB']) {
                $zS['TB'] = 0;
            } else {
                $zS['TB'] = ($_GET['inputTB'] - $med['TB']) / ($simpB1 - $simpB2);
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
                if ($_GET['inputBB'] == $med['BBTB']) {
                    $simpBR = true;
                }
                if ($_GET['inputBB'] < $med['BBTB']) {
                    $simpB1 = $med['BBTB'];
                    $simpB2 = $msd1['BBTB'];
                } else if ($_GET['inputBB'] > $med['BBTB']) {
                    $simpB2 = $med['BBTB'];
                    $simpB1 = $sd1['BBTB'];
                }
                if ($_GET['inputBB'] == $med['BBTB']) {
                    $zS['BBTB'] = 0;
                } else {
                    $zS['BBTB'] = ($_GET['inputBB'] - $med['BBTB']) / ($simpB1 - $simpB2);
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
                $zS['BBTB'] = "999999";
                $sts['BBTB'] = "Tidak Terdefinisi";
                $check = true;
            }

            $this->load->view(
                'hasilhitungcepat',
                [
                    'zscore' => $zS,
                    'status' => $sts,
                    'umur' => $umur,
                    'tinggi' => $tinggi,
                    'imt' => $imt,
                    'berat' => $_GET['inputBB'],
                    'msd1' => $msd1,
                    'med' => $med,
                    'sd1' => $sd1,
                    'msd2' => $msd2,
                    'sd2' => $sd2,
                    'msd3' => $msd3,
                    'sd3' => $sd3,
                    'cek' => $check
                ]
            );
            $this->load->view('user/footer');
        } else {
            $this->index();
        }
    }
}
