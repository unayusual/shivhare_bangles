<?php
require_once 'config/db_connect.php';
require_once 'includes/functions.php';

$message_sent = false;
$error_msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = clean_input($_POST['name']);
    $email = clean_input($_POST['email']);
    $phone = clean_input($_POST['phone']);
    $message = clean_input($_POST['message']);

    if (empty($name) || empty($message)) {
        $error_msg = "Name and Message are required.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO inquiries (customer_name, email, phone, message) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $email, $phone, $message]);
            $message_sent = true;
        } catch (PDOException $e) {
            $error_msg = "Failed to send message. Please try again later.";
            // error_log($e->getMessage());
        }
    }
}

include 'includes/header.php';
?>

<section class="section-padding bg-light">
    <div class="container">
        <div class="section-title">
            <h2>Contact Us</h2>
        </div>
        
        <div class="row">
            <div class="col-md-5 mb-4">
                <div class="bg-white p-4 shadow-sm h-100">
                    <h4 class="mb-4">Get In Touch</h4>
                    <p class="mb-3">
                        <i class="bi bi-geo-alt-fill text-primary me-2"></i>
                        <strong>Address:</strong><br>
                        Shivhare Bangle Store,<br>
                        Gali Bohran,<br>
                        Firozabad - 283203, Uttar Pradesh, India
                    </p>
                    <p class="mb-3">
                        <i class="bi bi-telephone-fill text-primary me-2"></i>
                        <strong>Phone:</strong><br>
                        +91 78178 53821
                    </p>
                    <p class="mb-3">
                        <i class="bi bi-envelope-fill text-primary me-2"></i>
                        <strong>Email:</strong><br>
                        shivharebanglesstore@gmail.com
                    </p>
                    <p class="mb-3">
                        <i class="bi bi-clock-fill text-primary me-2"></i>
                        <strong>Hours:</strong><br>
                        Mon - Sat: 10:00 AM - 7:00 PM
                    </p>
                </div>
            </div>
            
            <div class="col-md-7 mb-4">
                <div class="bg-white p-4 shadow-sm h-100">
                    <h4 class="mb-4">Send Inquiry</h4>
                    
                    <?php if ($message_sent): ?>
                        <div class="alert alert-success">
                            Thank you for your inquiry! We will get back to you soon.
                        </div>
                    <?php elseif ($error_msg): ?>
                        <div class="alert alert-danger">
                            <?php echo $error_msg; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="contact.php">
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name *</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message *</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit Inquiry</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
