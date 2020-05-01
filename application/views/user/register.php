<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>DDS APP - REGISTER</title>

  <link rel="icon" type="image/png" href="<?php echo base_url();?>loginv2/images/icons/download.png"/>
  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url();?>sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url();?>sbadmin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div style="background:url('<?php echo base_url()?>rekol2.jpg');background-position:center;background-size:cover" class="col-lg-5 d-none d-lg-block"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Buat Akun</h1>
              </div>
              <?php if(isset($_SESSION['register'])){echo $_SESSION['register'];}?>
              <form class="user" action="<?php echo base_url()?>index.php/DDS_Insert/insertDataIbu" method="post">
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="exampleFirstName" name="inputNama" placeholder="Nama" required>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="inputEmail" placeholder="Email" required>
                </div>

                <!-- <div id="alertx" style="transition: opacity 0.6s;display:none;" class="alert alert-warning alert-dismissible fade show" role="alert">
                  <p style="text-align:center"><strong>Sorry Mblo! </strong>Fitur Masih Kaming Sun. :D</p>
                  <button type="button" class="close" onclick="alertx(0)">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div> -->

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input oninput="cek()" type="password" class="form-control form-control-user" id="pwd1" name="inputPass" placeholder="Password" required>
                  </div>
                  <div class="col-sm-6">
                    <input oninput="cek()" type="password" class="form-control form-control-user" id="pwd2" placeholder="Ulangi Password" required>
                  </div>
                </div>
                <button id="btnsubmit" class="btn btn-primary btn-user btn-block" type="submit" name="submit">
                  Register Account
                </button>
                <hr>
                <a href="<?php echo base_url();?>index.php/DDS/index/hitungcepat" class="btn btn-google btn-user btn-block">
                    <i class="fas fa-fighter-jet"></i> Hitung Cepat
                </a>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="<?php echo base_url();?>">Sudah Punya Akun?</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <script>
    function cek(){
      var x = document.getElementById('pwd1');
      var y = document.getElementById('pwd2');
      var z = document.getElementById('inputNama');
      var btn = document.getElementById('btnsubmit');
      if(y.value != "" && y.value != x.value){
        y.style.border = "2px solid red";
        y.setCustomValidity("Passwords Tidak Sama!"); //Custom Validitas saat keaadaan tertentu
        // btn.disabled= true;
      }else if(y.value == x.value){
        y.style.border = "";
        y.setCustomValidity(""); //Jangan Lupa Dihapus
        // btn.disabled = false;
      }
    }
  </script>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url();?>sbadmin/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url();?>sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url();?>sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url();?>sbadmin/js/sb-admin-2.min.js"></script>

</body>

</html>
