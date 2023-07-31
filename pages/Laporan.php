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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Laporan</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Generate Report</h6>
        </nav>
        <?php include("../pages/navbar.php"); ?>
      </div>
    </nav>
    <!-- End Navbar --> 
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between">
              <h6>Pilih Report</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                    <form action="" method="" target="_blank">
                      <div class="form-group">
                        <label for="kode_SKU">Pembelian</label>
                        <button onclick="openInNewTab('../system/lappembelian.php')"  class="form-control bg-gradient-success">Cetak Semua Laporan</button>
                        <script>
                          function openInNewTab(url) {
                            var win = window.open(url, '_blank');
                            win.focus();
                          }
                        </script>
                      </div>  
                      <div class="form-group">
                        <label for="kode_SKU">Pembelian</label>
                        <button onclick="openInNewTab3('../system/lappembelianbrg.php')"  class="form-control bg-gradient-success">Cetak Laporan Pembelian Barang</button>
                        <script>
                          function openInNewTab3(url) {
                            var win = window.open(url, '_blank');
                            win.focus();
                          }
                        </script>
                      </div>   
                    </div>
                    <div class="col-md-6"> 
                      <div class="form-group">
                        <label for="kode_SKU">Penjualan</label>
                        <button onclick="openInNewTab2('../system/lappenjualan.php')"  class="form-control bg-gradient-success">Cetak Semua Laporan</button>
                        <script>
                          function openInNewTab2(url) {
                            var win = window.open(url, '_blank');
                            win.focus();
                          }
                        </script>
                      </div>
                      <div class="form-group">
                        <label for="kode_SKU">Penjualan</label>
                        <button onclick="openInNewTab4('../system/lappenjualanbrg.php')"  class="form-control bg-gradient-success">Cetak Laporan Penjualan Barang</button>
                        <script>
                          function openInNewTab4(url) {
                            var win = window.open(url, '_blank');
                            win.focus();
                          }
                        </script>
                      </div>
                    </div>    
                  </div>
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