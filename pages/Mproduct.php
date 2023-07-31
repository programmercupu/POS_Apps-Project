<script>
    <?php
    session_start();
    if (isset($_SESSION['pesan'])) {
        echo 'alert("' . $_SESSION['pesan'] . '")';
        unset($_SESSION['pesan']);
    }
    ?>
</script>
<!DOCTYPE html>
<?php
include("../system/koneksi.php")
?>
<html lang="en">
<head>
  <?php include("header.php"); ?>
</head>
<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-gradient-secondary position-absolute w-100"></div>
  <?php include("sidebar.php"); ?>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Management Product</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Management Product</h6>
        </nav>
        <?php include("navbar.php"); ?>
      </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between">
              <h6>Main Product List</h6>
              <button class="badge badge-sm bg-gradient-success" id="tambah_data" data-toggle="modal" data-target="#ModalAdd">Add +</button>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kode SKU</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Supplier</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Stok</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Harga/pcs</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Desc</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Option</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $limit = 5; // Jumlah baris yang ingin ditampilkan per halaman
                    $page = isset($_GET['page']) ? $_GET['page'] : 1; // Mengambil nomor halaman dari parameter URL
                    $start = ($page - 1) * $limit; // Menghitung baris awal yang akan ditampilkan
                    $hasill =" SELECT * FROM product ORDER BY nama_brg ASC LIMIT $start, $limit";			
                    $hasil = mysqli_query($mysqli, $hasill);
                    while ($r = mysqli_fetch_array($hasil)) {
                    ?>
                    <tr>
                      <td>
                        <div class="d-flex px-3 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo $r['nama_brg']; ?></h6>
                            <p class="text-xs text-secondary mb-0"><?php echo $r['kd_barang']; ?></p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $r['kode_SKU']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $r['supplier']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $r['stok']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Rp.<?php echo $r['harga']; ?></p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-info"><?php echo $r['jenis']; ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">
                        <?php
                              $deskripsi = $r['desk'];
                              $potonganDeskripsi = substr($deskripsi, 0, 15) . '...';

                              echo $potonganDeskripsi;
                              ?>
                        </span>
                      </td>
                      <td class="align-middle text-center">
                      <?php
                      echo "<a href='../system/Editbrg.php?id_brg=$r[kd_barang]' class='text-secondary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Edit user'>
                          Upd
                        </a>"?>
                         /
                         <?php
                      echo "<a onclick='return konfirmasi()' href='../system/Deletebrg.php?id_brg=$r[kd_barang]' class='text-secondary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Edit user'>
                          Del
                        </a>"?>
                      </td>
                    </tr>
                    <?php } ?> 
                  </tbody>
                </table>
                <ul class="pagination justify-content-center" > 
                    <?php
                    $result = mysqli_query($mysqli, "SELECT COUNT(*) AS total FROM product");
                    $row = mysqli_fetch_assoc($result);
                    $totalPages = ceil($row['total'] / $limit); // Menghitung total halaman

                    for ($i = 1; $i <= $totalPages; $i++) {
                      $active = ($i == $page) ? 'active' : '';
                      echo "<li class='page-item $active'><a class='bg-gradient-dark page-link' href='Mproduct.php?page=$i'>$i</a></li>";
                    }
                    ?>
                  </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include("subMproduct.php"); ?>
      <footer class="footer pt-3  ">
          <?php include("footer.php"); ?>
      </footer>
    </div>
  </main>

  <!-- Modal -->
  <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="ModalAddLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalAddLabel">Tambah Barang Baru</h5>
      </div>
      <div class="modal-body">  
        <form method="post" action="../system/addbarang.php">
        <?php   
                $qupdate = "SELECT max(id_barang) as maxKode FROM product";
                $rupdate = mysqli_query($mysqli, $qupdate);
                $dupdate = mysqli_fetch_assoc($rupdate);
                $id_brg = $dupdate['maxKode'];
                $no_urut = $id_brg + 1;
                $char = "B";
                $stok = "0";
                $newID = $char.sprintf("%01s",$no_urut);
              ?>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group" hidden>
                <label for="id_barang">ID Barang</label>
                <input type="text"  class="form-control" id="id_barang" name="id_barang" value="<?php echo "$no_urut"; ?>">
              </div>
              <div class="form-group">
                <label for="id_barang">Kode Barang</label>
                <input type="text"  class="form-control" readonly id="kd_barang" name="kd_barang" value="<?php echo "$newID"; ?>">
              </div>
              <div class="form-group">
                <label for="stok">Supplier</label>
                  <select class="form-control" id="supplier" name="supplier">
                    <option value="">Pilih Supplier</option>
                    <?php
                      // Query untuk mendapatkan nama supplier dari tabel supplier
                      $query = "SELECT nm_supp FROM supplier";

                      // Eksekusi query
                      $result = mysqli_query($mysqli, $query);

                      // Periksa apakah query berhasil
                      if ($result) {
                        // Tampilkan setiap nama supplier sebagai opsi dalam elemen select
                        while ($row = mysqli_fetch_assoc($result)) {
                          echo '<option value="' . $row['nm_supp'] . '">' . $row['nm_supp'] . '</option>';
                        }
                      }
                    ?>
                  </select>
                </div>
              <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" placeholder="Automatic By System" class="form-control" id="stok" name="stok" values="<?php echo "$stok"; ?>" readonly>
              </div>
              <div class="form-group">
                <label for="Jenis">Jenis</label>
                <select class="form-control" id="jenis" name="jenis" required>
                  <option value="" disabled selected>Pilih Jenis Makanan</option>
                  <option value="Bahan Pokok">Bahan Pokok</option>
                  <option value="Makanan Ringan">Makanan Ringan</option>
                  <option value="Makanan Instan">Makanan Instan</option>
                  <option value="Minuman Sachet">Minuman Sachet</option>
                  <option value="Minuman Kaleng">Minuman Kaleng</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="nama_brg">Nama Barang</label>
                <input type="text" class="form-control" id="nama_brg" name="nama_brg">
              </div>
              <div class="form-group">
                <label for="kode_SKU">Kode SKU</label>
                <input type="text" class="form-control" id="kode_SKU" name="kode_SKU">
              </div>
              <div class="form-group">
                <label for="harga">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga">
              </div>
              <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" values="Save" class="btn btn-dark">Simpan</button>
              </div>
            </div>
          </div>
        </form>
      </div>   
    </div>


  
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
  <script>
  $(document).ready(function() {
    $('#tambah_data').click(function() {
      $('#ModalAdd').modal('show');
    });
  });
  </script>
</body>

</html>
<script type="text/javascript" language="JavaScript">
    function konfirmasi()
        {
          tanya = confirm("Anda Yakin Akan Menghapus Data Ini ?");
          if (tanya == true) return true;
          else return false;
        }
</script>