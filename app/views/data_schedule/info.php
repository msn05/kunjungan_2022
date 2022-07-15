<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="col-sm-2 p-2">
      <a type="button" href="<?= Controller; ?>schedule" class="btn btn-info btn-sm "><i class="fas fa-arrow-left"></i></a>
    </div>
    <div class="card">
      <div class="card-header p-2">
        <ul class="nav nav-pills">
          <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Data Kunjungan</a></li>
          <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Fasilitas</a></li>
          <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Jadwal</a></li>
        </ul>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active" id="activity">

            <form>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Nama Pegawai Pengaju Kunjungan</label>
                    <input type="text" class="form-control" value="<?= $data['table'][0]->name_employee; ?>" placeholder="Enter ..." disabled="">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Tanggal Kunjungan</label>
                    <input type="text" class="form-control" value="<?= date('Y-m-d', strtotime($data['table'][0]->date_expired)); ?>" placeholder="Enter ..." disabled>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Tujuan</label>
                    <textarea name="" id="" class="form-control" cols="30" rows="2" disabled=""><?= $data['table'][0]->destination; ?></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Total Pegawai Mengikuti</label>
                    <input type="text" class="form-control" value=" <?= $data['table'][0]->totals_follow_employee; ?>" placeholder="Enter ..." disabled="">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Keperluan</label>
                    <textarea name="" id="" class="form-control" cols="30" rows="2" disabled=""><?= $data['table'][0]->necessity; ?></textarea>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="timeline">
            <div class="col-md-5">
              <table id="example" class="table table-bordered table-hover" style="width:100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($data['table'][1] as $key => $value) {
                  ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $value->name; ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="settings">
            <ul class="list-unstyled">
              <li>
                <i class="far fa-fw fa-times-circle "></i> <?= date('d M Y', strtotime($data['table'][0]->date_expired)); ?>
              </li>
              <li>
                <i class="fas fa-fw fa-question-circle"></i> <?= $data['table'][0]->statuses_visit == 0 ? 'Pending' : 'Done'; ?>
              </li>
              <li>
                <i class="fas fa-fw fa-stream"></i> <?= $data['table'][0]->results; ?>
              </li>
            </ul>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div><!-- /.card-body -->
    </div>

  </div><!-- /.container-fluid -->
</div>
<script>
  $('#example').DataTable({
    "searching": false,
    "info": false,
    "paging": false,
    "length": false
  });
</script>