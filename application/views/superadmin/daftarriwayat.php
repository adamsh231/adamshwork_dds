
<div class="container-fluid">
    <?php if(isset($_SESSION['id_anak'])){foreach($anak as $a){?>
        <div class="col-xl-13 col-lg-13">
            <div class="card shadow mb-4">
                <div class="card-header py-3 flex-row align-items-center justify-content-between">
                        <h6 style="text-align:center" class="m-0 font-weight-bold text-primary"><?php echo ucwords(strtolower($a['nama']))?></h6>
                </div>
    
                <div class="card-body">
                    <div style="overflow-y: scroll; height:350px;" class="list-group">

    <?php }$id = 0;$sts = [];foreach($record as $r){$id = $id+1;?>
    <?php 
        if($r['zbb'] < -3){
            $sts['BB'] = "Gizi Buruk";
        }else if($r['zbb'] > 2){
            $sts['BB'] = "Gizi Lebih";
        }else if($r['zbb'] < -2){
            $sts['BB'] = "Gizi Kurang";
        }else if($r['zbb'] <= 2 && $r['zbb'] >= -2){
            $sts['BB'] = "Gizi Baik";
        }
        if($r['ztb'] < -3){
            $sts['TB'] = "Sangat Pendek";
        }else if($r['ztb'] > 2){
            $sts['TB'] = "Tinggi";
        }else if($r['ztb'] < -2){
            $sts['TB'] = "Pendek";
        }else if($r['ztb'] <= 2 && $r['ztb'] >= -2){
            $sts['TB'] = "Normal";
        }
        if($r['zimt'] < -3){
            $sts['IMT'] = "Sangat Kurus";
        }else if($r['zimt'] > 2){
            $sts['IMT'] = "Gemuk";
        }else if($r['zimt'] < -2){
            $sts['IMT'] = "Kurus";
        }else if($r['zimt'] <= 2 && $r['zimt'] >= -2){
            $sts['IMT'] = "Normal";
        }
        if($r['zbbtb'] == 999999){
            $r['zbbtb'] = "(N/A)";
            $sts['BBTB'] = "Tidak Terdefinisi";
        }else if($r['zbbtb'] < -3){
            $sts['BBTB'] = "Sangat Kurus";
        }else if($r['zbbtb'] > 2){
            $sts['BBTB'] = "Gemuk";
        }else if($r['zbbtb'] < -2){
            $sts['BBTB'] = "Kurus";
        }else if($r['zbbtb'] <= 2 && $r['zbbtb'] >= -2){
            $sts['BBTB'] = "Normal";
        }
    ?>
                        <!-- Card Header - Accordion -->
                            <a href="#collapseCardExample<?php echo $id?>" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-primary">Record pada umur yang ke-<?php echo $r['usia']?> Bulan (<?php echo ucwords(strtolower($bulan[$r['bulan']]))." ".$r['tahun']?><span style="float:right" class="badge badge-light"><?php echo date_format(date_create($r['update']),'d-M-Y')?></span>)</h6>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse" id="collapseCardExample<?php echo $id?>">
                                <div class="card-body">
                                    <p><strong>Umur <?php echo $r['usia']?> bulan, Berat Badan <?php echo $r['bb_skrg']?> Kg, Tinggi Badan <?php echo $r['tb_skrg']?> cm</strong></p>
                                    <p><strong>BB/U <?php echo round($r['zbb'],2)?> SD (<?php echo $sts['BB']?>), TB/U <?php echo round($r['ztb'],2)?> SD (<?php echo $sts['TB']?>), IMT/U <?php echo round($r['zimt'],2)?> SD (<?php echo $sts['IMT']?>), BB/TB <?php echo round($r['zbbtb'],2)?> SD (<?php echo $sts['BBTB']?>)</strong></p>
                                </div>
                            </div>
    <?php }if($id == 0){?>

                            <div style="text-align:center">
                                <br><br><br><br>
                                Belum Ada Riwayat Anak
                                <br>
                                <br>
                                <a href="<?php echo base_url()?>index.php/DDS/index/tambahriwayat" class="btn btn-info btn-sm">
                                    <span class="text">Tambah</span>
                                </a>
                            </div>

    <?php }?>


                    </div>
                </div>
            </div>
        </div>
    <?php }else{?>
        <div class="col-xl-13 col-lg-13">
            <div class="card shadow mb-4">
                <div class="card-header py-3 flex-row align-items-center justify-content-between">
                    <div style="text-align:center">
                        <a class="btn btn-primary btn-lg" href="<?php echo base_url()?>index.php/DDS/index/daftaranak">Pilih Anak</a>
                    </div>
                </div>
            </div>
        </div>
    <?php }?>
</div>