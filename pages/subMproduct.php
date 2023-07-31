<div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Stok Barang Yang Menipis</h6>
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
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $limits = 5; // Jumlah baris yang ingin ditampilkan per halaman
                    $pages = isset($_GET['pages']) ? $_GET['pages'] : 1; // Mengambil nomor halaman dari parameter URL
                    $start = ($pages - 1) * $limits; // Menghitung baris awal yang akan ditampilkan
                    $hasill ="SELECT * FROM product WHERE stok < 30 LIMIT $start, $limit";			
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
                        <p class="badge badge-sm bg-gradient-danger"><?php echo $r['stok']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Rp.<?php echo $r['harga']; ?></p>
                      </td>                   
                    </tr>
                    <?php } ?> 
                  </tbody>
                </table>
                <ul class="pagination justify-content-center" > 
                    <?php
                    $result = mysqli_query($mysqli, "SELECT COUNT(*) AS totals FROM product WHERE stok < 30 LIMIT $start, $limit");
                    $row = mysqli_fetch_assoc($result);
                    $totalPagess = ceil($row['totals'] / $limits); // Menghitung total halaman
                      for ($i = 1; $i <= $totalPagess; $i++) {
                      $actives = ($i == $pages) ? 'active' : '';
                      echo "<li class='page-item $actives'><a class='bg-gradient-dark page-link' href='Mproduct.php?pages=$i'>$i</a></li>";
                    }
                    ?>
                  </ul>
              </div>
            </div>
          </div>
        </div>
      </div>