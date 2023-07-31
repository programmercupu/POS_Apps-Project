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
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
  @media (min-width: 768px) {
    .modal-dialog.modal-lg {
      margin-left: 300px; /* Sesuaikan dengan jarak yang diinginkan */
      
    }
  }
</style>

<style>
    /* Kustomisasi tampilan Select2 */
    .select2-container--default .select2-selection--single {
      height: 38px;
      width: 350px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
      line-height: 28px;
      
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: 28px;
    }
  </style>
<?php include("header.php"); ?>
</head>
<body class="g-sidenav-show   bg-gray-100">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

  <div class="min-height-300 bg-gradient-secondary position-absolute w-100"></div>
  <?php include("sidebar.php"); ?>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Buy & Sell</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Transaction Center</h6>
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
              <h6>History Buy Transaction</h6>
              <button class="badge badge-sm bg-gradient-success" id="tambah_data" data-toggle="modal" data-target="#ModalAdd">Buy Something's</button>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nota Trx</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pembeli</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal & Jam</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Discount</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Pembelian</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pembayaran</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $limit = 5; // Jumlah baris yang ingin ditampilkan per halaman
                    $page = isset($_GET['page']) ? $_GET['page'] : 1; // Mengambil nomor halaman dari parameter URL
                    $start = ($page - 1) * $limit; // Menghitung baris awal yang akan ditampilkan
                    $hasill =" SELECT * FROM transaction where jenis = 'buy' LIMIT $start, $limit";			
                    $hasil = mysqli_query($mysqli, $hasill);
                    while ($r = mysqli_fetch_array($hasil)) {
                    ?>
                    <tr>
                      <td>
                        <div class="d-flex px-3 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo $r['kd_trans']; ?></h6>
                            <p class="text-xs text-secondary mb-0"><?php echo $r['id_trans']; ?></p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $r['customer']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $r['tgl_trans']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Rp.<?php echo $r['diskon']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Rp.<?php echo $r['Total']; ?></p>
                      </td>
                      <td>
                         <p class="text-xs font-weight-bold mb-0"><?php echo $r['Pembayaran']; ?></p>
                      </td>
                      <td class="align-middle text-center">
                      <?php
                      echo "<span class='badge badge-sm bg-gradient-info'><a href='../system/Detailstrans.php?id_brg=$r[kd_trans]' class='text-white font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Edit user'>
                          Detail's
                        </a></span>"?>
                      </td>              
                    </tr>
                    <?php } ?> 
                  </tbody>
                </table>
                <ul class="pagination justify-content-center" > 
                    <?php
                    $result = mysqli_query($mysqli, "SELECT COUNT(*) AS total FROM transaction where jenis = 'buy'");
                    $row = mysqli_fetch_assoc($result);
                    $totalPages = ceil($row['total'] / $limit); // Menghitung total halaman

                    for ($i = 1; $i <= $totalPages; $i++) {
                      $active = ($i == $page) ? 'active' : '';
                      echo "<li class='page-item $active'><a class='bg-gradient-dark page-link' href='buysell.php?page=$i'>$i</a></li>";
                    }
                    ?>
                  </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include("subBuySell.php"); ?>
      <footer class="footer pt-3  ">
          <?php include("footer.php"); ?>
      </footer>
    </div>
  </main>

<div class="modal fade " id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="ModalAddLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content table-responsive p-3">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalAddLabel">Beli Stok Barang</h5>
      </div>
      <div class="modal-body ">  
        <form method="post" action="../system/buyprogress.php">
        <?php   
                $qupdate = "SELECT max(id_trans) as maxKode FROM transaction where jenis = 'Buy'";
                $rupdate = mysqli_query($mysqli, $qupdate);
                $dupdate = mysqli_fetch_assoc($rupdate);
                $id_trans = $dupdate['maxKode'];
                $no_urut = $id_trans + 1;
                $char = "TB0";
                $stok = "0";
                $newID = $char.sprintf("%01s",$no_urut);
              ?>
          <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label for="supplier">Kode Transaction</label>
                <input type="text" class="form-control" id="kd_trans" name="kd_trans" value="<?php echo "$newID" ?>" readonly>
              </div>
            <div class="form-group">
            <label for="product">Produk</label>
              <select class="form-control" id="product" name="product" onchange="updateFields()">
                <?php
                // Query untuk mendapatkan daftar produk beserta atribut-atributnya
                $query = "SELECT * FROM product order by nama_brg ASC";
                $result = mysqli_query($mysqli, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                  $id_barang = $row['id_barang'];
                  $kd_barang = $row['kd_barang'];
                  $nama_brg = $row['nama_brg'];
                  $supplier = $row['supplier'];
                  $stok = $row['stok'];
                  $harga = $row['harga'];
                  $jenis = $row['jenis'];
                  $deskripsi = $row['desk'];

                  echo "<option value='$id_barang' data-brg='$kd_barang' data-supplier='$supplier' data-stok='$stok' data-harga='$harga' data-jenis='$jenis' data-deskripsi='$deskripsi'>$nama_brg</option>";
                }
                ?>
              </select>
              <script>
                $(document).ready(function() {
                  $('#product').select2({
                    maximumSelectionLength: 4, // Batasan jumlah opsi yang dapat dipilih
                    placeholder: 'Pilih produk',
                     // Atur lebar kotak input Select2 sesuai kebutuhan
                    tags: true, // Izinkan penambahan teks manual
                    createTag: function(params) {
                      return {
                        id: params.term,
                        text: params.term,
                        newOption: true
                      };
                    },
                    templateResult: function(data) {
                      var $result = $("<span></span>");

                      if (data.newOption) {
                        $result.text("Tambah: " + data.text);
                      } else {
                        $result.text(data.text);
                      }

                      return $result;
                    }
                  });
                });
              </script>

              </div>
              <div class="form-group">
                <label for="supplier">Supplier</label>
                <input type="text" class="form-control" id="supplier" name="supplier" readonly>
              </div>
              <div class="form-group">
                <label for="stok">Jumlah Beli</label>
                <input type="number" class="form-control" id="stok" name="stok" require>
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-dark" onclick="addItem()">Add</button>
              </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label for="harga">kode Barang</label>
                <input type="text" class="form-control" id="kd_brg" name="kd_brg" readonly>
              </div>
              <div class="form-group">
                <label for="harga">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga" readonly>
              </div>
              <div class="form-group">
                <label for="jenis">Jenis</label>
                <input type="text" class="form-control" id="jenis" name="jenis" readonly>
              </div>
              <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" readonly></textarea>
              </div>
            </div>
            
          </div>
          <div class="modal-footer">
            <button type="submit" value="Save" class="btn btn-dark">Simpan</button>
          </div>
          <input type="hidden" name="temporaryData" id="temporaryData">
        <table id="addedItemsTable" class="table align-items-center mb-4">
          <thead>
            <tr>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Barang</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Supplier</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah Beli</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Option</th>
            </tr>
            <tfoot>
              <tr>
                <td colspan="4" class="font-weight-bold">Discount :</td>
                <td id="discount" class="font-weight-bold"></td>
                <td></td>
              </tr>
              <tr>
                <td colspan="4" class="font-weight-bold">Total Belanja :</td>
                <td id="totalb" class="font-weight-bold"></td>
                <td></td>
              </tr>
              <tr>
                <td colspan="4" class="font-weight-bold">Grand Total :</td>
                <td id="grandTotalValue" class="font-weight-bold"></td>
                <td></td>
              </tr>
            </tfoot>
          </thead>
          <tbody id="addedItemsBody">
          </tbody>
        </table>
        </form>
      </div>   
    </div>
  </div>
</div>

<script>
function updateFields() {
  var productSelect = document.getElementById("product");
  var selectedOption = productSelect.options[productSelect.selectedIndex];

  var kd = selectedOption.getAttribute("data-brg");
  var supplier = selectedOption.getAttribute("data-supplier");
  var stok = selectedOption.getAttribute("data-stok");
  var harga = selectedOption.getAttribute("data-harga");
  var jenis = selectedOption.getAttribute("data-jenis");
  var deskripsi = selectedOption.getAttribute("data-deskripsi");

  document.getElementById("kd_brg").value = kd;
  document.getElementById("supplier").value = supplier;
  document.getElementById("harga").value = harga;
  document.getElementById("jenis").value = jenis;
  document.getElementById("deskripsi").value = deskripsi;
}

function addItem() {
    var product = $("#product option:selected").text();
    var kd_barang = $("#kd_brg").val();
    var harga = $("#harga").val();
    var supp = $("#supplier").val();
    var stok = $("#stok").val();
    var option = "Del";

    // Memotong karakter nama produk menjadi maksimum 10 karakter
    

    // Membuat baris baru dalam tabel dengan data barang yang dipilih
    var newRow = "<tr>" +
    "<td hidden>" +
      "<div class='d-flex px-3 py-2'>" +
        "<div class='d-flex flex-column justify-content-center'>" +
          kd_barang +
        "</div>" +
      "</div>" +
    "</td>" +
    "<td>" +
      "<div class='d-flex px-3 py-2'>" +
        "<div class='d-flex flex-column justify-content-center' >" +
          product +
        "</div>" +
      "</div>" +
    "</td>" +
    "<td>" +
      "<div class='d-flex px-3 py-2'>" +
        "<div class='d-flex flex-column justify-content-center' >" +
          harga +
        "</div>" +
      "</div>" +
    "</td>" +
    "<td>" +
      "<div class='d-flex px-3 py-2'>" +
        "<div class='d-flex flex-column justify-content-center' >" +
          supp +
        "</div>" +
      "</div>" +
    "</td>" +
    "<td>" +
      "<div class='d-flex px-3 py-2'>" +
        "<div class='d-flex flex-column justify-content-center' >" +
          stok +
        "</div>" +
      "</div>" +
    "</td>" +
    "<td>" +
      "<div class='d-flex px-3 py-2'>" +
        "<div class='d-flex flex-column justify-content-center'>" +
          option +
        "</div>" +
      "</div>" +
    "</td>" +
  "</tr>";

    $("#addedItemsBody").append(newRow);
    var temporaryData = $("#addedItemsTable").html();
    $("#temporaryData").val(temporaryData);

    var grandTotal = 0;
    var discount = 0;
    $("#addedItemsBody tr").each(function() {
      var harga = parseFloat($(this).find("td:eq(2)").text());
      var jumlahBeli = parseFloat($(this).find("td:eq(4)").text());
      var subtotal = harga * jumlahBeli;
      grandTotal += subtotal;
    });
    discount = grandTotal * 0.1;
    $("#discount").text("Rp."+discount);
    $("#totalb").text("Rp."+grandTotal);
    $("#grandTotalValue").text("Rp."+(grandTotal - discount));

}
</script>
  
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
  <script>
  $(document).ready(function() {
    $('#selldata').click(function() {
      $('#ModalSell').modal('show');
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