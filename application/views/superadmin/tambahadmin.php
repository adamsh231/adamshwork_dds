<div class="container-fluid">

    <!-- Page Heading -->
    <div class="col-xl-12">
        <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
            <!-- Card Body -->
            <div class="card-body">
            <?php if(isset($_SESSION['register'])){echo $_SESSION['register'];}?>
                <form id="frm" action="<?php echo base_url()?>index.php/DDS_Insert/InsertDataAdmin" method="post">
                    <div class="form-group">
                        <label for="inputNama">Nama</label>
                        <input value="" type="text" class="form-control" id="inputNama" name="inputNama"  placeholder="Nama Kader"  required>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Username</label>
                        <input value="" type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="inputHp">Nomor Handphone</label>
                        <input value="" type="number" class="form-control" id="inputHp" name="inputHp"  placeholder="Nomor Handphone yang dapat dihubungi"  required>
                    </div>
                    <div class="form-group">
                        <label for="inputAlamat">Alamat Sekarang</label>
                        <textarea id="inputAlamat" name="inputAlamat" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="inputIdPos">Kader Posyandu</label>
                        <select class="form-control" id="posyandu" name="inputIdPos">
                            <?php foreach($pos as $p){?>
                                <option value="<?php echo $p['id']?>">Posyandu <?php echo ucwords($p['nama'])?></option>
                            <?php }?>
                        </select>
                    </div>
                    <button class="btn btn-primary btn-user btn-block" name="submit" type="submit">
                    Tambah
                    </button>
                    <!-- <hr> -->
                </form>
            </div>
        </div>
    </div>

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