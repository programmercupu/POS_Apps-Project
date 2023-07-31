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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Management Supplier</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Update Supplier</h6>
        </nav>
        <?php include("../pages/navbar.php"); ?>
      </div>
    </nav>
    <!-- End Navbar -->
    <?php
    $kd_brg=$_GET['id_brg'];
    $result= mysqli_query($mysqli, "SELECT * from supplier where kd_supplier='$kd_brg'");

    while($ro = mysqli_fetch_array($result))
    {
      $id_brg = $ro['id_supplier'];
      $kd_brg = $ro['kd_supplier'];
      $supp = $ro['nm_supp'];
      $stk = $ro['alamat'];
      $jns = $ro['nohp'];
      $nm = $ro['email'];
      $kd_sku = $ro['website'];
      $hrg = $ro['transaksi'];	
      $desk = $ro['keterangan'];	
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
                    <form action="proseseditsupp.php" method="post" enctype="multipart/form-data">
                      <div class="form-group" hidden>
                        <label for="id_barang">ID Supplier</label>
                        <input type="text"  class="form-control" id="id_supplier" name="id_supplier" value="<?php echo "$id_brg"; ?>">
                      </div>
                      <div class="form-group">
                        <label for="id_barang">Kode Supplier</label>
                        <input type="text"  class="form-control" readonly id="kd_supplier" name="kd_supplier" value="<?php echo "$kd_brg"; ?>">
                      </div>
                      <div class="form-group">
                        <label for="supplier">Nama Supplier</label>
                        <input type="text"  class="form-control" id="nm_supp" name="nm_supp" value="<?php echo "$supp"; ?>">
                      </div>
                      <div class="form-group">
                        <label for="stok">No Hp</label>
                        <input type="number" class="form-control" id="nohp" name="nohp" value="<?php echo "$jns"; ?>">
                      </div>
                      <div class="form-group">
                        <label for="jenis">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo "$nm"; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nama_brg">Transaksi</label>
                        <input type="text" readonly class="form-control" id="trans" name="trans" value="<?php echo "$hrg"; ?>">
                      </div>
                      <div class="form-group">
                        <label for="nama_brg">Website</label>
                        <input type="text" class="form-control" id="web" name="web" value="<?php echo "$kd_sku"; ?>">
                      </div>
                      <div class="form-group">
                        <label for="kode_SKU">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat"><?php echo "$stk"; ?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="deskripsi">Keterangan Lanjut</label>
                        <textarea class="form-control" id="keterangan" name="keterangan"><?php echo "$desk"; ?></textarea>
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