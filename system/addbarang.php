<?php
include("koneksi.php")
?>

<?php
  $id_brg = $_POST['id_barang'];
  $kd_brg = $_POST['kd_barang'];
	$supp = $_POST['supplier'];
	$stk = $_POST['stok'];
  $jns = $_POST['jenis'];
	$nm = $_POST['nama_brg'];
  $kd_sku = $_POST['kode_SKU'];
  $hrg = $_POST['harga'];	
  $desk = $_POST['deskripsi'];				
             $qinput = "
                        INSERT INTO product
                        (kd_barang, nama_brg, supplier, kode_SKU, stok, harga, jenis, desk)
                        VALUES
                        ('$kd_brg', '$nm', '$supp', '$kd_sku',  '$stk', '$hrg','$jns', '$desk')
                        ";

        $cek = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM product WHERE id_barang = '$id_brg'"));
        
        if ($cek > 0) {
          echo "<script> alert('Kode Sudah Ada');
              document.location='../pages/Mproduct.php';
              </script>";
          } else {
          mysqli_query($mysqli,$qinput);
          echo "<script> alert('Data Tersimpan');
              document.location='../pages/Mproduct.php';
              </script>";
          exit();
         }
?>