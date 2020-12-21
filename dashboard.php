<?php 
session_start();
include('./include/koneksi.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
	{	
header('location:index.php');
}
else{
    function rupiah($angka){
        
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;
    
    }
    $username = $_SESSION['login'];
    $qgetid= "select * from users where Username=:username";
    $getid = $dbh->prepare($qgetid);
    $getid->bindParam(':username',$username);
    $getid->execute();
    $dataid=$getid->fetch();
    $sid = $dataid['id'];
    if(isset($_POST['update'])){
        $namalengkap=$_POST['namalengkap'];
        $email=$_POST['email'];
        // $password=md5($_POST['password']);
        $alamat=$_POST['alamat'];
        $kodepos=$_POST['kodepos'];
        $telepon=$_POST['telepon'];
        $sql="update users set NamaLengkap=:namalengkap,Email=:email,Alamat=:alamat,Kodepos=:kodepos,No_telepon=:telepon where id=:sid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':sid',$sid,PDO::PARAM_STR);
        $query->bindParam(':namalengkap',$namalengkap,PDO::PARAM_STR);
        $query->bindParam(':email',$email,PDO::PARAM_STR);
        // $query->bindParam(':password',$password,PDO::PARAM_STR);
        $query->bindParam(':alamat',$alamat,PDO::PARAM_STR);
        $query->bindParam(':kodepos',$kodepos,PDO::PARAM_STR);
        $query->bindParam(':telepon',$telepon,PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        $msg="Profil Berhasil diupdate, refresh";
        header('Location:./dashboard.php');
    }
    if(isset($_POST['submit']))
    {
        $password=md5($_POST['password']);
        $newpassword=md5($_POST['newpassword']);
        $sql ="SELECT Password FROM users WHERE Username=:username and Password=:password";
        $query= $dbh -> prepare($sql);
        $query-> bindParam(':username', $username, PDO::PARAM_STR);
        $query-> bindParam(':password', $password, PDO::PARAM_STR);
        $query-> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        if($query -> rowCount() > 0)
        {
            $con="update users set Password=:newpassword where Username=:username";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1-> bindParam(':username', $username, PDO::PARAM_STR);
            $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
            $msg="Your Password succesfully changed";
        }
        else {
            $error="Your current password is not valid.";	
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maripakai.co</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Sriracha&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1462889/unicons.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <?php include('include/header.php');?>
    <section class="main">
        <div class="container">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <?php
                        $sql = "select * from slider where id=1";
                        $query = $dbh -> prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        $nmr=1;
                        if($query->rowCount() > 0){
                            foreach($results as $slid){
                    ?>
                    <div class="carousel-item active">
                        <img src="./admin/img/slider/<?php echo htmlentities($slid->gambar_slider);?>" class="d-block w-100" alt="..">
                    </div>
                    <?php ; } } ?>
                    <?php
                        $sql = "select * from slider where id!=1";
                        $query = $dbh -> prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        $nmr=1;
                        if($query->rowCount() > 0){
                            foreach($results as $slid){
                    ?>
                  <div class="carousel-item">
                    <img src="./admin/img/slider/<?php echo htmlentities($slid->gambar_slider);?>" class="d-block w-100" alt="..">
                  </div>
                  <!-- <div class="carousel-item active">
                    <img src="./assets/img/men4.jpg" class="d-block w-100" alt="..">
                  </div>
                  <div class="carousel-item">
                    <img src="./assets/img/kid6.jpg" class="d-block w-100" alt="..">
                  </div> -->
                  <?php ; } } ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
            </div>
              <h4 class="text-center mt-5">Dashboard Customer</h4>
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
                <br><div class="alert alert-success alert-dismissible fade show" role="alert"><?php echo htmlentities($msg); ?> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php }?>
              <div class="row justify-content-center">
              <div class="col-md-10">
                    <div class="card">
                        <div class="card-body mb-2">
                            <ul class="nav nav-pills justify-content-between mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-pesanan-tab" data-toggle="pill" href="#pills-pesanan" role="tab" aria-controls="pills-pesanan" aria-selected="true">Pesanan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-status-tab" data-toggle="pill" href="#pills-status" role="tab" aria-controls="pills-status" aria-selected="false">Transaksi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profil-tab" data-toggle="pill" href="#pills-profil" role="tab" aria-controls="pills-profil" aria-selected="false">Profile</a>
                                </li>
                            </ul>
                            <hr>
                            <div class="tab-content text-center m-3" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-pesanan" role="tabpanel" aria-labelledby="pills-pesanan-tab">
                                    <div class="container">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Nama Produk</th>
                                                    <th scope="col">Qty</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Tanggal Pesan</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    // var_dump($sid);
                                                    $sql = "select * from product_sold where id_customer=:sid";
                                                    $query = $dbh -> prepare($sql);
                                                    $query->bindParam(':sid',$sid);
                                                    $query->execute();
                                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                    $nmr=1;
                                                    if($query->rowCount() > 0){
                                                        foreach($results as $res){
                                                ?>
                                                <tr>
                                                    <td><?php echo htmlentities($nmr);?></td>
                                                    <td><?php echo htmlentities($res->nama_produk) ?></td>
                                                    <td><?php echo htmlentities($res->qty) ?></td>
                                                    <td><?php echo rupiah($res->harga) ?></td>
                                                    <td><?php echo rupiah($res->total) ?></td>
                                                    <td><?php echo htmlentities($res->date) ?></td>
                                                </tr>
                                                <?php $nmr=$nmr+1; } } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-status" role="tabpanel" aria-labelledby="pills-status-tab">
                                    <div class="container">
                                    <p>*status pembayaran akan berubah 1x24jam setelah melakukan pembayaran</p>
                                    <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Resi</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Tanggal</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    // var_dump($sid);
                                                    $sql = "select * from transaksi where id_customer=:sid";
                                                    $query = $dbh -> prepare($sql);
                                                    $query->bindParam(':sid',$sid);
                                                    $query->execute();
                                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                    $nmr=1;
                                                    if($query->rowCount() > 0){
                                                        foreach($results as $res){
                                                ?>
                                                <tr>
                                                    <td><?php echo htmlentities($nmr);?></td>
                                                    <td><?php echo rupiah($res->totalbayar) ?></td>
                                                    <td><?php echo htmlentities($res->resi) ?></td>
                                                    <td><?php if($res->status=='0'){echo "Belum dibayar";}else{echo "Terbayar";} ?></td>
                                                    <td><?php echo htmlentities($res->tanggal_transaksi) ?></td>
                                                </tr>
                                                <?php $nmr=$nmr+1; } } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-profil" role="tabpanel" aria-labelledby="pills-profil-tab">
                                    <div class="container">
                                        <form action="" method="POST" onSubmit="return valid();">
                                            <div class="form-group">
                                                <label for="">Nama Lengkap</label>
                                                <input type="text" name="namalengkap" value="<?= $dataid['NamaLengkap'];?>" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input type="email" name="email" value="<?= $dataid['Email'];?>" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Username</label>
                                                <input type="text" name="username" value="<?= $dataid['Username'];?>" class="form-control" required readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Alamat</label>
                                                <textarea type="text" name="alamat" class="form-control" row="4" required><?= $dataid['Alamat'];?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Kodepos</label>
                                                <input type="text" name="kodepos" value="<?= $dataid['Kodepos'];?>" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Telepon</label>
                                                <input type="number" name="telepon" value="<?= $dataid['No_telepon'];?>" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <button name="update" class="btn btn-primary w-100">Update</button>
                                            </div>
                                        </form>
                                        <button type="button" class="btn btn-primary w-100" data-toggle="modal" data-target="#MyModal<?php echo $res->id;?>">Change Password</button>
                                        <!-- MODAL UPDATE -->
                                        <div class="modal fade" id="MyModal<?php echo $res->id;?>">
                                            <div class="modal-dialog" >
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update Password</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" role="form" method="post" onSubmit="return valid();">
                                                            <div class="form-group">
                                                                <label for="">Password Sebelumnya</label>
                                                                <input type="password" name="password" class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Password Baru</label>
                                                                <input type="password" name="newpassword" class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                    <label for="">Konfirmasi Password</label>
                                                                    <input type="password" name="confirmpassword" class="form-control" required>
                                                            </div>
                                                            <button Type="submit" name="submit" class="btn btn-primary w-100">Save</button>
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
                                        <!-- /.END modal UPDATE -->
                                    </div>
                                </div>
                            </div>  
                        </div> 
                    </div> 
                </div> 
              </div>
        </div>
    </section>

    <footer class="section-footer bg-light mt-4">
        <section class="footer pt-4">
            <div class="container">
                <div class="row pb-3">
                    <aside class="col-md-4">
                        <h6 class="title">COMPANY</h6>
                        <ul class="list-unstyled">
                            <li> <a href="#">ABOUT US</a></li>
                            <li> <a href="#">CAREERS</a></li>
                            <li> <a href="#">STORIES</a></li>
                            <li> <a href="#">OUR EVENT</a></li>
                            <li> <a href="#">SITEMAP</a></li>
                        </ul>
                    </aside>
                    <aside class="col-md-4">
                        <h6 class="title">HELP</h6>
                        <ul class="list-unstyled">
                            <li> <a href="#">CONTACT US</a></li>
                            <li> <a href="#">TERMS & CONDITION</a></li>
                            <li> <a href="#">ORDER STATUS</a></li>
                            <li> <a href="#">FAQ'S</a></li>
                            <li> <a href="#">CONFIRM</a></li>
                        </ul>
                    </aside>
                    <aside class="col-md-4">
                        <h6>LANGGANAN NEWSLETTER</h6>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Masukan email">
                            <div class="input-group-append">
                              <button class="btn" type="button" >WANITA</button>
                              <button class="btn" type="button" >PRIA</button>
                            </div>
                          </div>
                    </aside>
                </div>
                <div class="floor">
                    <span class="floor-label"> Metode Pembayaran 
                        <img src="./assets/img/payment.svg" alt="" style="margin-left: 10mm;">
                    </span>
                </div>
            </div>
            <br>
            <div class="bg-footer" style="height: 40px;">
                <div class="text-center pt-2">&copy; COPYRIGHT 2020 Maripakai.co</div>
            </div>    
            <!-- Back to top -->
            <div class="progress-wrap">
                <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                    <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
                </svg>
            </div>
        </section>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./assets/js/script.js"></script>
</body>
</html>
<?php } ?>