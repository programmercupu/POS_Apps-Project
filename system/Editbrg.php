<!DOCTYPE html>
<?php
include("../system/koneksi.php")
?>
<html lang="en">
<head>
  <?php include("../pages/header.php"); ?>
</head>
<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-gradient-secondary position-absolute w-100"></div>
  <?php include("../pages/sidebar.php"); ?>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Management Product</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Update Product</h6>
        </nav>
        <?php include("../pages/navbar.php"); ?>
      </div>
    </nav>
    <!-- End Navbar -->
    <?php
    $kd_brg=$_GET['id_brg'];
    $result= mysqli_query($mysqli, "SELECT * from product where kd_barang='$kd_brg'");

    while($ro = mysqli_fetch_array($result))
    {
      $id_brg = $ro['id_barang'];
      $kd_brg = $ro['kd_barang'];
      $supp = $ro['supplier'];
      $stk = $ro['stok'];
      $jns = $ro['jenis'];
      $nm = $ro['nama_brg'];
      $kd_sku = $ro['kode_SKU'];
      $hrg = $ro['harga'];	
      $desk = $ro['desk'];	
    }
    ?>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between">
              <h6>Update Barang</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                    <form action="prosesedit.php" method="post" enctype="multipart/form-data">
                      <div class="form-group" hidden>
                        <label for="id_barang">ID Barang</label>
                        <input type="text"  class="form-control" id="id_barang" name="id_barang" value="<?php echo "$id_brg"; ?>">
                      </div>
                      <div class="form-group">
                        <label for="id_barang">Kode Barang</label>
                        <input type="text"  class="form-control" readonly id="kd_barang" name="kd_barang" value="<?php echo "$kd_brg"; ?>">
                      </div>
                      <div class="form-group">
                        <label for="supplier">Supplier</label>
                        <select class="form-control" id="supplier" name="supplier">
                        <option value="">Pilih Supplier</option>
                        <?php
                          // Query untuk mendapatkan nama supplier dari tabel supplier
                          $querys = "SELECT nm_supp FROM supplier";
                          // Eksekusi query
                          $results = mysqli_query($mysqli, $querys);

                          // Periksa apakah query berhasil
                          if ($results) {
                            // Tampilkan setiap nama supplier sebagai opsi dalam elemen select
                            while ($rows = mysqli_fetch_assoc($results)) {
                              $selected = ($rows['nm_supp'] == $supp) ? 'selected' : ''; // Menandai opsi yang terpilih
                              echo '<option value="' . htmlspecialchars($rows['nm_supp']) . '"' . $selected . '>' . htmlspecialchars($rows['nm_supp']) . '</option>';
                            }
                          }
                        ?>
                      </select> 
                      </div>
                      <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" readonly class="form-control" id="stok" name="stok" value="<?php echo "$stk"; ?>">
                      </div>
                      <div class="form-group">
                        <label for="jenis">Jenis</label>
                        <input type="text" class="form-control" id="jenis" name="jenis" value="<?php echo "$jns"; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nama_brg">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_brg" name="nama_brg" value="<?php echo "$nm"; ?>">
                      </div>
                      <div class="form-group">
                        <label for="kode_SKU">Kode SKU</label>
                        <input type="text" class="form-control" id="kode_SKU" name="kode_SKU" value="<?php echo "$kd_sku"; ?>">
                      </div>
                      <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga" value="<?php echo "$hrg"; ?>">
                      </div>
                      <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi"><?php echo "$desk"; ?></textarea>
                      </div>
                    </div>    
                  </div>
                  <button type="submit" name="btn" values="Upload" class="btn btn-dark">Simpan</button>  
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
      <footer class="footer pt-3  ">
          <?php include("../pages/footer.php"); ?>
      </footer>
    </div>
  </main>
 
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
  
</body>
</html>