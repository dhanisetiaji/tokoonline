<?php 
session_start();
include('./include/koneksi.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
	{	
header('location:index.php');
}
else{
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
              <h4 class="text-center mt-5">Order Sukses!!</h4>
              <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body mb-2">
                            <p>Order anda berhasil kami terima. Silahkan transfer sesuai total pembayaran ke rekening <b>44-22-3321-2 BCA an AGUS ABIDIN</b>. Status pembayaran akan di update setelah melakukan pembayaran maksimal 1x24jam. Cek <a href="dashboard.php">dashboard</a> dan pilih menu transaksi untuk mengecek status pembayaran!</p>
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