<div class="container-fluid">
    <?php if(isset($_SESSION['id_anak'])){foreach($anak as $a){ 
        $diff = date_diff(date_create($a['tgl_lahir']),date_create(date('Y-m-d')));
        $umur = $diff->days/30;
        $day = $diff->days % 30;
    ?>
    <!-- Page Heading -->
    <div class="col-xl-12">
        <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
            <div class="card-header py-3 flex-row align-items-center justify-content-between">
                <h6 style="text-align:center" class="m-0 font-weight-bold text-primary"><?php echo ucwords(strtolower($a['nama']))?></h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
            <?php if(isset($_SESSION['tambah'])){echo $_SESSION['tambah'];}?>
                <form id="frm" action="<?php echo base_url()?>index.php/tambahRecord" method="post">
                    <div class="form-group">
                        <label for="customRange2">Berat Badan Sekarang (Kg)</label>
                        <div class="form-group row">
                            <div class="col-sm-10 mb-3 mb-sm-0">
                                <input oninput="berat()" id="inputBB" type="range" class="custom-range" min="0.1" max="50" step="0.1" required>
                            </div>  
                            <div class="col-sm-2">
                                <input placeholder="Berat(Kg)" onkeyup="berat2()" id="valueBB" name="inputBB" type="number" class="form-control" min="0.1" max="50" step="0.1" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTinggiBadan">Tinggi Badan Sekarang (cm)</label>
                        <div class="form-group row">
                            <div class="col-sm-10 mb-3 mb-sm-0">
                                <input oninput="tinggi()" id="inputTB" type="range" class="custom-range" min="0.1" max="200" step="0.1" required>
                            </div>  
                            <div class="col-sm-2">
                            <input onkeyup="tinggi2()" type="number" min="0.1" max="200" step="0.1" value="" class="form-control" id="valueTB" name="inputTB" placeholder="Tinggi(cm)" required>
                            </div>
                        </div>
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

                    <input type="hidden" name="inputUmur" value="<?php echo (int)$umur?>">

                    <button class="btn btn-primary btn-user btn-block" name="submit" type="submit">
                    Tambah
                    </button>
                    <!-- <hr> -->
                </form>
            </div>
        </div>
    </div>
<?php }}else{?>
    <div class="col-xl-12">
        <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
            <div class="card-header py-3 flex-row align-items-center justify-content-between">
                <div style="text-align:center">
                    <a class="btn btn-primary btn-lg" href="<?php echo base_url()?>index.php/DDS/index/daftaranak">Pilih Anak</a>
                </div>
            </div>
        </div>
    </div>
<?php }?>
</div>

<script>
    function berat(){
        document.getElementById("valueBB").value = document.getElementById("inputBB").value;
    }
    function berat2(){
        document.getElementById("inputBB").value = document.getElementById("valueBB").value;
    }
    function tinggi(){
        document.getElementById("valueTB").value = document.getElementById("inputTB").value;
    }
    function tinggi2(){
        document.getElementById("inputTB").value = document.getElementById("valueTB").value;
    }
</script>