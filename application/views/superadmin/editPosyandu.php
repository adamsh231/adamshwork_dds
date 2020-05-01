<?php if(isset($_SESSION['update'])){echo ($_SESSION['update']);}?>
<?php foreach($pos2 as $a){?>
<div class="card shadow mb-4">
    <!-- <div class="card-header py-3">
        <h6 style="text-align:center" class="m-0 font-weight-bold text-primary"><?php echo ucwords($a['nama_ibu'])?></h6>
    </div> -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        
                            <form class="form-horizontal" role="form" method="POST" action="<?php echo base_url()?>index.php/DDS_Insert/updatePosyandu" enctype="multipart/form-data">
                                    
                                    <div class="form-group">
                                        <label for="inputNama">Nama</label>
                                        <input value="<?php echo $a['nama']?>" type="text" class="form-control" id="inputNama" name="inputNama"  placeholder="Nama Kader"  required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputKode">Kode Pos</label>
                                        <input value="<?php echo $a['kodepos']?>" type="number" class="form-control" id="inputKode" name="inputKode"  placeholder="Nomor Handphone yang dapat dihubungi">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAlamat">Alamat</label>
                                        <textarea id="inputAlamat" name="inputAlamat" class="form-control" rows="5"><?php echo $a['alamat']?></textarea>
                                    </div>

                                <button style="float:right" type="submit" name="submit" class="btn btn-primary ">Edit</button>
                            </form>
                        

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }?>