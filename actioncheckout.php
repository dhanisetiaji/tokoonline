<?php 
session_start();
error_reporting(0);
include('./include/koneksi.php');

$act=$_GET['act'];
if ($act=='selesai'){
    $id_customer=$_POST['id_customer'];
    $alamat_lengkap=$_POST['alamat_lengkap'];
    $totalbayar=$_POST['totalbayar'];
    $sid=$_SESSION['login'];

    #VALIDASI UNTUK FORM JIKA FORM KOSONG  
    if (trim($id_customer)==""){
        header('Location:./keranjang.php');
    }
        #SIMPAN DATA KE DALAM DATABASE jika tidak menemukan error
        $qtransaksi = "INSERT INTO transaksi(id_customer,alamat_lengkap,totalbayar) VALUES(:id_customer,:alamat_lengkap,:totalbayar)";
        $transaksi = $dbh -> prepare($qtransaksi);
        $transaksi->bindParam(':id_customer',$id_customer);
        $transaksi->bindParam(':alamat_lengkap',$alamat_lengkap);
        $transaksi->bindParam(':totalbayar',$totalbayar);
        $username=$_SESSION['login'];
        $transaksi->execute();
        $lastInsertId = $dbh->lastInsertId();
        if($lastInsertId){
            $qcart= "SELECT * FROM cart_tmp WHERE username=:username";
            $cart= $dbh->prepare($qcart);
            $cart->bindParam(':username',$username);
            $cart->execute();
            $getall = $cart->fetchAll(PDO::FETCH_OBJ);
            // var_dump($getall);
            // for($i=0;$i<$cart->rowCount();$)
            if($cart->rowCount() > 0){
                foreach($getall as $res){
                    var_dump($res->nama_produk);
                    $nama_prod = $res->nama_produk;
                    $qty = $res->qty;
                    $harga = $res->harga;
                    $total=$harga*$qty;
                    $qsold = "INSERT INTO product_sold(id_customer,nama_produk,qty,harga,total) VALUES(:id_customer,:nama_prod,:qty,:harga,:total)";
                    $sold = $dbh->prepare($qsold);
                    $sold->bindParam(':id_customer',$id_customer,PDO::PARAM_STR);
                    $sold->bindParam(':nama_prod',$nama_prod,PDO::PARAM_STR);
                    $sold->bindParam(':qty',$qty,PDO::PARAM_STR);
                    $sold->bindParam(':harga',$harga,PDO::PARAM_STR);
                    $sold->bindParam(':total',$total,PDO::PARAM_STR);
                    $sold->execute();
                    $cek = $dbh->lastInsertId();
                    //delete cart_tmp
                    if($cek){
                        $id_cart = $res->id_cart_tmp;
                        $qdel = "DELETE FROM cart_tmp  WHERE id_cart_tmp=:id_cart";
                        $del = $dbh->prepare($qdel);
                        $del -> bindParam(':id_cart',$id_cart, PDO::PARAM_STR);
                        $del -> execute();
                    }
                }
            }
            header('Location:./selesai.php');
        }

}
?>