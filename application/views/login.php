<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Core Stylesheet -->
  <link rel="stylesheet" href="<?php echo base_url()?>uza/style2.css">


  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>DDS APP - LOGIN</title>

  <link rel="icon" type="image/png" href="<?php echo base_url();?>loginv2/images/icons/download.png"/>
  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url();?>sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url();?>sbadmin/css/sb-admin-2.min.css" rel="stylesheet">
  
  <!-- <style>
  *{border:1px solid red;}
  </style> -->

</head>

<body background="<?php echo base_url()?>hospital.jpg" style="background-size: auto" onload="startTime()">

  <!-- Preloader -->
  <div id="preloader">
      <div class="wrapper">
          <div class="cssload-loader"></div>
      </div>
  </div>

  <div class="container">
  
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div style="background:url('<?php echo base_url()?>rekol2.jpg');background-position:center;background-size:cover" class="col-lg-6 d-none d-lg-block"></div>
              <div class="col-lg-6">
                <a href="<?php echo base_url()?>" class="btn btn-sm btn-primary" style="float:right" >
                  <i class='fas fa-home'></i>
                </a>
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Selamat Datang</h1>
                  </div>
                  <?php if(isset($_SESSION['login'])){echo $_SESSION['login'];}?>
                  <form class="user" action="<?php echo base_url()?>index.php/auth" method="post">
                    <div class="form-group">
                      <input name="inputEmail" type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                      <input name="inputPass" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
                    </div>
                    <!-- <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div> -->
                    <button class="btn btn-primary btn-user btn-block" type="submit" name="submit">
                      Login
                    </button>
                    <hr>
                    <a href="<?php echo base_url()?>index.php/DDS/index/hitungcepat" class="btn btn-google btn-user btn-block">
						<i class="fas fa-fighter-jet"></i> Hitung Cepat
                    </a>
                    <!-- <a href="<?php echo base_url()?>index.php/DDS/index/home" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a> -->
                  </form>
                  <hr>
                  
                  <div id="jam" class="text-center">
                    
                  </div>
                  <!-- <div class="text-center">
                    <a class="small" href="#">Forgot Password?</a>
                  </div> -->
                  <!-- <div class="text-center">
                    <a class="small" href="<?php echo base_url()?>index.php/DDS/index/register">Belum Punya Akun?</a>
                  </div> -->
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

<script>
  function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('jam').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 1000);
  }
  function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
  }
</script>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url();?>sbadmin/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url();?>sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url();?>sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url();?>sbadmin/js/sb-admin-2.min.js"></script>

  <!-- Active js -->
  <script src="<?php echo base_url()?>uza/js/default-assets/active.js"></script>

</body>

</html>
