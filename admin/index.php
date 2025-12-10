<?php
require_once 'includes/auth_check.php';
require_once '../config/db_connect.php';

// Fetch User Info
// $username = $_SESSION['username'];

// Fetch Stats
$stats = [
    'products' => 0,
    'categories' => 0,
    'inquiries' => 0,
    'new_inquiries' => 0
];

try {
    $stats['products'] = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
    $stats['categories'] = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();
    $stats['inquiries'] = $pdo->query("SELECT COUNT(*) FROM inquiries")->fetchColumn();
    $stats['new_inquiries'] = $pdo->query("SELECT COUNT(*) FROM inquiries WHERE status = 'new'")->fetchColumn();
} catch (PDOException $e) { /* Ignore */ }

include 'includes/header.php';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card bg-primary text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-0">Total Products</h6>
                        <h2 class="my-2"><?php echo $stats['products']; ?></h2>
                    </div>
                    <i class="bi bi-box-seam fs-1 opacity-50"></i>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0">
                <a href="products.php" class="text-white text-decoration-none small">Manage Products &rarr;</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card bg-success text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-0">Total Categories</h6>
                        <h2 class="my-2"><?php echo $stats['categories']; ?></h2>
                    </div>
                    <i class="bi bi-tags fs-1 opacity-50"></i>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0">
                <a href="categories.php" class="text-white text-decoration-none small">Manage Categories &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card bg-warning text-dark h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-0">New Inquiries</h6>
                        <h2 class="my-2"><?php echo $stats['new_inquiries']; ?></h2>
                        <small>Total: <?php echo $stats['inquiries']; ?></small>
                    </div>
                    <i class="bi bi-envelope fs-1 opacity-50"></i>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0">
                <a href="inquiries.php" class="text-dark text-decoration-none small">View Inquiries &rarr;</a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Quick Actions
            </div>
            <div class="card-body">
                <a href="products.php?action=add" class="btn btn-outline-primary me-2"><i class="bi bi-plus-lg"></i> Add New Product</a>
                <a href="categories.php?action=add" class="btn btn-outline-success"><i class="bi bi-plus-lg"></i> Add New Category</a>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
