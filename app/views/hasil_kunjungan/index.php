<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-10">
        <blockquote class="quote-danger mt-0">
          <h5 id="tip"><?= $data['header']; ?></h5>
          <p>Halaman ini mennghasilkan report terhadap kunjungan yang terjadi. </p>
        </blockquote>
      </div>
      <?php
      if (@$_SESSION['account']['isLogin']) { ?>
        <div>
          <button type="button" class="btn btn-success btn-block" onclick="window.printPage('accordion')"> PRINT</button>
        </div>
      <?php } ?>
    </div>
    <!-- /.card-header -->
    <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
    <div id="accordion">
      <?php
      foreach ($data['table'] as $key => $value) {
      ?>
        <div class="card card-primary">
          <div class="card-header">
            <h4 class="card-title w-100">
              <a class="d-block w-100" data-toggle="collapse" href="#collapse-<?= $key; ?>">
                <?= $value[0]->destination; ?>
              </a>
            </h4>
          </div>
          <div id="collapse<?= $key; ?>" class="collapse show" data-parent="#accordion">
            <div class="card-body">
              <dl class="row">
                <dt class="col-sm-4">Diajukan oleh</dt>
                <dd class="col-sm-8">: <?= $value[0]->name_employee; ?></dd>
                <dt class="col-sm-4">Tanggal Kunjungan</dt>
                <dd class="col-sm-8">: <?= date('d M Y', strtotime($value[0]->date_visit)); ?></dd>
                <dt class="col-sm-4">Total Pengawai Ikut</dt>
                <dd class="col-sm-8">: <?= $value[0]->totals_follow_employee . ' Orang'; ?></dd>
                <dt class="col-sm-4">Keperluan</dt>
                <dd class="col-sm-8">: <?= $value[0]->necessity; ?>
                <dt class="col-sm-4">Fasilitas</dt>
                <dd class="col-sm-8">
                  <table class="table table-bordered" style="width: 50%;">
                    <thead class="bg-primary">
                      <tr>
                        <th width="5%">No</th>
                        <th>Nama</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      if (is_object($value[1])) $value[1] = [$value[1]];
                      foreach ($value[1] as $key => $values) { ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $values->name; ?></td>
                        </tr>
                      <?php
                      } ?>
                    </tbody>
                  </table>
                </dd>
                <dt class="col-sm-4">Status</dt>
                <dd class="col-sm-8">: <?= $value[0]->statuses_visit == 0 ? 'Pending' : 'Done'; ?>
                <dt class="col-sm-4">Lama Kunjungan</dt>
                <dd class="col-sm-8">: <?= round(date(strtotime($value[0]->date_expired) - strtotime($value[0]->date_visit)) / (60 * 60 * 24)) . ' Hari';  ?>
              </dl>
            </div>
          </div>
        </div>
      <?php }
      ?>
      <!-- /.card-body -->
    </div>


  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<script>
  function printPage(id) {
    var divContents = document.getElementById(id).innerHTML;
    var a = window.open('', '');
    a.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"><html>');
    a.document.write('<body >');
    a.document.write(divContents);
    a.document.write('</body></html>');
    a.document.close();
    a.print();

  }
</script>