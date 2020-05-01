<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>DDS APP - HITUNG CEPAT</title>
  
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

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Topbar Navbar -->
          <ul class="navbar-nav mr-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item">
                <a href="<?php echo base_url()?>index.php/DDS/index/login" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-home"></i>
                    </span>
                    <span class="text">Home</span>
                </a>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
        
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="col-xl-12">
                <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 flex-row align-items-center justify-content-between">
                        <h6 style="text-align:center" class="m-0 font-weight-bold text-primary">Form Data Balita</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form id="frm" action="<?php echo base_url()?>index.php/DDS/hitungcepat">
                            <div class="form-group">
                                <label for="inputUmur">Umur</label>
                                <input value="" type="number" class="form-control" id="inputUmur" name="inputUmur"  placeholder="Umur dalam Bulan" min="0" max="60" required>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Jenis Kelamin</label>
                                </div>
                                <select name="inputJK" class="custom-select" id="inputGroupSelect01">
                                    <option value="l"selected>Laki - Laki</option>
                                    <option value="p">Perempuan</option>
                                </select>
                            </div>

                            <div class="form-group">
                            <label for="inputBeratBadan">Berat Badan Sekarang</label>
                            <input type="number" value="" class="form-control" id="inputBB" name="inputBB" placeholder="Berat Badan dalam Kg" step=0.1 min="0" required>
                            </div>
                            <div class="form-group">
                            <label for="inputTinggiBadan">Tinggi Badan Sekarang</label>
                            <input type="number" step="0.01" value="" class="form-control" id="inputTB" name="inputTB" placeholder="Tinggi Badan dalam cm" required>
                            </div>

                            <div id="inputJU" class="form-group">
                                <div class="form-group">
                                    <label for="inputBeratBadan">Jenis Mengukur Tinggi Badan</label>
                                    <select name="inputJU" class="custom-select" id="inputselect">
                                    <option value="t" selected>Berbaring</option>
                                    <option value="b">Berdiri</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-user btn-block" name="submit" type="submit">
                            Hitung
                            </button>
                            <!-- <hr> -->
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->


    <script>
        // function jenisUkur(){
        //     var x = document.getElementById("inputUmur").value;
        //     if(x == 24){
        //         document.getElementById("inputJU").style.display = "block";
        //     }else{
        //         document.getElementById("inputJU").style.display = "none";
        //         document.getElementById("inputJU").value = "o";
        //     }
        // }
    </script>



