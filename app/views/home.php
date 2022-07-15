<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <?php

    use Core\Message;

    if (@$_SESSION['account']) {
      Message::createMessage();
      unset($_SESSION['message']);
    } else { ?>
      <div class="alert alert-warning alert-dismissible">
        <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
        Anda menggunakan account guest
      </div>
    <?php }
    ?>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->