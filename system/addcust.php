<?php
include("koneksi.php")
?>

<?php
  $id = $_POST['id_cust'];
  $kd = $_POST['kd_cust'];
	$nm = $_POST['nm_cust'];
	$no = $_POST['nohp'];
  $alm = $_POST['alamat'];					
             $qinput = "
                        INSERT INTO customer
                        (kd_customer, nama, alamat, nohp)
                        VALUES
                        ('$kd', '$nm', '$alm', '$no')
                        ";

        $cek = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM customer WHERE id_customer = '$id'"));       
        if ($cek > 0) {
          echo "<script> alert('Kode Sudah Ada');
              document.location='../pages/cust.php';
              </script>";
          } else {
          mysqli_query($mysqli,$qinput);
          echo "<script> alert('Data Tersimpan');
              document.location='../pages/cust.php';
              </script>";
          exit();
         }
?>