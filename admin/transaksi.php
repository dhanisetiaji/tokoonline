<?php
session_start();
error_reporting(0);
include('../include/koneksi.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
    if(isset($_GET['del'])){
        $id=$_GET['del'];
        $sql = "delete from users  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':id',$id, PDO::PARAM_STR);
        $query -> execute();
        $msg="Data Berhasil dihapus";
    }
    if(isset($_POST['update'])){
        $id=$_POST['id'];
        $resi=$_POST['resi'];
        $status=$_POST['status'];
        $sql="update transaksi set resi=:resi,status=:status where id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':resi',$resi,PDO::PARAM_STR);
        $query->bindParam(':status',$status,PDO::PARAM_STR);
        $query->bindParam(':id',$id,PDO::PARAM_STR);
        $query->execute();    
        $msg="Data berhasil diupdate";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MariPakai.co | Dashboard</title>
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <?php include('./inc/sidebar.php');?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Menu Admin</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12">
          <div class="card">
              <div class="card-header">
                <!-- <a href="tambah-produk.php" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Produk</a> -->
                <?php 
                    if($error){
                ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert"><?php echo htmlentities($error); ?> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php } 
				    else if($msg){
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert"><?php echo htmlentities($msg); ?> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php }?>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Pembeli</th>
                    <th>Alamat Lengkap</th>
                    <th>Total Bayar</th>
                    <th>Resi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    function rupiah($angka){
	
                        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
                        return $hasil_rupiah;
                     
                    }
                        $sql = "select transaksi.id,transaksi.id_customer,transaksi.resi,transaksi.alamat_lengkap,transaksi.totalbayar,transaksi.status,transaksi.tanggal_transaksi,users.NamaLengkap from transaksi join users on transaksi.id_customer=users.id";
                        $query = $dbh -> prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        $nmr=1;
                        if($query->rowCount() > 0){
                            foreach($results as $res){
                    ?>
                  <tr>
                      
                    <td><?php echo htmlentities($nmr);?></td>
                    <td><?php echo htmlentities($res->NamaLengkap);?></td>
                    <td><?php echo htmlentities($res->alamat_lengkap);?></td>
                    <td><?php echo rupiah($res->totalbayar);?></td>
                    <td><?php echo htmlentities($res->resi);?></td>
                    <td><?php if($res->status=='0'){echo "Belum dibayar";}else{echo "Terbayar";} ?></td>
                    <td>
                        <a type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#MyModal<?php echo $res->id;?>"><i class="fas fa-edit"></i></a>
                        <a href="sold.php?del=<?php echo $res->id;?>" onclick="return confirm('Do you want to delete');" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                  <div class="modal fade" id="MyModal<?php echo $res->id;?>">
                    <div class="modal-dialog" >
                    <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title">Update Transaksi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form action="" role="form" method="post" onSubmit="return valid();">
                                <div class="form-group">
                                    <label for="">Resi</label>
                                    <input type="hidden" name="id" class="form-control" value="<?php echo htmlentities($res->id)?>">
                                    <input type="text" name="resi" class="form-control" value="<?php echo htmlentities($res->resi)?>">
                                    <!-- <button Type="submit" name="updatestok" class="btn btn-primary mt-4">Update</button> -->
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control" required>
                                    <option value="<?php echo htmlentities($res->status)?>">--<?php if($res->status=='0'){echo "Belum dibayar";}else{echo "Terbayar";} ?>--</option>
                                    <option value="1">Sudah Bayar</option>
                                    <option value="0">Belum Bayar</option>
                                    </select>
                                    <button Type="submit" name="update" class="btn btn-primary mt-4">Update</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        
                        </div>
                    </div>
                    <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                  <?php $nmr=$nmr+1; } } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0-rc
    </div>
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
<?php } ?>