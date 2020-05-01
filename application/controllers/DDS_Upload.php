<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DDS_Upload extends CI_Controller {
    
    function __construct(){
        parent:: __construct();
    }

    function index(){
		
		function pesan($hasil,$pesan){
			$register = "";
			
			if($hasil){
				$register = 
				"<div class='alert alert-success alert-dismissible fade show' role='alert'>
					<strong>".$pesan."</strong>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
				</div>"
				;
			}else{
				$register = 
				"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
					<strong>".$pesan."</strong>.
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
				</div>";
			}
			return $register;
		}

        if(isset($_FILES["fileToUpload"])){
			$dataAnak = $this->M_DDS->getAnak('WHERE anak.id = "'.$_SESSION['id_anak'].'"');
			
			$target_dir = "assets/img/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			//random pass//
			function password_generate($chars) {
				$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
				return substr(str_shuffle($data), 0, $chars);
			}
			$pass = password_generate(7);
			//----------//
			foreach($dataAnak as $data){
				$target_file = $target_dir . $data['id'] .$pass.'.'. $imageFileType;
			}
			// Check if image file is a actual image or fake image
			if(isset($_POST["Insert"])) {
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					$uploadOk = 0;
					$this->session->set_flashdata('message', pesan(false,"File is not an image."));
					redirect('DDS/index/home');
				}
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "ico" ) {
				$this->session->set_flashdata('message', pesan(false,"Hanya gambar berformat jpg ,png ,jpeg ,dan ico"));
				$uploadOk = 0;
				redirect('DDS/index/home');
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$this->session->set_flashdata('message', pesan(false,"Ada Error yang tidak diketahui"));
				redirect('DDS/index/home');
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					if(isset($_POST['Insert'])){
						$file = "test.txt";
						foreach($dataAnak as $data){
							$file = $data['foto'];
						}
						unlink($file);
						$res = $this->M_DDS_Update->updateData("anak",
                        [
                            "foto" => $target_file
                        ],
                        [
                            "id" => $_SESSION['id_anak']
                        ] 
                        );
						if($res >= 1){
							$this->session->set_flashdata('message', pesan(true,"The file (". basename( $_FILES["fileToUpload"]["name"]). ") has been uploaded."));
							redirect('DDS/index/home');
						}
					}
				} else {
					$this->session->set_flashdata('message', pesan(false,"Sorry, there was an error uploading your file."));
					redirect('DDS/index/home');
				}
			}
		}
	}
	
	// function upload(){
	// 	$data = $_POST['image'];
    

	// 	list($type, $data) = explode(';', $data);
	// 	list(, $data)      = explode(',', $data);

	// 	function password_generate($chars) {
	// 		$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
	// 		return substr(str_shuffle($data), 0, $chars);
	// 	}
	// 	$pass = password_generate(7);

	// 	$data = base64_decode($data);
		
	// 	$imageName = $pass.'.png';
	// 	file_put_contents('assets/img/'.$imageName, $data);
		
	// 	echo "done";
	// }

	
}