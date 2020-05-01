<?php if (isset($_SESSION['id_anak'])) {
    foreach ($anak as $a) { ?>
        <div class="container-fluid">
            <div class="col-xl-13 col-lg-13">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 flex-row align-items-center justify-content-between">
                        <h6 style="text-align:center" class="m-0 font-weight-bold text-primary"><?php echo ucwords($a['nama']) ?></h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">

                        <?php foreach ($rekomendasi as $r) { ?>
                            <div class="card border-left-warning mb-3">
                                <div class="card-body">
                                    <p class="card-text text-dark"><?php echo $r['deskripsi'] ?></p>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    <?php }
} else { ?>
    <div class="container-fluid">
        <div class="col-xl-13 col-lg-13">
            <div class="card shadow mb-4">

                <!-- Card Body -->
                <div class="card-body">

                    <div class="text-center">
                        <img class="figure-img img-fluid rounded" style="width: 6rem;" src="<?php echo base_url() ?>sbadmin/img/baby-boy.ico" alt="">
                        <img class="figure-img img-fluid rounded" style="width: 6rem;" src="<?php echo base_url() ?>sbadmin/img/baby-girl.ico" alt="">
                    </div>
                    <hr>
                    <div style="text-align:center">
                        <a class="btn btn-primary btn-lg" href="<?php echo base_url() ?>index.php/DDS/index/daftaranak">Pilih Anak</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php } ?>