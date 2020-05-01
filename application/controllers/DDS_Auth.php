<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DDS_Auth extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function login()
    {
        $loginG =
            "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Login Gagal!</strong><br>Email atau Password Salah.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";

        if (isset($_POST['submit'])) {
            $data = $this->M_DDS->getIbu();
            foreach ($data as $datax) {
                if (strtolower($_POST['inputEmail']) == strtolower($datax['email']) && strtolower($_POST['inputPass']) == strtolower($datax['password'])) { //&& $datax['hak'] != 1
                    $_SESSION['id'] = $datax['id'];
                    $_SESSION['level'] = $datax['hak'];
                    $_SESSION['id_pos'] = $datax['id_pos'];
                    if ($_SESSION['level'] == 3) {
                        $_SESSION['id_pos'] = -1;
                    }
                    if ($_SESSION['level'] == 1) {
                        redirect("DDS/index/artikel");
                    }
                    redirect("DDS/index/home");
                }
            }
            $this->session->set_flashdata('login', $loginG);
            redirect("DDS/index/login");
        }
    }

    function pilihPosyandu($id_pos, $title = "")
    {
        if ($_SESSION['level'] == 3) {
            $_SESSION['id_pos'] = $id_pos;
            if ($title == "edit") {
                redirect('DDS/index/editPosyandu');
            }
            redirect('DDS/index/' . $title);
        } else {
            redirect('DDS');
        }
    }

    function pilihAnak($id, $id_ibu, $content = "")
    {
        $_SESSION['id_anak'] = $id;
        $_SESSION['id_ibu'] = $id_ibu;
        if (isset($_SESSION['id'])) {
            if ($_SESSION['level'] == 2 && $content == "edit") {
                redirect("DDS/index/editanak");
            } else if ($_SESSION['level'] == 2 && $content == "update") {
                redirect("DDS/index/tambahriwayat");
            }
            if ($_SESSION['level'] == 1) {
                redirect("DDS");
            } else if ($_SESSION['level'] == 2) {
                redirect("DDS/index/statusanak");
            } else if ($_SESSION['level'] == 3) {
                redirect("DDS/index/statusanak");
            }
        }
        redirect("DDS");
    }

    function pilihIbu($id_ibu, $content = "")
    {
        $_SESSION['id_ibu'] = $id_ibu;
        unset($_SESSION['id_anak']);
        if ($_SESSION['level'] == 2 && $content == "edit") {
            redirect("DDS/index/editIbu");
        } else if ($_SESSION['level'] == 2 && $content == "tambahanak") {
            redirect("DDS/index/tambahanakibu");
        }
        if (isset($_SESSION['id'])) {
            if ($_SESSION['level'] == 2) {
                redirect("DDS/index/daftaranakibu");
            }
        }
        redirect("DDS");
    }

    function logout()
    {
        session_destroy();
        redirect("DDS");
    }

    function error()
    {
        $this->load->view('404.php');
    }
}
