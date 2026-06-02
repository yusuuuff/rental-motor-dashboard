<div class="d-flex">

    <!-- Sidebar -->
    <div class="sidebar border-end">
        <h4><i class="bi bi-bicycle me-2"></i>Rental Motor</h4>
        
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= (basename(dirname($_SERVER['PHP_SELF'])) == 'dashboard') ? 'active' : '' ?>" 
                   href="../dashboard/index.php">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= (basename(dirname($_SERVER['PHP_SELF'])) == 'motor') ? 'active' : '' ?>" 
                   href="../motor/index.php">
                    <i class="bi bi-database"></i> Data Motor
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= (basename(dirname($_SERVER['PHP_SELF'])) == 'transaksi') ? 'active' : '' ?>" 
                   href="../transaksi/index.php">
                    <i class="bi bi-cash-stack"></i> Transaksi
                </a>
            </li>
            <li class="nav-item mt-4">
                <hr class="text-secondary">
                <a class="nav-link text-danger" href="../auth/logout.php">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="container-fluid p-4" style="background-color: #f8f9fa; min-height: 100vh;">