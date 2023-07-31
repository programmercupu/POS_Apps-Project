<?php
include("koneksi.php")
?>

<?php
  $id = $_POST['id_supplier'];
  $kd = $_POST['kd_supplier'];
	$nm = $_POST['nm_supp'];
	$no = $_POST['nohp'];
  $em = $_POST['email'];
	$trans = $_POST['trans'];
  $web = $_POST['web'];
  $alm = $_POST['alamat'];	
  $ket = $_POST['keterangan'];				
             $qinput = "
                        INSERT INTO supplier
                        (kd_supplier, nm_supp, alamat, nohp, email, website, transaksi, keterangan)
                        VALUES
                        ('$kd', '$nm', '$alm', '$no',  '$em', '$web','$trans', '$ket')
                        ";

        $cek = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM supplier WHERE id_supplier = '$id'"));       
        if ($cek > 0) {
          echo "<script> alert('Kode Sudah Ada');
              document.location='../pages/supplier.php';
              </script>";
          } else {
          mysqli_query($mysqli,$qinput);
          echo "<script> alert('Data Tersimpan');
              document.location='../pages/supplier.php';
              </script>";
          exit();
         }
?>