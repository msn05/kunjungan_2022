<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="col-md-8">
      <?php

      use App\Controllers\Controller;
      use Core\Message;

      if (@$_SESSION) {
        Message::createMessage();
        unset($_SESSION['message']);
      }
      ?>
      <blockquote class="quote-danger mt-0">
        <h5 id="tip"><?= $data['header']; ?></h5>
        <p>Halaman ini menampung data fasilitas yang didapatkan saat kunjungan </p>
      </blockquote>
      <div class="card card-outline card-primary">
        <div class="card-body">
          <table id="example" class="display" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Tujuan Kunjungan</th>
                <th>Daftar Fasilitas</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($data['table'] as $key => $value) {
              ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $value['destinantion']; ?></td>
                  <td>

                    <?php

                    if (!empty($value['facility'])) {
                      foreach ($value['facility'] as $keys => $values) { ?>
                        <?= $keys + 1 . ':' . $values->name;
                        echo '<br>' ?>
                    <?php }
                    } else {
                      '-';
                    }
                    ?>
                  </td>
                  <td>
                    <?php if (date('Y-m-d', strtotime($value['date_visited'])) < date('Y0m-d')) {
                      if (@$_SESSION['account']['Case'] == 2) {
                    ?>
                        <button type="button" id="add" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-fasilitas" data-id="<?= $value['id']; ?>"> Tambah</button>
                      <?php } elseif (@$_SESSION['account']['Case'] == 1) { ?>
                        <button type="button" id="update" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-fasilitas" data-id="<?= $value['id']; ?>"> Edit</button>
                    <?php
                      }
                    } ?>
                  </td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>


  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<script>
  $(document).ready(function() {
    $('#example').DataTable();
    $('#example').on('click', '#add,#update', function(e) {
      if ($(this).attr('id') == 'update') {
        $('#modal-fasilitas').find('.modal-title').text('Updated data');
        $('#modal-fasilitas form').attr('action', '<?= Controller; ?>/fasility/update');
        $('#modal-fasilitas form input[name="id"]').before(`<div class="form-group row new-row"><input type="text" class="form-control" name="old_name" id="inputEmail3" placeholder="Masukkan nama fasilitas yang ingin diubah"></div>`)
      } else {
        $('#modal-fasilitas').find('.modal-title').text('Tambah fasilitas');
      }
      $('#modal-fasilitas input[name="id"]').val($(this).data('id'))
    })

  });
</script>