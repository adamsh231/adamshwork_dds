<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div class="container-fluid">
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 style="text-align:center" class="m-0 font-weight-bold text-primary">Daftar Ibu</h6>
    </div>
    <div class="card-body">
      <a href="<?php echo base_url() ?>index.php/DDS/index/tambahibu" style="float:right" class="btn btn-sm btn-success btn-icon-split"><span class="icon text-white"><i class="fas fa-user-plus"></i></span><span class="text">Tambah Ibu</span></a>
      <br>
      <hr>
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th width="30" style="text-align:center">No</th>
              <th style="text-align:center">Nama</th>
              <th style="text-align:center">Anak</th>
              <th style="text-align:center"></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $count = 0;
            foreach ($ibu as $a) {
              $count++; ?>
              <tr>
                <td style="text-align:center"><?php echo $count ?></td>
                <td><a href="<?php echo base_url() ?>index.php/DDS_Auth/pilihIbu/<?php echo $a['id'] ?>"><?php echo ucwords($a['nama']) ?></a><?php echo ($a['nik'] == "" ? '<sub style="float:right"><span class="badge badge-pill badge-warning">NIK Kosong</span></sub>' : '')?></td>
                <td style="text-align:center"><?php echo $jml[$count] ?></td>
                <td style="text-align:center"><a onclick="loading(<?php echo $a['id'] ?>)" href="#" data-toggle="modal" data-target="#info"><i class='fas fa-info-circle'></i></a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
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

<script>
  function getId(id) {
    $.ajax({
      url: "<?php echo base_url(); ?>index.php/DDS_Json/getIbu",
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
</script>