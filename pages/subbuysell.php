<div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between">
              <h6>History Sell Transaction</h6>
              <button class="badge badge-sm bg-gradient-success" id="selldata" data-toggle="modal" data-target="#ModalSell">Sell Something's</button>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nota Trx</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pembeli</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal & Jam</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Pembelian</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pembayaran</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $limits = 5; // Jumlah baris yang ingin ditampilkan per halaman
                    $pages = isset($_GET['pages']) ? $_GET['pages'] : 1; // Mengambil nomor halaman dari parameter URL
                    $start = ($pages - 1) * $limits; // Menghitung baris awal yang akan ditampilkan
                    $hasill ="SELECT * FROM transaction where jenis = 'sell' LIMIT $start, $limits";			
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
                    $result = mysqli_query($mysqli, "SELECT COUNT(*) AS totals FROM transaction where jenis = 'sell'");
                    $row = mysqli_fetch_assoc($result);
                    $totalPagess = ceil($row['totals'] / $limits); // Menghitung total halaman
                      for ($i = 1; $i <= $totalPagess; $i++) {
                      $actives = ($i == $pages) ? 'active' : '';
                      echo "<li class='page-item $actives'><a class='bg-gradient-dark page-link' href='buysell.php?pages=$i'>$i</a></li>";
                    }
                    ?>
                  </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
<div class="modal fade " id="ModalSell" tabindex="-2" role="dialog" aria-labelledby="ModalAddLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content table-responsive p-3">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalAddLabel">Jual Barang</h5>
      </div>
      <div class="modal-body ">  
        <form method="post" action="../system/sellprogress.php">
        <?php   
                $qupdate = "SELECT max(id_trans) as maxKode FROM transaction where jenis = 'Sell' ";
                $rupdate = mysqli_query($mysqli, $qupdate);
                $dupdate = mysqli_fetch_assoc($rupdate);
                $id_trans = $dupdate['maxKode'];
                $no_urut = $id_trans + 1;
                $char = "TS0";
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
            <label for="product">Buyer</label>
              <select class="form-control" id="customer" name="customer">
                <?php
                // Query untuk mendapatkan daftar produk beserta atribut-atributnya
                $query = "SELECT * FROM customer order by nama ASC";
                $result = mysqli_query($mysqli, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                  $id_cust = $row['id_customer'];
                  $kd_cust = $row['kd_customer'];
                  $nama = $row['nama'];
                  $alamat = $row['alamat'];
                  $nohp = $row['nohp'];
                  echo "<option value='$nama'>$nama</option>";
                }
                ?>
              </select>
              <script>
                $(document).ready(function() {
                  $('#customer').select2({
                    maximumSelectionLength: 3, // Batasan jumlah opsi yang dapat dipilih
                    placeholder: 'Pilih Customer',
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
            <label for="product">Produk</label>
              <select class="form-control" id="product2" name="product2" onchange="updateFields2()">
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

                  echo "<option value='$id_barang' data-brg2='$kd_barang' data-supplier2='$supplier' data-stok2='$stok' data-harga2='$harga' data-jenis2='$jenis' data-deskripsi2='$deskripsi'>$nama_brg</option>";
                }
                ?>
              </select>
              <script>
                $(document).ready(function() {
                  $('#product2').select2({
                    maximumSelectionLength: 3, // Batasan jumlah opsi yang dapat dipilih
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
                <label for="stok">Jumlah Beli</label>
                <input type="number" class="form-control" id="stok2" name="stok2" require>
              </div>
              <div class="form-group">
                <label for="pembelian">Pembelian</label>
                <select class="form-control" id="pem" name="pem" required>
                  <option value="" disabled selected>Pilih Cara Bayar</option>
                  <option value="Cash">Cash</option>
                  <option value="Bayar Pakai Qris">Bayar Pakai Qris</option>
                  <option value="Transfer Bank">Transfer Bank</option>
                  <option value="Debit Card">Debit Card</option>
                </select>
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-dark" onclick="addItem2()">Add</button>
              </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label for="harga">kode Barang</label>
                <input type="text" class="form-control" id="kd_brg2" name="kd_brg2" readonly>
              </div>
              <div class="form-group">
                <label for="supplier">Supplier</label>
                <input type="text" class="form-control" id="supplier2" name="supplier2" readonly>
              </div>
              <div class="form-group">
                <label for="harga">Harga</label>
                <input type="text" class="form-control" id="harga2" name="harga2" readonly>
              </div>
              <div class="form-group">
                <label for="jenis">Jenis</label>
                <input type="text" class="form-control" id="jenis2" name="jenis2" readonly>
              </div>
              <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi2" name="deskripsi2" readonly></textarea>
              </div>
            </div>
            
          </div>
          <div class="modal-footer">
            <button type="submit" value="Save" class="btn btn-dark">Simpan</button>
          </div>
          <input type="hidden" name="temporaryData2" id="temporaryData2">
        <table id="addedItemsTable2" class="table align-items-center mb-4">
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
                <td colspan="4" class="text-uppercase font-weight-bold">Grand Total :</td>
                <td id="grandTotalValue2" class="font-weight-bold"></td>
                <td></td>
              </tr>
            </tfoot>
          </thead>
          <tbody id="addedItemsBody2">
          </tbody>
        </table>
        <div class="row">
         <div class="col-md-6">
            <div class="form-group">
                <label for="harga">Uang Yang di terima</label>
                <input type="text" class="form-control" id="uang" name="uang">
            </div>
         </div>
         <div class="col-md-6">
            <div class="form-group">
                <label for="harga">Kembalian</label>
                <input type="text" class="form-control" id="kembalian" name="kembalian">
            </div>
         </div>
        </div>
        </form>
      </div>   
    </div>
  </div>
</div>

<script>
function updateFields2() {
  var productSelect2 = document.getElementById("product2");
  var selectedOption2 = productSelect2.options[productSelect2.selectedIndex];

  var kd = selectedOption2.getAttribute("data-brg2");
  var supplier = selectedOption2.getAttribute("data-supplier2");
  var stok = selectedOption2.getAttribute("data-stok2");
  var harga = selectedOption2.getAttribute("data-harga2");
  var jenis = selectedOption2.getAttribute("data-jenis2");
  var deskripsi = selectedOption2.getAttribute("data-deskripsi2");

  document.getElementById("kd_brg2").value = kd;
  document.getElementById("supplier2").value = supplier;
  document.getElementById("harga2").value = harga;
  document.getElementById("jenis2").value = jenis;
  document.getElementById("deskripsi2").value = deskripsi;
}

function addItem2() {
    var product = $("#product2 option:selected").text();
    var kd_barang = $("#kd_brg2").val();
    var harga = $("#harga2").val();
    var supp = $("#supplier2").val();
    var stok = $("#stok2").val();
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

    $("#addedItemsBody2").append(newRow);
    var temporaryData2 = $("#addedItemsTable2").html();
    $("#temporaryData2").val(temporaryData2);

    var grandTotal2 = 0;
    $("#addedItemsBody2 tr").each(function() {
      var harga2 = parseFloat($(this).find("td:eq(2)").text());
      var jumlahBeli2 = parseFloat($(this).find("td:eq(4)").text());
      var subtotal2 = harga2 * jumlahBeli2;
      grandTotal2 += subtotal2;
    });
    $("#grandTotalValue2").text("Rp."+grandTotal2);

}
$(document).ready(function() {
  // Menangkap event keypress saat tombol Enter ditekan pada input uang yang diterima
  $("#uang").keypress(function(event) {
    // Memastikan tombol yang ditekan adalah tombol Enter (kode 13)
    if (event.which === 13) {
      event.preventDefault(); // Mencegah aksi default pengiriman form
      hitungKembalian();
    }
  });
});

function hitungKembalian() {
  // Mengambil nilai uang yang diterima dan total harga
  var uangDiterima = parseFloat($("#uang").val());
  var grandTotal = 0;
  $("#addedItemsBody2 tr").each(function() {
    var harga = parseFloat($(this).find("td:eq(2)").text());
    var jumlahBeli = parseFloat($(this).find("td:eq(4)").text());
    var subtotal = harga * jumlahBeli;
    grandTotal += subtotal;
  });

  // Menghitung kembalian
  var kembalian = uangDiterima - grandTotal;

  // Memperbarui nilai kembalian
  $("#kembalian").val(kembalian);
}


</script>