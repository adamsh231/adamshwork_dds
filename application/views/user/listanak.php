
<div class="container-fluid">
    <div class="col-xl-13 col-lg-13">
        <div class="card shadow mb-4">
            <div class="card-header py-3 flex-row align-items-center justify-content-between">
                  <h6 style="text-align:center" class="m-0 font-weight-bold text-primary">Daftar Anak Anda</h6>
            </div>
            <?php $row = 0?>
            <!-- Card Body -->
            <div class="card-body">
                <div style="overflow-y: scroll; height:250px;" class="list-group">
                    <?php foreach($anak as $a){?>
                        <?php
                            $diff = date_diff(date_create($a['tgl_lahir']),date_create(date('Y-m-d')));
                            $umur = $diff->days/30;
                            $day = $diff->days % 30;
                            $row = $row + 1;
                        ?>
                       <h5><a href="<?php echo base_url()?>index.php/DDS_Auth/pilihAnak/<?php echo $a['id']?>/<?php echo $a['id_ibu']?>" class="list-group-item list-group-item-action"><?php echo ucwords(strtolower($a['nama']))?><span style="float:right" class="badge badge-light"><?php echo (int)($umur)?> Bulan <?php echo round($day)?> Hari</span></a></h5>
                    <?php }if ($row == 0){?>
                        <div style="text-align:center">
                            <br><br><br>
                            Anda Belum Mendaftarkan Anak Anda<br> Daftarkan di Posyandu Terdekat
                            <br>
                            <!-- <a href="<?php echo base_url()?>index.php/tambahAnak" class="btn btn-info btn-sm">
                                <span class="text">Daftar!</span>
                            </a> -->
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>