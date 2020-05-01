<style>
  .heart {
    color: #e00;
    animation: beat .25s infinite alternate;
    transform-origin: center;
  }

  @keyframes beat {
    to {
      transform: scale(1.1);
    }
  }
</style>
<!-- Begin Page Content -->
<div class="container-fluid">
  <?php if (isset($_SESSION['update'])) {
    echo $_SESSION['update'];
  } ?>
  <?php if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
  } ?>

  <?php if (isset($_SESSION['id_anak'])) {
    foreach ($anak as $a) { ?>
      <?php
      $diff = date_diff(date_create($a['tgl_lahir']), date_create(date('Y-m-d')));
      $umur = $diff->days / 30;
      $day = $diff->days % 30;
      $tb = $bb = $update = 0;
      $row = 0;
      $imt = "";
      $sts = "";
      $update = "";
      $usia = "";
      $jk2 = $a['jenis_kelamin'];
      $jk = $a['jenis_kelamin'];
      if ($jk == "p") {
        $jk = "girl";
      } else if ($jk == "l") {
        $jk = "boy";
      }
      $sts2 = [];
      foreach ($record as $r) {
        $update = $r['update'];
        $tb = $r['tb_skrg'];
        $bb = $r['bb_skrg'];
        $usia = $r['usia'];
        $row = $row + 1;
        if ($r['zbb'] < -3) {
          $sts2['BB'] = "Gizi Buruk";
          $sts2['sBB'] = "Tingkatkan Pola Makan dan Jaga Kebersihan Anak. Konsultasi Dengan Tenaga Kesehatan Terdekat";
        } else if ($r['zbb'] > 2) {
          $sts2['BB'] = "Gizi Lebih";
          $sts2['sBB'] = "Atur Pola Makan dan Tingkatkan Aktivitas Anak. Jaga Kebersihan Sekitar Anak";
        } else if ($r['zbb'] < -2) {
          $sts2['BB'] = "Gizi Kurang";
          $sts2['sBB'] = "Tingkatkan Pola Makan dan Monitor Aktivitas Anak. Jaga Kebersihan Anak dan Hindari Penyakit Infeksi";
        } else if ($r['zbb'] <= 2 && $r['zbb'] >= -2) {
          $sts2['BB'] = "Gizi Baik";
          $sts2['sBB'] = "Pertahankan Pola Makan dan Aktivitas Anak. Jaga Kebersihan Sekitar Anak";
        }
        if ($r['ztb'] < -3) {
          $sts2['TB'] = "Sangat Pendek";
          $sts2['sTB'] = "Tingkatkan Pola Makan dan Tingkatkan Konsumsi Susu. Konsultasi Dengan Tenaga Kesehatan Terdekat";
        } else if ($r['ztb'] > 2) {
          $sts2['TB'] = "Tinggi";
          $sts2['sTB'] = "Pertahankan Pola Makan dan Batasi Konsumsi Susu";
        } else if ($r['ztb'] < -2) {
          $sts2['TB'] = "Pendek";
          $sts2['sTB'] = "Tingkatkan Pola Makan dan Tingkatkan Konsumsi Susu. Konsultasi Dengan Tenaga Kesehatan Terdekat";
        } else if ($r['ztb'] <= 2 && $r['ztb'] >= -2) {
          $sts2['TB'] = "Normal";
          $sts2['sTB'] = "Pertahankan Pola Makan dan Konsumsi Susu";
        }
        if ($r['zimt'] > 2) {
          $imt = "Gemuk";
        } else if ($r['zimt'] < -2) {
          $imt = "Kurus";
        } else {
          $imt = "Normal";
        }
        if ($r['zbbtb'] == 999999) {
          $sts = "Tidak Terdefinisi";
        } else if ($r['zbbtb'] < -3) {
          $sts = "Sangat Kurus";
        } else if ($r['zbbtb'] > 2) {
          $sts = "Gemuk";
        } else if ($r['zbbtb'] < -2) {
          $sts = "Kurus";
        } else if ($r['zbbtb'] <= 2 && $r['zbbtb'] >= -2) {
          $sts = "Normal";
        }
      }
      if ($row == 0) {
        $tb = $a['tb_lahir'];
        $bb = $a['bb_lahir'];
      }
      $update = date_create($update);
      $update = date_format($update, 'd M Y') . " ,";
      ?>
      <!-- Illustrations -->
      <div class="card shadow mb-4">

        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"></h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#foto"><i class="fas fa-camera"></i> Upload Foto</a>



            </div>
          </div>
        </div>

        <div class="card-body">

          <input type="hidden" id="jenisKelamin" value=<?php echo $jk2 ?>>

          <div class="text-center">
            <?php if ($a['foto'] == "?") { ?>
              <img style="width: 6rem;" src="<?php echo base_url() ?>sbadmin/img/baby-<?php echo $jk ?>.ico" alt="">
            <?php } else { ?>
              <img style="width: 200px;" class="img-thumbnail human-heart" src="<?php echo base_url() . $a['foto'] ?>" alt="">
            <?php } ?>
          </div>
          <hr>
          <h6 style="text-align:center" class="m-0 font-weight-bold text-grey"><?php echo strtoupper($a['nama']) ?></h6>
          <hr>
          <h6 style="text-align:center;color:green" class="m-0 font-weight-bold text-grey"><?php echo ($a['nik'] == "" ? "--NIK KOSONG--" : $a['nik']) ?></h6>
          <hr>
          <!-- batas keasuan -->

          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-0">
              <div style="margin-top:20px" class="card border-left-info shadow h-10 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2 text-center">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Umur Anak</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo (int) $umur . " Bulan " . $day . " Hari" ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-hourglass-half fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-0">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2 text-center">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Berat Balita</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $bb ?> Kg</div>
                    </div>
                    <div class="col-auto">
                      <div class="heart">
                        <a href="#" data-toggle="modal" data-target="#modalBB">
                          <i class="fas fa-weight fa-2x text-success"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-0 mt-0">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2 text-center">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Panjang Badan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $tb ?> cm</div>
                    </div>
                    <div class="col-auto">
                      <div class="heart">
                        <a href="#" data-toggle="modal" data-target="#modalTB">
                          <i class="fas fa-ruler-vertical fa-2x text-primary"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-0">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2 text-center">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">berat badan menurut panjang badan (BB/PB)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $sts ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-balance-scale fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <h6 style="float:right;margin-top:10px" class="badge mb-0 font-weight-bold text-gray-800">Last Update: <?php echo $update ?> Usia: (<?php echo $usia ?> bulan)</h6>
        </div>
        <!-- batas keasuan -->
      </div>

      <!-- Area Chart -->
      <div id="grafik" class="col-xl-13 col-lg-13">
        <div class="card shadow mb-4">

          <div class="card-header py-3 flex-row align-items-center justify-content-between">
            <h6 style="text-align:center" class="m-0 font-weight-bold text-primary">Kartu Menuju Sehat</h6>
          </div>

          <!-- Card Body -->
          <div class="card-body">
            <div class="chart-area">
              <canvas id="kms"></canvas>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- container-fluid -->
  <?php }
} else { ?>
  <div class="card shadow mb-4">

    <div class="card-body">
      <div class="text-center">
        <img class="figure-img img-fluid rounded" style="width: 6rem;" src="<?php echo base_url() ?>sbadmin/img/baby-boy.ico" alt="">
        <img class="figure-img img-fluid rounded" style="width: 6rem;" src="<?php echo base_url() ?>sbadmin/img/baby-girl.ico" alt="">
      </div>
      <hr>
      <div style="text-align:center">
        <a class="btn btn-primary btn-lg" href="<?php echo base_url() ?>index.php/DDS/index/daftaranak">Pilih Anak</a>
      </div>
      <hr>

    </div>
  <?php } ?>
</div>
<!-- End of Main Content -->

<!-- Foto Modal-->
<div class="modal fade" id="foto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Foto</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form id="frm" action="<?php echo base_url() ?>index.php/DDS_Upload" method="post" enctype="multipart/form-data">
        <div class="card-body">

          <div class="file-field">
            <div class="btn btn-primary btn-sm btn-block">
              <span>Choose files</span>
              <input type="file" name="fileToUpload" id="fileToUpload">
            </div>
          </div>

        </div>
        <div class="modal-footer">

          <div id="spinner" style="display:none" class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
          </div>

          <button id="btnSpin" onclick="spin()" class="btn btn-success" name="Insert" type="submit">Upload</button>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal BB-->
<div class="modal fade" id="modalBB" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Modal">Status Gizi Berat Badan Anak</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="mt-0">Status Gizi Berat Badan Menurut Umur termasuk "<a class="text-primary"><?php echo $sts2['BB'] ?></a>"</p>
        <p class="mb-0">Berat Badan Anak : <?php echo $bb ?> Kg</p>
        <p class="mt-0">Standar Berat Badan : <?php echo $standar['BB'] ?> Kg</p>
        <div class="card">
          <div class="card-body">
            <p class="mb-0 text-primary"><?php echo $sts2['sBB'] ?></p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a class="btn btn-warning" href="<?php echo base_url() ?>index.php/DDS/index/rekomendasi">Lihat Detail</a>
      </div>
    </div>
  </div>
</div>
<!-- Modal TB-->
<div class="modal fade" id="modalTB" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Modal">Status Gizi Panjang Badan Anak</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="mt-0">Status Gizi Panjang Badan Menurut Umur termasuk "<a class="text-primary"><?php echo $sts2['TB'] ?></a>"</p>
        <p class="mb-0">Panjang Badan Anak : <?php echo $tb ?> cm</p>
        <p class="mt-0">Standar Panjang Badan : <?php echo $standar['TB'] ?> cm</p>
        <div class="card">
          <div class="card-body">
            <p class="mb-0 text-primary"><?php echo $sts2['sTB'] ?></p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a class="btn btn-warning" href="<?php echo base_url() ?>index.php/DDS/index/rekomendasi">Lihat Detail</a>
      </div>
    </div>
  </div>
</div>

<script>
  function spin() {
    document.getElementById("spinner").style.display = "block";
    document.getElementById("btnSpin").style.display = "none";
  }

  var getJSON = function(url, callback) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.responseType = 'json';
    xhr.onload = function() {
      var status = xhr.status;
      if (status === 200) {
        callback(null, xhr.response);
      } else {
        callback(status, xhr.response);
      }
    };
    xhr.send();
  };

  var jk = document.getElementById("jenisKelamin").value;

  getJSON('https://dds.mathnow.fun/index.php/DDS_Json/autoValueBB/' + jk, function(err, data) {
    if (err !== null) {
      alert('Something went wrong: ' + err);
    } else {
      var msd3 = [];
      var sd3 = [];
      var msd2 = [];
      var sd2 = [];
      var msd1 = [];
      var sd1 = [];
      var med = [];
      var umur = [];
      var datax = [];
      for (i = 0; i < data.length; i++) {
        umur[i] = data[i].umur;
        msd3[i] = data[i]['-3sd'];
        msd2[i] = data[i]['-2sd'];
        msd1[i] = data[i]['-1sd'];
        med[i] = data[i].median;
        sd1[i] = data[i]['+1sd'];
        sd2[i] = data[i]['+2sd'];
        sd3[i] = data[i]['+3sd'];
      }
      datax['umur'] = umur;
      datax['msd3'] = msd3;
      datax['msd2'] = msd2;
      datax['msd1'] = msd1;
      datax['med'] = med;
      datax['sd1'] = sd1;
      datax['sd2'] = sd2;
      datax['sd3'] = sd3;

      getJSON('https://dds.mathnow.fun/index.php/DDS_Json/getRecord/', function(err2, data2) {
        if (err2 !== null) {
          alert('Something went wrong: ' + err2);
        } else {
          var bb = [];
          var datax2 = [];
          var min = 100;
          min = data2[0].usia;
          for (i = 0; i < data2.length; i++) {
            bb[data2[i].usia - min] = data2[i].bb_skrg;
          }
          datax2['bb'] = bb;
        }
        drawChart2(datax, datax2);
      });

    }
  });

  function drawChart2(data, data2) {
    // Area Chart Example
    var ctx = document.getElementById("kms");
    var myLineChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: data['umur'],
        datasets: [
          //BATAS
          {
            label: "Batas Atas",
            lineTension: 0.3,
            //backgroundColor: "rgba(10, 255, 10, 0.2)",
            borderColor: "rgba(255, 0, 0, 0.6)",
            pointRadius: 0,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 0,
            pointHoverBackgroundColor: "grey",
            pointHoverBorderColor: "grey",
            pointHitRadius: 0,
            pointBorderWidth: 2,
            data: data['sd3'],
            fill: false
          },
          {
            label: "Batas Bawah",
            lineTension: 0.3,
            //backgroundColor: "rgba(10, 255, 10, 0.2)",
            borderColor: "rgba(255, 0, 0, 0.6)",
            pointRadius: 0,
            pointBackgroundColor: "rgba(102, 255, 102, 1)",
            pointBorderColor: "rgba(102, 255, 102, 1)",
            pointHoverRadius: 0,
            pointHoverBackgroundColor: "grey",
            pointHoverBorderColor: "grey",
            pointHitRadius: 0,
            pointBorderWidth: 2,
            data: data['msd3'],
            fill: false
          },
          //BATAS
          {
            label: "Median",
            lineTension: 0.3,
            backgroundColor: "rgba(0, 0, 0, 0)",
            borderColor: "rgb(95, 226, 110)",
            pointRadius: 0,
            pointBackgroundColor: "rgb(95, 226, 110)",
            pointBorderColor: "rgb(95, 226, 110)",
            pointHoverRadius: 0,
            pointHoverBackgroundColor: "grey",
            pointHoverBorderColor: "grey",
            pointHitRadius: 0,
            pointBorderWidth: 2,
            data: data['med'],
            fill: false
          },
          {
            label: "BB",
            lineTension: 0.3,
            backgroundColor: "rgba(0, 0, 0, 0)",
            borderColor: "rgb(95, 110, 226)",
            pointRadius: 3,
            pointBackgroundColor: "rgb(95, 110, 226)",
            pointBorderColor: "rgb(95, 110, 226)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "grey",
            pointHoverBorderColor: "grey",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: data2['bb'],
            fill: false
          }

        ],
      },
      options: {
        maintainAspectRatio: false,
        spanGaps: true,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
          }
        },
        scales: {
          xAxes: [{
            scaleLabel: {
              display: true,
              labelString: 'Umur (Bulan)'
            },
            gridLines: {
              display: true,
              drawBorder: true,
              borderDash: [2],
              zeroLineBorderDash: [2]
            },
            ticks: {
              maxTicksLimit: 7,
            }
          }],
          yAxes: [{
            ticks: {
              maxTicksLimit: 5,
              padding: 10,
            },
            gridLines: {
              display: true,
              color: "rgb(234, 236, 244)",
              drawBorder: true,
              borderDash: [2],
            },
            scaleLabel: {
              display: true,
              labelString: 'Kg'
            },
          }],
        },
        legend: {
          display: false
        },
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          intersect: true,
          mode: 'nearest',
          caretPadding: 10,
          callbacks: {
            label: function(tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
              return datasetLabel + ' ' + number_format(tooltipItem.yLabel) + ' Kg';
            }
          }
        }
      }
    });
  }
</script>
