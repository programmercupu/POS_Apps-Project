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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Buy & Sell</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Detail Transaction</h6>
        </nav>
        <?php include("../pages/navbar.php"); ?>
      </div>
    </nav>
    <!-- End Navbar -->
    <?php
    $kd_tr=$_GET['id_brg'];
    $result= mysqli_query($mysqli, "SELECT * from transaction where kd_trans='$kd_tr'");

    while($ro = mysqli_fetch_array($result))
    {
      $id_tr = $ro['id_trans'];
      $kd_tr = $ro['kd_trans'];
      $cust = $ro['customer'];
      $tgl = $ro['tgl_trans'];
      $jns = $ro['Jenis'];
      $dsk = $ro['diskon'];
      $total = $ro['Total'];
      $Pembayaran = $ro['Pembayaran'];
    }
    ?>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between">
              <h6>Detail Transaksi</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                    <form action="../system/create_invoice.php?id_brg=<?php echo $kd_tr; ?>" method="get" target="_blank">
                      <div class="form-group" hidden>
                        <label for="id_barang">ID Transaksi</label>
                        <input type="text"  class="form-control" id="trans" name="id_trans" value="<?php echo "$id_tr"; ?>">
                      </div>
                      <div class="form-group">
                        <label for="id_barang">Kode Transaksi</label>
                        <input type="text"  class="form-control" readonly id="kd_barang" name="kd_barang" value="<?php echo "$kd_tr"; ?>">
                      </div>
                      <div class="form-group">
                        <label for="id_barang">Customer</label>
                        <input type="text"  class="form-control" readonly id="cust" name="cust" value="<?php echo "$cust"; ?>">
                      </div>
                      <div class="form-group">
                        <label for="stok">Tanggal & Jam Transaksi</label>
                        <input type="text" readonly class="form-control" id="stok" name="stok" value="<?php echo "$tgl"; ?>">
                      </div>
                      <div class="form-group">
                        <label for="harga">Keterangan Pembayaran</label>
                        <input type="text" readonly class="form-control" id="harga" name="harga" value="<?php echo "$Pembayaran"; ?>">
                      </div>      
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nama_brg">Jenis Transaksi</label>
                        <input type="text" readonly class="form-control" id="nama_brg" name="nama_brg" value="<?php echo "$jns"; ?>">
                      </div>
                      <div class="form-group">
                        <label for="kode_SKU">Discount total</label>
                        <input type="text" readonly class="form-control" id="kode_SKU2" name="kode_SKU2" value="<?php echo "$dsk"; ?>">
                      </div>
                      <div class="form-group">
                        <label for="kode_SKU">Total Harga</label>
                        <input type="text" readonly class="form-control" id="kode_SKU" name="kode_SKU" value="<?php echo "$total"; ?>">
                      </div>
                      <div class="form-group">
                      <label for="kode_SKU">Option</label>
                      <button type="submit" name="submit" class="form-control bg-gradient-success">Cetak Invoice</button>
                      </div>
                    </div>    
                  </div>
              </div>
            </div>
            <?php include("detailsbarang.php"); ?>
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