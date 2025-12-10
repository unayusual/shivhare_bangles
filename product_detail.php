<?php
require_once 'config/db_connect.php';
require_once 'includes/functions.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product = null;

if ($id > 0) {
    try {
        $stmt = $pdo->prepare("
            SELECT p.*, c.name as category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            WHERE p.id = ?
        ");
        $stmt->execute([$id]);
        $product = $stmt->fetch();
    } catch (PDOException $e) { /* Ignore */ }
}

if (!$product) {
    // Redirect or show error
    header("Location: products.php");
    exit;
}

// Handle Inquiry Submission
$inquiry_sent = false;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_inquiry'])) {
    $name = clean_input($_POST['name']);
    $email = clean_input($_POST['email']);
    $phone = clean_input($_POST['phone']);
    $message = clean_input($_POST['message']);
    
    // Append Product details to message
    $full_message = "Product Inquiry: " . $product['name'] . " (ID: $id)\n\n" . $message;

    try {
        $stmt = $pdo->prepare("INSERT INTO inquiries (product_id, customer_name, email, phone, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$id, $name, $email, $phone, $full_message]);
        $inquiry_sent = true;
    } catch (PDOException $e) { /* Ignore */ }
}

// SEO Meta Tags
if ($product) {
    $page_title = $product['name'];
    $meta_description = substr(strip_tags($product['description']), 0, 160) . "...";
    if ($product['image_path']) {
        $og_image = "uploads/" . $product['image_path'];
    }
}

include 'includes/header.php';
?>

<div class="bg-light py-3 mb-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="products.php">Collection</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($product['name']); ?></li>
            </ol>
        </nav>
    </div>
</div>

<div class="container pb-5">
    <?php if ($inquiry_sent): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Your inquiry has been sent! We will contact you shortly.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6 mb-4">
            <img src="<?php echo get_image_url($product['image_path']); ?>" class="img-fluid border rounded w-100" alt="<?php echo htmlspecialchars($product['name']); ?>">
        </div>
        <div class="col-md-6">
            <h1 class="mb-2 display-5"><?php echo htmlspecialchars($product['name']); ?></h1>
            <p class="text-muted mb-3">Category: <?php echo htmlspecialchars($product['category_name'] ?: 'General'); ?></p>
            
            <?php if ($product['price']): ?>
                <h3 class="text-primary mb-4"><?php echo format_price($product['price']); ?></h3>
            <?php endif; ?>

            <div class="mb-4">
                <h5>Description</h5>
                <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
            </div>

            <button type="button" class="btn btn-primary btn-lg w-100 mb-3" data-bs-toggle="modal" data-bs-target="#inquiryModal">
                Send Inquiry
            </button>
            <p class="small text-muted text-center"><i class="bi bi-shield-lock"></i> Secure & Direct Wholesale Inquiry</p>
        </div>
    </div>
</div>

<!-- Inquiry Modal -->
<div class="modal fade" id="inquiryModal" tabindex="-1" aria-labelledby="inquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="inquiryModalLabel">Inquire about <?php echo htmlspecialchars($product['name']); ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <input type="hidden" name="submit_inquiry" value="1">
                    <div class="mb-3">
                        <label class="form-label">Your Name *</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number *</label>
                        <input type="tel" class="form-control" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea class="form-control" name="message" rows="3">I am interested in this product. Please share more details and wholesale pricing.</textarea>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Submit Inquiry</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
