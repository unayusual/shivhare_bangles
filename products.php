<?php
require_once 'config/db_connect.php';
require_once 'includes/functions.php';

// Get current category
$category_id = isset($_GET['category']) ? (int)$_GET['category'] : 0;

// Fetch Categories
$categories = [];
try {
    $stmt = $pdo->query("SELECT * FROM categories ORDER BY name ASC");
    $categories = $stmt->fetchAll();
} catch (PDOException $e) { /* Ignore */ }

// Fetch Products
$products = [];
try {
    if ($category_id > 0) {
        $stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = ? ORDER BY created_at DESC");
        $stmt->execute([$category_id]);
    } else {
        $stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC");
    }
    $products = $stmt->fetchAll();
} catch (PDOException $e) { /* Ignore */ }

include 'includes/header.php';
?>

<div class="bg-light py-3 mb-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Collection</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container pb-5">
    <div class="row">
        <!-- Sidebar Categories -->
        <div class="col-md-3">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Categories</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="products.php" class="list-group-item list-group-item-action <?php echo ($category_id === 0) ? 'active' : ''; ?>">
                        All Products
                    </a>
                    <?php foreach ($categories as $cat): ?>
                        <a href="products.php?category=<?php echo $cat['id']; ?>" class="list-group-item list-group-item-action <?php echo ($category_id == $cat['id']) ? 'active' : ''; ?>">
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="col-md-9">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <h2><?php echo ($category_id > 0) ? 'Category Filter' : 'All Products'; ?></h2>
                <span class="text-muted"><?php echo count($products); ?> Products Found</span>
            </div>

            <?php if (empty($products)): ?>
                <div class="alert alert-info">
                    No products found in this category.
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($products as $product): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card product-card">
                            <img src="<?php echo get_image_url($product['image_path']); ?>" class="card-img-top product-img" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                                <?php if ($product['price']): ?>
                                    <p class="text-secondary fw-bold"><?php echo format_price($product['price']); ?></p>
                                <?php endif; ?>
                                <a href="product_detail.php?id=<?php echo $product['id']; ?>" class="btn btn-outline-primary w-100 mt-2">View Details</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
