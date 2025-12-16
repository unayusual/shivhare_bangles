<?php
require_once 'config/db_connect.php';
require_once 'includes/functions.php';

// Fetch Featured Products
$featured_products = [];
try {
    $stmt = $pdo->query("SELECT * FROM products WHERE is_featured = 1 ORDER BY created_at DESC LIMIT 4");
    $featured_products = $stmt->fetchAll();
} catch (PDOException $e) {
    // If table doesn't exist yet or DB error, verify gracefully
    // error_log($e->getMessage());
}

// SEO Meta Tags
$meta_description = "Shivhare Bangle Store is a leading manufacturer and wholesaler of glass bangles in Firozabad. Explore our latest bridal and daily wear collection.";
$og_image = "assets/images/hero-bg.jpg";

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-slider">
        <div class="hero-slide" style="background-image: url('assets/images/hero-bg-1.png');"></div>
        <div class="hero-slide" style="background-image: url('assets/images/hero-bg-2.png');"></div>
        <div class="hero-slide" style="background-image: url('assets/images/hero-bg-3.png');"></div>
    </div>
    <div class="hero-content">
        <h1>Timeless Elegance in Glass</h1>
        <p>Discover the finest collection of wholesale glass bangles. Tradition meets modern craftsmanship.</p>
        <a href="products.php" class="btn btn-primary btn-lg me-3">Explore Collection</a>
        <a href="contact.php" class="btn btn-outline-light btn-lg">Contact Us</a>
    </div>
    <div class="hero-overlay"></div>
</section>

<!-- Features Section -->
<section class="section-padding">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="p-4 border h-100">
                    <h3 class="mb-3">Premium Quality</h3>
                    <p>Crafted with precision using the best quality glass materials for durability and shine.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4 border h-100 bg-light">
                    <h3 class="mb-3">Wholesale Rates</h3>
                    <p>Best competitive prices for bulk orders. Perfect for retailers and distributors.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4 border h-100">
                    <h3 class="mb-3">Wide Variety</h3>
                    <p>Thousands of designs, colors, and patterns to suit every market demand.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<?php if (!empty($featured_products)): ?>
<section class="section-padding bg-light">
    <div class="container">
        <div class="section-title">
            <h2>Featured Collection</h2>
        </div>
        <div class="row">
            <?php foreach ($featured_products as $product): ?>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card product-card">
                    <img src="<?php echo get_image_url($product['image_path']); ?>" class="card-img-top product-img" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                        <?php if ($product['price']): ?>
                            <p class="text-muted"><?php echo format_price($product['price']); ?></p>
                        <?php endif; ?>
                        <a href="product_detail.php?id=<?php echo $product['id']; ?>" class="btn btn-sm btn-outline-dark">View Details</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="products.php" class="btn btn-primary">View All Products</a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- About Preview -->
<section class="section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="section-title text-start">
                    <h2>About Shivhare Bangles</h2>
                </div>
                <p>Since our inception, Shivhare Bangle Store has been a trusted name in the glass bangle industry. Based in the heart of the bangle city, we specialize in manufacturing and trading high-quality glass bangles that define culture and elegance.</p>
                <p>We supply to major wholesale markets across the country, ensuring safe packaging and timely delivery.</p>
                <a href="about.php" class="btn btn-outline-dark mt-3">Read Our Story</a>
            </div>
            <div class="col-md-6">
                <!-- Fallback image or a generic bangle image if available -->
                <!-- Fallback image or a generic bangle image if available -->
                <img src="assets/images/about-preview.png" alt="Shivhare Bangles Store" class="img-fluid rounded shadow-lg">
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
