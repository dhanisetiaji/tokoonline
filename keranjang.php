
<?php 
// session_unset('cart_item');
// die();
// session_destroy();die();
session_start();
echo "<pre>";
var_dump($_SESSION['cart_item']);
echo "</pre>";
error_reporting(0);
include('./include/koneksi.php');
if(strlen($_SESSION['login'])==0){	
    header('location:login.php');
    }
else{
    if (!empty($_POST['qty'])) {
    
        $id_produk = $_POST['id_produk'];
        $nama_produk = $_POST['nama_produk'];
        $qty = $_POST['qty'];
        $harga = $_POST['harga'];
        
        $itemArray = array(
                        $id_produk=>array(
                                'nama_produk'=>$nama_produk, 
                                'qty'=>$qty, 
                                'harga'=>$harga
                            )
                    );
            
            if(!empty($_SESSION["cart_item"])) {
                // echo "asdasdasd";
                if(in_array($id_produk,array_keys($_SESSION["cart_item"]))) {
                    foreach($_SESSION["cart_item"] as $k => $v) {
                            if($id_produk == $k) {
                                if(empty($_SESSION["cart_item"][$k]["qty"])) {
                                    $_SESSION["cart_item"][$k]["qty"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["qty"] += $_POST["qty"];
                            }
                    }
                } else {
                    $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                }
            } else {
                // echo "2";
                $_SESSION["cart_item"] = $itemArray;
            }
            // echo "hake";
            // print_r($itemArray);
            

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
    <?php include('include/header.php');?>
    <section class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h4 class="font-bold">Checkout</h4>
                    <div class="p-0 m-1">
                        <p>Alamat pengirim</p>
                        <hr>
                        <p>Resa harahap</p>
                        <p>081212322</p>
                        <p style="color: gray;">Alamat: Lorem ipsum dolor sit amet.</p>
                        </div>
                    <hr>
                    <?php
                        function rupiah($angka){
        
                            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
                            return $hasil_rupiah;
                        
                        }
                        $totalbayar;
                        if (!empty($_SESSION["cart_item"])) { 
                            foreach($_SESSION["cart_item"] as $value){
                            $total=$value['qty']*$value['harga'];
                            $totalbayar+=$total;
                    ?>
                    <div class="row">
                        <div class="col-md">
                            <img src="./assets/img/produk1.jpg" alt="" class="mx-auto w-50 rounded">
                        </div>
                        <div class="col-md">
                            <label for="">Nama Barang</label>
                            <p style="color: gray;font-size: 18px;"><?php echo $value['nama_produk'];?></p>
                        </div>
                        <div class="col-md">
                            <label for="">Jumlah</label>
                            <p style="color: gray;font-size: 18px;"><?php echo $value['qty'];?></p>
                        </div>
                        <div class="col-md" id="harga">
                            <label for="">Harga</label>
                            <p style="color: gray;font-size: 18px;"><?php echo rupiah($total);?></p>
                        </div>
                    </div>
                    <?php }} ?>
                    <hr>
                    <div class="text-right">
                        <p>Subtotal : <?php echo rupiah($totalbayar);?>
                        </p>
                    </div>
                    <hr>
                </div>
                <div class="col-md-4">
                    <div class="card border-0">
                        <div class="card-body">
                            <h4 class="text-center">RINGKASAN ORDER</h4>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <p>Total Harga</p>
                                <p><?php echo rupiah($totalbayar);?></p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p>Total Ongkos Kirim</p>
                                <p>Rp.22.000</p>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <p>Total Pembayaran</p>
                                <p><?php echo rupiah($totalbayar);?></p>
                            </div>
                            <a href="Metode Pembayaran.html"><button class="btn btn-primary w-100 font-weight-bolder">BELI</button></a>
                            <div class="input-group m-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary" type="button" id="button-addon1"><i class="las la-gift"></i></button>
                                </div>
                                <input type="text" class="form-control" placeholder="voucher" aria-label="voucher" aria-describedby="basic-addon1">
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