<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" ../pages/dashboard.php " target="_blank">
        <img src="../assets/img/logos2.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Point Of Sales A</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'active' : ''; ?>" href="../pages/dashboard.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'Mproduct.php') ? 'active' : ''; ?>" href="../pages/Mproduct.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-box-2 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Management Product</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'supplier.php') ? 'active' : ''; ?>" href="../pages/supplier.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-paper-diploma text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Supplier</span>
          </a>
        </li>
        <li class="nav-item">
        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'Cust.php') ? 'active' : ''; ?>" href="../pages/Cust.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Customer</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'buysell.php') ? 'active' : ''; ?>" href="../pages/buysell.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-cart text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Buy & Sell</span>
          </a>
        </li>
        <li class="nav-item">
        <li class="nav-item">
          <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'Laporan.php') ? 'active' : ''; ?>"" href="../pages/Laporan.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-collection text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Laporan</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Other Option</h6>
        </li> 
        <li class="nav-item">
          <a class="nav-link " href="../index.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Log-out</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
      <div class="card card-plain shadow-none" id="sidenavCard">
        <img class="w-50 mx-auto" src="../assets/img/illustrations/icon-documentation.svg" alt="sidebar_illustration">
        <div class="card-body text-center p-3 w-100 pt-0">
          <div class="docs-info">
            <h6 class="mb-0">POS APPS</h6>
            <p class="text-xs font-weight-bold mb-0">Mempermudah Bukan ?</p>
          </div>
        </div>
      </div>
      <a href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard" target="_blank" class="btn btn-dark btn-sm w-100 mb-3">Documentation</a>
      <a class="btn btn-primary btn-sm mb-0 w-100" href="https://www.creative-tim.com/product/argon-dashboard-pro?ref=sidebarfree" type="button">Call Support</a>
    </div>
  </aside>