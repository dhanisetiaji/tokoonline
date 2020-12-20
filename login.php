<?php
session_start();
error_reporting(0);
include('./include/koneksi.php');
if(strlen($_SESSION['login'])!=0){	
    header('location:index.php');
    }
else{
if(isset($_POST['login'])){
  $username=$_POST['username'];
  $password=md5($_POST['password']);
  $sql ="SELECT Username,Password FROM users WHERE Username=:username and Password=:password";
  $query= $dbh -> prepare($sql);
  $query-> bindParam(':username', $username, PDO::PARAM_STR);
  $query-> bindParam(':password', $password, PDO::PARAM_STR);
  $query-> execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  if($query->rowCount() > 0){
    $_SESSION['login']=$_POST['username'];
    echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
  } else{
    echo "<script>alert('Login Gagal. Username/Password salah!');</script>";
  }
}
if(isset($_POST['daftar'])){
    $email=$_POST['email'];
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $nama=$_POST['nama'];
    $alamat=$_POST['alamat'];
    $kodepos=$_POST['kodepos'];
    $telepon=$_POST['telepon'];
    $sql="INSERT INTO users(NamaLengkap,Email,Username,Password,Alamat,Kodepos,No_telepon) VALUES(:nama,:email,:username,:password,:alamat,:kodepos,:telepon)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':username',$username,PDO::PARAM_STR);
    $query->bindParam(':password',$password,PDO::PARAM_STR);
    $query->bindParam(':nama',$nama,PDO::PARAM_STR);
    $query->bindParam(':alamat',$alamat,PDO::PARAM_STR);
    $query->bindParam(':kodepos',$kodepos,PDO::PARAM_STR);
    $query->bindParam(':telepon',$email,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId){
        echo "<script>alert('Berhasil mendaftar, Silahkan login!');</script>";
    }
    else {
        echo "<script>alert('Daftar Gagal. Cek kembali data anda!');</script>";
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
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <header class="bg-nav fixed-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light px-lg-0">
                <a class="navbar-brand mr-3 " href="index.php"><img src="./assets/img/logo.png" alt="" width="60" height="60" >    Maripakai.co</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                    <ul class="navbar-nav navbar-custom">
                        <!-- <li class="nav-item "> <a href="Anak.html" class="nav-link">Anak</a> </li> -->
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item d-flex align-items-center">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search">
                                <div class="input-group-append">
                                  <button class="btn btn-outline-secondary searching" type="button" ><i class="las la-search"></i></button>
                                </div>
                              </div>
                        </li>
                        <li><a class="nav-link" href="keranjang.html"><i class="la la-shopping-cart" style="font-size:30px;"></i></a></li>
                        <li class="nav-item d-flex align-items-center"> <a href="login.php" class="btn btn-md btn-primary">LOGIN</a> </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <section class="main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body mb-2">
                            <ul class="nav nav-pills justify-content-between mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link active" id="pills-daftar-tab" data-toggle="pill" href="#pills-daftar" role="tab" aria-controls="pills-daftar" aria-selected="true">Pelanggan Baru</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="pills-login-tab" data-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="false">Pelanggan Lama</a>
                                </li>
                            </ul>
                            <hr>
                              <div class="tab-content text-center m-3" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-daftar" role="tabpanel" aria-labelledby="pills-daftar-tab">
                                    <div class="container">
                                        <h2>Buat akun</h2>
                                        <form action="" method="post" class="text-left">
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input type="email" name="email" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Username</label>
                                                <input type="text" name="username" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Password</label>
                                                <input type="password" name="password" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Nama Lengkap</label>
                                                <input type="text" name="nama" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Alamat</label>
                                                <textarea type="text" name="alamat" class="form-control" row="4" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Kode Pos</label>
                                                <input type="text" name="kodepos" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">No telepon</label>
                                                <input type="text" name="telepon" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <button name="daftar" class="btn btn-primary w-100">DAFTAR</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
                                    <div class="container">
                                        <h2>Login</h2>
                                        <form action="" method="post" class="text-left">
                                            <div class="form-group">
                                                <label for="">Username</label>
                                                <input type="text" name="username" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Password</label>
                                                <input type="password" name="password" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <button name="login" class="btn btn-primary w-100">LOGIN</button>
                                            </div>
                                        </form>
                                    </div>
                                    <footer class="section-footer bg-footer mt-4 fixed-bottom">
                                        <section class="footer py-1">
                                            <div class="container">                
                                            <div>
                                                <div class="text-center pt-1">&copy; COPYRIGHT 2020 Maripakai.co</div>
                                            </div>
                                                
                                        </section>
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <footer class="section-footer bg-footer mt-4">
        <section class="footer py-1">
            <div class="container">                
            <div>
                <div class="text-center pt-1">&copy; COPYRIGHT 2020 Maripakai.co</div>
            </div>
                
        </section>
    </footer> -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./assets/js/script.js"></script>
</body>
</html>
<?php } ?>