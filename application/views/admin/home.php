<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div class="container-fluid">
  <?php if (isset($_SESSION['update'])) {
    echo $_SESSION['update'];
  } ?>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 style="text-align:center" class="m-0 font-weight-bold text-primary">Daftar Anak</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th width="30px" style="text-align:center">No</th>
              <th style="text-align:center">Nama</th>
              <th style="text-align:center"></th>
              <th style="text-align:center">Umur</th>
              <th style="text-align:center">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $count = 0;
            $jml = [];
            $jml['TBD'] = $jml['TBG'] = $jml['TBW'] = $jml['TBS'] = 0;
            $jml['BBD'] = $jml['BBG'] = $jml['BBW'] = $jml['BBS'] = 0;
            $jml['BBTBD'] = $jml['BBTBG'] = $jml['BBTBW'] = $jml['BBTBS'] = 0;
            foreach ($anak as $a) {
              $count++;
              $diff = date_diff(date_create($a['tgl_lahir']), date_create(date('Y-m-d')));
              $umur = $diff->days / 30;
              $day = $diff->days % 30;
              $tgl_lahir = date_create($a['tgl_lahir']);
              $average = $a['ztb'];

              $button = "";
              $icon = "";
              $quote = "";

              if ($average > 2) {
                $button = "primary";
                $icon = "fa-shield-alt";
                $quote = "Aman";
                $jml['TBS']++;
              } else if ($average < -2) {
                //$button = "btn-danger";
                $button = "danger";
                $icon = "fa-skull";
                $quote = "Bahaya";
                $jml['TBD']++;
              } else if (($average >= -2 && $average <= -1)) {
                //$button = "btn-warning";
                $button = "warning";
                $icon = "fa-exclamation-triangle";
                $quote = "Hati-Hati";
                $jml['TBW']++;
              } else {
                // $button = "btn-primary";
                $button = "primary";
                $icon = "fa-shield-alt";
                $quote = "Aman";
                $jml['TBG']++;
              }

              if ($a['zbb'] < -3) {
                $jml['BBD']++;
              } else if ($a['zbb'] > 2) {
                $jml['BBS']++;
              } else if ($a['zbb'] < -2) {
                $jml['BBW']++;
              } else if ($a['zbb'] <= 2 && $a['zbb'] >= -2) {
                $jml['BBG']++;
              }
              if ($a['zbbtb'] < -3) {
                $jml['BBTBD']++;
              } else if ($a['zbbtb'] > 2) {
                $jml['BBTBS']++;
              } else if ($a['zbbtb'] < -2) {
                $jml['BBTBW']++;
              } else if ($a['zbbtb'] <= 2 && $a['zbbtb'] >= -2) {
                $jml['BBTBG']++;
              }
              ?>
            <tr>
              <td style="text-align:center;"><?php echo $count ?></td>
              <td><a <?php echo ($umur >= 60 ? 'style="color:black"' : '') ?> href="<?php echo base_url() ?>index.php/DDS_Auth/pilihAnak/<?php echo $a['id'] ?>/<?php echo $a['id_ibu'] ?>"><?php echo ucwords($a['nama']) ?></a><?php echo ($a['nik'] == "" ? '<sub style="float:right"><span class="badge badge-pill badge-warning">NIK Kosong</span></sub>' : '') ?></td>
              <td style="text-align:center"><a onclick="loading2(<?php echo $a['id'] ?>)" href="#" data-toggle="modal" data-target="#info2"><i class='fas fa-info-circle <?php echo ($cek[$count] ? "text-danger" : "text-success") ?>'></i></a></td>
              <td style="text-align:center"><?php echo (int) $umur . " Bulan " . $day . " Hari" ?>
                <?php if ($cek[$count]) { ?>
                <!-- <span class="text">belum</span> -->
                <?php } else { ?>
                <!-- <span class="text">oke</span> -->
                <?php } ?>
              </td>
              <td style="text-align:center">
                <a onclick="loading(<?php echo $a['id'] ?>)" href="#" data-toggle="modal" data-target="#info">
                  <span class="icon text-white-50">
                    <i class="fas <?php echo $icon ?> text-<?php echo $button ?>"></i>
                  </span>
                  <!-- <span class="text"><?php echo $quote ?></span> -->
                </a>
                <?php if ($a['cekCat'] == 1 || $a['cekCat'] == 2) { ?>
                <a href="<?php echo base_url() ?>index.php/DDS_Auth/pilihAnak/<?php echo $a['id'] ?>/<?php echo $a['id_ibu'] ?>">
                  <?php if ($a['cekCat'] == 1) {
                        echo "<i class='fas fa-scroll text-info'></i>";
                      } else if ($a['cekCat'] == 2) {
                        echo "<i class='fas fa-check text-success'></i>";
                      } ?>
                  <?php if ($a['cekCat'] == 1) { ?>
                  <!-- <span class="text">Catatan</span> -->
                  <?php } else if ($a['cekCat'] == 2) { ?>
                  <!-- <span class="text">Sudah</span> -->
                  <?php } ?>
                </a>
                <?php } ?>

                <?php if (!$cek[$count]) { ?>
                <!-- <span class="text">oke</span> -->
                <?php } ?>

              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <?php foreach ($ibu as $p) { ?>
      <h6 style="text-align:center" class="m-0 font-weight-bold text-primary">Grafik Posyandu <?php echo ucwords($p['nama_pos']) ?></h6>
      <?php } ?>
    </div>
    <div class="card-body">

      <div class='row justify-content-md-center'>
        <div class='col-lg-4'>
          <div class='card'>
            <canvas id='donatBB' width='100' height='100'></canvas>
          </div>
        </div>
        <div class='col-lg-4'>
          <div class='card'>
            <canvas id='donatTB' width='100' height='100'></canvas>
          </div>
        </div>
        <div class='col-lg-4'>
          <div class='card'>
            <canvas id='donatIMT' width='100' height='100'></canvas>
          </div>
        </div>
      </div>

    </div>
  </div>

</div>


<!--Modal-->
<div class="modal fade" id="info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered" role="document">
    <div class="modal-content" id="informasi">

    </div>
  </div>
</div>

<!--Modal Info-->
<div class="modal fade" id="info2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered" role="document">
    <div class="modal-content" id="informasi2">

    </div>
  </div>
</div>

<script>
  function getId(id) {
    $.ajax({
      url: "<?php echo base_url(); ?>index.php/DDS_Json/getInfo/admin",
      method: "POST",
      data: {
        id: id
      },
      success: function(data) {
        $('#informasi').html(data);
      }
    })
  }

  function loading(id) {
    $('#informasi').html('<div class="modal-header cssload-loader><h4 class="modal-title" id="exampleModalLabel">Loading..</h4><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
    getId(id);
  }

  function getId2(id) {
    $.ajax({
      url: "<?php echo base_url(); ?>index.php/DDS_Json/getAnak",
      method: "POST",
      data: {
        id: id
      },
      success: function(data) {
        $('#informasi2').html(data);
      }
    })
  }

  function loading2(id) {
    $('#informasi2').html('<div class="modal-header cssload-loader><h4 class="modal-title" id="exampleModalLabel">Loading..</h4><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
    getId2(id);
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
  var tooltip = {
    callbacks: {
      label: function(tooltipItem, data) {
        var dataset = data.datasets[tooltipItem.datasetIndex];
        var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
          return previousValue + currentValue;
        });
        var currentValue = dataset.data[tooltipItem.index];
        var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
        return " " + percentage + "% (" + currentValue + " anak)";
      }
    }
  };

  var ctx = document.getElementById('donatBB');
  var myDoughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Gizi Buruk', 'Gizi Kurang', 'Gizi Baik', 'Gizi Lebih'],
      datasets: [{
        label: 'Population (millions)',
        backgroundColor: ['#DB3644', '#FFBB17','#34eb4f', '#3159CA'],
        data: [<?php echo $jml['BBD'] ?>, <?php echo $jml['BBW'] ?>, <?php echo $jml['BBG'] ?>, <?php echo $jml['BBS'] ?>]
      }]
    },
    options: {
      legend: {
        display: true,
        position: 'bottom'
      },
      title: {
        display: true,
        text: 'Berat Badan Menurut Umur (BB/U)'
      },
      tooltips: tooltip,
    }
  });

  var ctx = document.getElementById('donatTB');
  var myDoughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Sangat Pendek', 'Pendek', 'Normal', 'Tinggi'],
      datasets: [{
        label: 'Population (millions)',
        backgroundColor: ['#DB3644', '#FFBB17','#34eb4f', '#3159CA'],
        data: [<?php echo $jml['TBD'] ?>, <?php echo $jml['TBW'] ?>, <?php echo $jml['TBG'] ?>, <?php echo $jml['TBS'] ?>]
      }]
    },
    options: {
      legend: {
        display: true,
        position: 'bottom'
      },
      title: {
        display: true,
        text: 'Tinggi Badan Menurut Umur (TB/U)'
      },
      tooltips: tooltip,
    }
  });

  var ctx = document.getElementById('donatIMT');
  var myDoughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Sangat Kurus', 'Kurus', 'Normal', 'Gemuk'],
      datasets: [{
        label: 'Population (millions)',
        backgroundColor: ['#DB3644', '#FFBB17','#34eb4f', '#3159CA'],
        data: [<?php echo $jml['BBTBD'] ?>, <?php echo $jml['BBTBW'] ?>, <?php echo $jml['BBTBG'] ?>, <?php echo $jml['BBTBS'] ?>]
      }]
    },
    options: {
      legend: {
        display: true,
        position: 'bottom'
      },
      title: {
        display: true,
        text: 'Berat Badan Menurut Tinggi Badan (BB/TB)'
      },
      tooltips: tooltip,
    },
  });
</script>