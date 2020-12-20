<?php 
session_start();
error_reporting(0);
include('./include/koneksi.php');

$act=$_GET['act'];
if ($act=='tambah'){
    
      $id_produk=$_POST['id_produk'];
      $nama_produk=$_POST['nama_produk'];
      $gambar=$_POST['gambar'];
      $qty = $_POST['qty'];
      $harga = $_POST['harga'];
    // var_dump($_POST['id_produk']);

    #VALIDASI UNTUK FORM JIKA FORM KOSONG  
      if (trim($id_produk)=="") {
          ?> 
          <script language="JavaScript">alert('Anda Belum Memilih Product');</script><?php
          header('Location:./detail.php?id='.$id_produk);}
     
    #SIMPAN DATA KE DALAM DATABASE jika tidak menemukan error 
        $sid = $_SESSION['login'];
        $sql ="SELECT * from product where id=:id_produk";
        $query = $dbh -> prepare($sql);
        $query-> bindParam(':id_produk', $id_produk, PDO::PARAM_STR);
        $query->execute();
        $results=$query->fetch();
//       $sql2 = mysql_query("SELECT * FROM product where id='$id_produk'");
//       $r=mysql_fetch_array($sql2);
    // echo $results->stok_produk;
    // die();  
      $stok=$results['stok_produk'];
    //   var_dump($_SESSION['login']);
  if ($stok == 0){ ?>
          <script language="JavaScript">alert('Stok Habis');</script>
          <?php
          header('Location:./detail.php?id='.$id_produk);
      }
      else{
      // check if the product is already
      // in cart table for this session
          $sql1 = "SELECT * FROM cart_tmp WHERE id_produk=:id_produk AND username=:sid";
          $query1 = $dbh -> prepare($sql1);
          $query1-> bindParam(':id_produk', $id_produk, PDO::PARAM_STR);
          $query1-> bindParam(':sid', $sid, PDO::PARAM_STR);
          $query1->execute();
        //   $results1=$query1->fetch();
        // var_dump($query1->rowCount());
        // die();
          if ($query1->rowCount()==0){
          // put the product in cart table
          $queryadd = "INSERT INTO cart_tmp(id_produk,nama_produk,qty,gambar,harga,username) VALUES(:id_produk,:nama_produk,:qty,:gambar,:harga,:sid)";
          $add = $dbh->prepare($queryadd);
          $add->bindParam(':id_produk',$id_produk, PDO::PARAM_STR);
          $add->bindParam(':nama_produk',$nama_produk, PDO::PARAM_STR);
          $add->bindParam(':qty',$qty, PDO::PARAM_STR);
          $add->bindParam(':gambar',$gambar, PDO::PARAM_STR);
          $add->bindParam(':harga',$harga, PDO::PARAM_STR);
          $add->bindParam(':sid',$sid, PDO::PARAM_STR);
          $add->execute();
        //   $lastInsertId = $dbh->lastInsertId();
        //   var_dump($lastInsertId);
        //   var_dump($add->execute());
        //   die();
          } 
          else {
          // update product quantity in cart table
            //   $up=mysql_query("UPDATE cart_tmp 
            //       SET qty = qty + '$qty'
            //       WHERE username ='$sid' AND id_produk='$id_produk' ");
                $update=$dbh->prepare("UPDATE cart_tmp SET qty=qty+:qty where username=:sid AND id_produk=:id_produk");
                $update ->bindParam(':id_produk',$id_produk, PDO::PARAM_STR);
                $update ->bindParam(':qty',$qty, PDO::PARAM_STR);
                $update ->bindParam(':sid',$sid, PDO::PARAM_STR);
                $update -> execute();  
          }	
                ?> <script language="JavaScript">alert('Product Berhasil Ditambahkan Di Shoping Cart');</script>
          <?php
                  header('Location:./keranjang.php');
          
      }				
  
  }
//   #END TAMBAH
  ?>