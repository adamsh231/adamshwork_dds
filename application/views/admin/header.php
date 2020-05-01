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

  <title>DDS APP - <?php echo strtoupper($title)?></title>
  <link rel="icon" type="image/png" href="<?php echo base_url();?>loginv2/images/icons/download.png"/>
  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url();?>sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url();?>sbadmin/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>sbadmin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <style>
  /* *{border:1px solid blueviolet;} */
  </style>

</head>


<script>
  function toogle(){
    if(screen.width < 1020){
      document.getElementById('sidebarToggleTop').click();
      var x = document.getElementsByClassName("tutup");
      var y = document.getElementsByClassName("buka");

      for(i=0;i<x.length;i++){
        x[i].style.display = "block";
      }
      for(i=0;i<y.length;i++){
        y[i].style.display = "none";
      }
    }else{
      var x = document.getElementsByClassName("tutup");
      var y = document.getElementsByClassName("buka");

      for(i=0;i<x.length;i++){
        x[i].style.display = "none";
      }
      for(i=0;i<y.length;i++){
        y[i].style.display = "block";
      }
    }
  }
  function alertx(x){
    if(x == 1){
      document.getElementById('alertx').style.display = "block";
      if(screen.width < 1020){
        document.getElementById('sidebarToggleTop').click();
      }
    }else{
      document.getElementById('alertx').style.display = "none";
    }
  }
</script>
<?php
  $dataIbu = [0];
  foreach($ibu as $i){
    $dataIbu['nama'] = $i['nama'];
    $dataIbu['email'] = $i['email'];
    $dataIbu['hp'] = $i['hp'];
    $dataIbu['posyandu'] = $i['nama_pos'];
  }
  

?>
<body onload="toogle()" id="page-top">

  <!-- Preloader -->
  <div id="preloader">
    <div class="wrapper">
        <div class="cssload-loader"></div>
    </div>
  </div>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a onclick="toogle()" class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url()?>index.php/DDS/index/home">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-theater-masks"></i>
        </div>
        <div class="sidebar-brand-text mx-3">DDS<sub>App</sub></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?php if($title == "home" || $title == "editanak") echo "active"?>">
        <a onclick="toogle()" class="nav-link" href="<?php echo base_url()?>index.php/DDS/index/home">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      
      <!-- Nav Item - new -->
      <li class="nav-item <?php if($title == "tambahanak" || $title == "editIbu") echo "active"?>">
        <a onclick="toogle()" class="nav-link" href="<?php echo base_url()?>index.php/DDS/index/tambahanak">
          <i class="fas fa-fw fa-database"></i>
          <span>Daftar Ibu/Anak</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - new -->
      <li class="nav-item <?php if($title == "statusanak") echo "active"?>">
        <a onclick="toogle()" class="nav-link" href="<?php echo base_url()?>index.php/DDS/index/statusanak">
          <i class="fas fa-fw fa-eye"></i>
          <span>Status Anak</span></a>
      </li>

      <!-- Nav Item - new -->
      <li class="nav-item <?php if($title == "tambahriwayat") echo "active"?>">
        <a onclick="toogle()" class="nav-link" href="<?php echo base_url()?>index.php/DDS/index/tambahriwayat">
          <i class="fas fa-fw fa-address-card"></i>
          <span>Update Riwayat Anak</span></a>
      </li>

      <!-- Nav Item - new -->
      <li class="nav-item <?php if($title == "daftarriwayat") echo "active"?>">
        <a onclick="toogle()" class="nav-link" href="<?php echo base_url()?>index.php/DDS/index/daftarriwayat">
          <i class="fas fa-fw fa-list-ol"></i>
          <span>Daftar Riwayat Anak</span></a>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-info-circle"></i>
          <span>About</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 style="text-align:center" class="collapse-header">Artikel</h6>
            <a class="collapse-item" onclick="alertx(2)" href="<?php echo base_url() ?>index.php/DDS/index/artikel">Tentang Stunting</a>
            <h6 style="text-align:center" class="collapse-header">User Guide</h6>
            <a class="collapse-item" onclick="alertx(2)" href="<?php echo base_url() ?>index.php/DDS/index/admin">Petunjuk Aplikasi</a>
            <a class="collapse-item" onclick="alertx(2)" href="#">Tentang Aplikasi DDS</a>
          </div>
        </div>
      </li>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


          <!-- Topbar Navbar -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
              <a class="nav-link">
                <div class="btn btn-icon-split btn-sm">
                  <span class="text h4">Posyandu <?php echo ucwords($dataIbu['posyandu'])?></span>
                </div>
              </a>
            </li>
          </ul>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Alerts -->
            <li class="nav-item buka">
              <a class="nav-link" href="<?php echo base_url()?>index.php/DDS/index/hitungcepat">
                <div class="btn btn-outline-success btn-icon-split btn-sm">
                  <span class="text">Hitung Cepat</span>
                </div>
              </a>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo ucwords($dataIbu['nama'])?></span>
                <img class="img-profile rounded-circle" src="<?php echo base_url()?>baby.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profile">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>

                <div class="dropdown-divider tutup"></div>
                <a class="dropdown-item tutup" href="<?php echo base_url()?>index.php/DDS/index/hitungcepat">
                  <i class="fas fa-fighter-jet fa-sm fa-fw mr-2 text-gray-400"></i>
                  Hitung Cepat
                </a>

                <div class="dropdown-divider"></div>
                
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <div id="alertx" style="transition: opacity 0.6s;display:none;" class="alert alert-warning alert-dismissible fade show" role="alert">
          <p style="text-align:center"><strong>Sorry Mblo! </strong>Fitur Masih Kaming Sun. :D</p>
          <button type="button" class="close" onclick="alertx(0)">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

