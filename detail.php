<?php
error_reporting(0);
include('./include/koneksi.php');
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
                        <li><a class="nav-link" href="keranjang.php"><i class="la la-shopping-cart" style="font-size:30px;"></i></a></li>
                        <li class="nav-item d-flex align-items-center"> <a href="login.php" class="btn btn-md btn-primary">LOGIN</a> </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <section class="main">
        <div class="container">
                <?php 
                    $id=intval($_GET['id']);
                    $sql ="SELECT product.*,kategori.Namakategori,kategori.id as bid from product join kategori on kategori.id=product.id_kategori where product.id=:id";
                    $query = $dbh -> prepare($sql);
                    $query-> bindParam(':id', $id, PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0){
                        foreach($results as $res)
                    {	
                ?>
            <h4 class="mt-3 mb-3">Detail Produk</h4>
            <div class="row mb-3">
                <div class="col-md-7">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img src="./admin/img/<?php echo htmlentities($res->gambar_produk);?>" class="mx-auto d-block w-50" alt="">
                          </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>
                </div>
                <div class="col-md-5">
                    <div class="card border-0">
                        <div class="card-body">
                        <form method="POST" action="keranjang.php">
                            <input type="text" name="id_produk" value="<?= $res->id; ?>"/>
                            <input type="text" name="nama_produk" value="<?= $res->nama_produk; ?>"/>
                            <input type="text" name="harga" value="<?= $res->harga_produk; ?>"/>
                            <h3><?php echo htmlentities($res->nama_produk);?></h3>
                              <hr>
                              <p>Stok : <?php echo htmlentities($res->stok_produk);?></p>
                              <p>Quantity :</p>
                              <select name="qty" class="custom-select w-50" required>
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                              </select>
                              
                              <hr>
                              <a href="keranjang.php">
                              <button class="btn btn-primary w-100" type="submit" name="submit">Add to Cart</button></a>
                        </form>
                              <hr>
                              <p style="font-size: 10px;">Put a bird on it..your chest that is.Supersoft tri-band shirt that feels like the tee you've had since high school, but with a bird on it</p>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Detail Produk</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Komentar</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Ulasan</a>
                </li>
            </ul>
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="container">
                        <p class="text-justify"><?php echo htmlentities($res->deskripsi_produk);?></p>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="container">
                        <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum numquam nobis vitae omnis repellendus veniam nulla quis optio, fuga et! Explicabo earum alias voluptate beatae tempora accusantium, mollitia dignissimos pariatur. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eum quidem distinctio temporibus nostrum qui et beatae pariatur ratione odio molestias. Magni perferendis consectetur debitis necessitatibus sint fuga veniam sapiente omnis.</p>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div class="container">
                        <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum numquam nobis vitae omnis repellendus veniam nulla quis optio, fuga et! Explicabo earum alias voluptate beatae tempora accusantium, mollitia dignissimos pariatur. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eum quidem distinctio temporibus nostrum qui et beatae pariatur ratione odio molestias. Magni perferendis consectetur debitis necessitatibus sint fuga veniam sapiente omnis.</p>
                    </div>
                </div>
              </div>
              <h4 class="mt-5">You might also like these!</h4>
                <div class="row justify-content-center">
                     <?php
                        function rupiah($angka){
            
                            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
                            return $hasil_rupiah;
                        
                        }
                        $id_kat=$res->id_kategori;
                        $sql ="SELECT product.*,kategori.Namakategori,kategori.id as bid from product join kategori on kategori.id=product.id_kategori where product.id_kategori=:id_kat";
                        $query = $dbh -> prepare($sql);
                        $query-> bindParam(':id_kat', $id_kat, PDO::PARAM_STR);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        if($query->rowCount() > 0){
                            foreach($results as $kat)
                        {
                    ?>
                  <div class="col-md-3">
                    <div class="card border-0">
                        <div class="product-card-image rounded">
                            <a href="single-page.html">
                                <img src="./admin/img/<?php echo htmlentities($kat->gambar_produk);?>" alt="product" class="mx-auto d-block rounded" height="300px">
                            </a>
                        </div>
                        <div class="card-body px-0 pt-0">
                            <div class="d-flex justify-content-center align-items-start mt-2">
                                <div class="product-title">
                                    <h6 class="text-bold"><?php echo htmlentities($kat->nama_produk);?></h6>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="product-dec">
                                    <span><?php echo htmlentities($kat->Namakategori);?></span>
                                </div>
                                <div class="product-price">
                                    <span><?php echo rupiah($kat->harga_produk);?></span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <a type="button" href="<?php echo htmlentities($kat->id);?>" class="btn btn-primary w-100">BUY!</a>
                            </div>
                        </div>
                    </div>
                  </div>
                  <?php } }?>
                </div>
                <?php  } } ?>
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
                
        </section>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./assets/js/script.js"></script>
</body>
</html>