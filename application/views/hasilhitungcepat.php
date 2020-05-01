<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>DDS APP - HASIL HITUNG</title>
  
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

          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item">
                <a href="<?php echo base_url()?>index.php/DDS/index/hitungcepat" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-redo-alt"></i>
                    </span>
                    <span class="text">Hitung Ulang</span>
                </a>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
        
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- batas konten -->

            <div class="col-xl-18">
                <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 flex-row align-items-center justify-content-between">
                        <h6 style="text-align:center" class="m-0 font-weight-bold text-primary">Progress Pencegahan Stunting Pada Balita</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo round($umur/60*100)?>%</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar
                                    <?php
                                        if(round($umur/60*100) < 30){
                                            echo "bg-success";
                                        }else if(round($umur/60*100) < 50){
                                            echo "bg-info";
                                        }else if(round($umur/60*100) < 80){
                                            echo "bg-warning";
                                        }else if(round($umur/60*100) <= 100){
                                            echo "bg-danger";
                                        }
                                    ?>" role="progressbar" style="width: <?php echo round($umur/60*100)?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h6 style="text-align:center" class="m-0 font-weight-bold text-grey">Anda Memiliki <?php echo round(60-$umur)?> Bulan lagi Untuk Mencegah Stunting yang Efektif Pada Anak Anda</h6>
                        <hr>
                        <a href="<?php echo base_url()?>" style="float:right;" class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-baby-carriage"></i>
                            </span>
                            <span class="text">Cek Perkembangan Anak Secara Berkala</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- batas konten -->
            
            <?php
            $warna1 = "";
                if($zscore['BB'] > 2 || $zscore['BB'] < -2){
                    $warna1 = "danger";
                }else if( ($zscore['BB'] >= -2 && $zscore['BB'] <= -1) ){
                    $warna1 = "warning";
                }else{
                    $warna1 = "primary";
                }
            ?>

            <div class="row">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-<?php echo $warna1?> shadow h-100 py-2">
                        <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div style="text-align:center" class="text-xs font-weight-bold text-uppercase mb-1">Status Berat Badan Terhadap Umur (BB/U)</div>
                                <hr>
                                <div style="text-align:center" class="h5 mb-0 font-weight-bold text-<?php echo $warna1?>"><?php echo $status['BB']?></div>
                            </div>
                            <div class="col-auto">
                            <i class="fas fa-weight fa-2x text-<?php echo $warna1?>"></i>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <?php
                $warna2 = "";
                    if($zscore['TB'] > 2 || $zscore['TB'] < -2){
                        $warna2 = "danger";
                    }else if( ($zscore['TB'] >= -2 && $zscore['TB'] <= -1) ){
                        $warna2 = "warning";
                    }else{
                        $warna2 = "primary";
                    }
                ?>
            
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-<?php echo $warna2?> shadow h-100 py-2">
                        <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <div style="text-align:center" class="text-xs font-weight-bold text-uppercase mb-1">Status panjang badan Terhadap Umur (PB/U)</div>
                            <hr>
                            <div style="text-align:center" class="h5 mb-0 font-weight-bold text-<?php echo $warna2?>"><?php echo $status['TB']?></div>
                            </div>
                            <div class="col-auto">
                            <i class="fas fa-ruler-vertical fa-2x text-<?php echo $warna2?>"></i>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <?php
                    $warna3 = "";
                    if($zscore['IMT'] > 2 || $zscore['IMT'] < -2){
                        $warna3 = "danger";
                    }else if( ($zscore['IMT'] >= -2 && $zscore['IMT'] <= -1) ){
                        $warna3 = "warning";
                    }else{
                        $warna3 = "primary";
                    }
                ?>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-<?php echo $warna3?> shadow h-100 py-2">
                        <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <div style="text-align:center" class="text-xs font-weight-bold text-uppercase mb-1">Status Indeks Massa Tubuh Terhadap Umur (IMT/U)</div>
                            <hr>
                            <div style="text-align:center" class="h5 mb-0 font-weight-bold text-<?php echo $warna3?>"><?php echo $status['IMT']?></div>
                            </div>
                            <div class="col-auto">
                            <i class="fas fa-baby fa-2x text-<?php echo $warna3?>"></i>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <?php
                    $warna4 = "";
                    if($zscore['BBTB'] > 2 || $zscore['BBTB'] < -2){
                        $warna4 = "danger";
                    }else if( ($zscore['BBTB'] >= -2 && $zscore['BBTB'] <= -1) ){
                        $warna4 = "warning";
                    }else{
                        $warna4 = "primary";
                    }
                    if($zscore['BBTB'] == 999999){
                        $warna4 = "grey";
                    }
                ?>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-<?php echo $warna4?> shadow h-100 py-2">
                        <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <div style="text-align:center" class="text-xs font-weight-bold text-uppercase mb-1">Status Berat Badan Terhadap Panjang Badan (BB/PB)</div>
                            <hr>
                            <div style="text-align:center" class="h5 mb-0 font-weight-bold text-<?php echo $warna4?>"><?php echo $status['BBTB']?></div>
                            </div>
                            <div class="col-auto">
                            <i class="fas fa-balance-scale fa-2x text-<?php echo $warna4?>"></i>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- batas konten -->

            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 style="text-align:center" class="m-0 font-weight-bold text-primary">Hasil Perhitungan</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse" id="collapseCardExample">
                    <div class="card-body">


                    <!-- AWAL KONTEN -->
                        <!-- batas keasuan -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span style="color:black" class="input-group-text " id="basic-addon1">Umur</span>
                            </div>
                            <input value="<?php echo $umur?> bulan" type="text" id="calcu" class="form-control" placeholder="" aria-label="calcu" aria-describedby="basic-addon1" disabled>
                            <div class="input-group-prepend">
                                <span style="color:black" class="input-group-text" id="basic-addon1">BB</span>
                            </div>
                            <input value="<?php echo $berat?> Kg" type="text" id="calcinputBB" class="form-control" placeholder="" aria-label="calcinputBB" aria-describedby="basic-addon1" disabled>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span style="color:black" class="input-group-text" id="basic-addon1">PB</span>
                            </div>
                            <input value="<?php echo $tinggi?> cm" type="text" id="calcinputBB" class="form-control" placeholder="" aria-label="calcinputBB" aria-describedby="basic-addon1" disabled>
                            <div class="input-group-prepend">
                                <span style="color:black" class="input-group-text" id="basic-addon1">IMT</span>
                            </div>
                            <input value=<?php echo round($imt,2)?> type="text" id="calcinputBB" class="form-control" placeholder="" aria-label="calcinputBB" aria-describedby="basic-addon1" disabled>
                        </div>
                        <!-- batas keasuan -->
                        <div class="card text-left">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#insta">BB/U</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#face">TB/U</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#twit">IMT/U</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#BBTB">BB/TB</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content card-body">

                                <div id="insta" class="tab-pane active">
                                    
                                    <div style="text-align:center" class="card-header">BB/U</div>
                                        <table class="table table-bordered table-small table-responsive-sm">
                                            <thead style="color:Black">
                                                <tr style="text-align:center">
                                                    <th>-3SD</th>
                                                    <th>-2SD</th>
                                                    <th>-1SD</th>
                                                    <th>Median</th>
                                                    <th>+1SD</th>
                                                    <th>+2SD</th>
                                                    <th>+3SD</th>
                                                <tr>
                                            </thead>
                                            <tbody>
                                                <tr style="text-align:center">
                                                    <td><?php echo $msd3['BB']?></td>
                                                    <td><?php echo $msd2['BB']?></td>
                                                    <td><?php echo $msd1['BB'] ?></td>
                                                    <td><?php echo $med['BB'] ?></td>
                                                    <td><?php echo $sd1['BB'] ?></td>
                                                    <td><?php echo $sd2['BB']?></td>
                                                    <td><?php echo $sd3['BB']?></td>
                                                </tr>
                                        </table>
                                        <!-- ZSCORE -->
                                        <div class="col-lg-4">
                                            <div class="card mb-4 py-3 border-left-<?php echo $warna1?>">
                                                <div class="card-body">
                                                    <div class="h6 mb-0 mr-3 font-weight-bold text-gray-600">Z SCORE = <?php echo round($zscore['BB'],2)?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                            <!-- batas keasuan -->
                            <div id="face" class="tab-pane">
                                
                                <div style="text-align:center" class="card-header">TB/U</div>
                                    <table class="table table-bordered table-small table-responsive-sm">
                                        <thead style="color:Black">
                                            <tr style="text-align:center">
                                                <th>-3SD</th>
                                                <th>-2SD</th>
                                                <th>-1SD</th>
                                                <th>Median</th>
                                                <th>+1SD</th>
                                                <th>+2SD</th>
                                                <th>+3SD</th>
                                            <tr>
                                        </thead>
                                        <tbody>
                                            <tr style="text-align:center">
                                                <td><?php echo $msd3['TB']?></td>
                                                <td><?php echo $msd2['TB']?></td>
                                                <td><?php echo $msd1['TB'] ?></td>
                                                <td><?php echo $med['TB'] ?></td>
                                                <td><?php echo $sd1['TB'] ?></td>
                                                <td><?php echo $sd2['TB']?></td>
                                                <td><?php echo $sd3['TB']?></td>
                                            </tr>
                                    </table>
                                    <!-- ZSCORE -->
                                    <div class="col-lg-4">
                                        <div class="card mb-4 py-3 border-left-<?php echo $warna2?>">
                                            <div class="card-body">
                                                <div class="h6 mb-0 mr-3 font-weight-bold text-gray-600">Z SCORE = <?php echo round($zscore['TB'],2)?></div>
                                            </div>
                                        </div>
                                    </div>                        
                                </div>
                                    
                            <!-- batas keasuan -->
                            <div id="twit" class="tab-pane">
                                
                                <div style="text-align:center" class="card-header">IMT/U</div>
                                    <table class="table table-bordered table-small table-responsive-sm">
                                        <thead style="color:Black">
                                            <tr style="text-align:center">
                                                <th>-3SD</th>
                                                <th>-2SD</th>
                                                <th>-1SD</th>
                                                <th>Median</th>
                                                <th>+1SD</th>
                                                <th>+2SD</th>
                                                <th>+3SD</th>
                                            <tr>
                                        </thead>
                                        <tbody>
                                            <tr style="text-align:center">
                                                <td><?php echo $msd3['IMT']?></td>
                                                <td><?php echo $msd2['IMT']?></td>
                                                <td><?php echo $msd1['IMT'] ?></td>
                                                <td><?php echo $med['IMT'] ?></td>
                                                <td><?php echo $sd1['IMT'] ?></td>
                                                <td><?php echo $sd2['IMT']?></td>
                                                <td><?php echo $sd3['IMT']?></td>
                                            </tr>
                                    </table>
                                    <!-- ZSCORE -->
                                    <div class="col-lg-4">
                                        <div class="card mb-4 py-3 border-left-<?php echo $warna3?>">
                                            <div class="card-body">
                                                <div class="h6 mb-0 mr-3 font-weight-bold text-gray-600">Z SCORE = <?php echo round($zscore['IMT'],2)?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            <!-- batas keasuan -->
                            <div id="BBTB" class="tab-pane">
                                
                                <div style="text-align:center" class="card-header">BB/TB</div>
                                    <table class="table table-bordered table-small table-responsive-sm">
                                        <thead style="color:Black">
                                            <tr style="text-align:center">
                                                <th>-3SD</th>
                                                <th>-2SD</th>
                                                <th>-1SD</th>
                                                <th>Median</th>
                                                <th>+1SD</th>
                                                <th>+2SD</th>
                                                <th>+3SD</th>
                                            <tr>
                                        </thead>
                                        <tbody>
                                            <tr style="text-align:center">
                                                <td><?php echo $msd3['BBTB']?></td>
                                                <td><?php echo $msd2['BBTB']?></td>
                                                <td><?php echo $msd1['BBTB'] ?></td>
                                                <td><?php echo $med['BBTB'] ?></td>
                                                <td><?php echo $sd1['BBTB'] ?></td>
                                                <td><?php echo $sd2['BBTB']?></td>
                                                <td><?php echo $sd3['BBTB']?></td>
                                            </tr>
                                    </table>
                                    <!-- ZSCORE -->
                                    <?php if(!$cek) {?>
                                        <div class="col-lg-4">
                                            <div class="card mb-4 py-3 border-left-<?php echo $warna4?>">
                                                <div class="card-body">
                                                    <div class="h6 mb-0 mr-3 font-weight-bold text-gray-600">Z SCORE = <?php echo round($zscore['BBTB'],2)?></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }else{?>
                                        <div class="col-lg-4">
                                            <div class="card mb-4 py-3">
                                                <div class="card-body">
                                                    <div class="h6 mb-0 mr-3 font-weight-bold text-gray-600">Z SCORE = N/A</div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }?>
                                </div>
                                
                            <!-- batas keasuan -->
                            </div>
                        </div>
                    <!-- AKHIR KONTEN -->

                    </div>
                </div>
            </div>

        </div>
        <!-- End of Main Content -->

      