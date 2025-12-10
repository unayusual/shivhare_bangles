<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' | ' . (defined('SITE_NAME') ? SITE_NAME : 'Shivhare Bangle Store') : (defined('SITE_NAME') ? SITE_NAME : 'Shivhare Bangle Store - Wholesale Glass Bangles'); ?></title>
    <meta name="description" content="<?php echo isset($meta_description) ? $meta_description : 'Premium wholesale glass bangles from Firozabad. Traditional and modern designs directly from the manufacturer. Best prices for bulk orders.'; ?>">
    <meta name="keywords" content="glass bangles, wholesale bangles, firozabad bangles, chudi market, indian jewelry, bridal bangles, shivhare bangles">
    <meta name="author" content="Shivhare Bangle Store">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">
    <meta property="og:title" content="<?php echo isset($page_title) ? $page_title : 'Shivhare Bangle Store'; ?>">
    <meta property="og:description" content="<?php echo isset($meta_description) ? $meta_description : 'Premium wholesale glass bangles from Firozabad.'; ?>">
    <meta property="og:image" content="<?php echo isset($og_image) ? $og_image : 'assets/images/about-preview.png'; ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">
    <meta property="twitter:title" content="<?php echo isset($page_title) ? $page_title : 'Shivhare Bangle Store'; ?>">
    <meta property="twitter:description" content="<?php echo isset($meta_description) ? $meta_description : 'Premium wholesale glass bangles from Firozabad.'; ?>">
    <meta property="twitter:image" content="<?php echo isset($og_image) ? $og_image : 'assets/images/about-preview.png'; ?>">

    <!-- Schema.org JSON-LD -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "Shivhare Bangle Store",
      "image": "assets/images/about-preview.png",
      "description": "Premium wholesale glass bangles manufacturer and supplier in Firozabad.",
      "telephone": "+91 78178 53821",
      "email": "shivharebanglesstore@gmail.com",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Gali Bohran",
        "addressLocality": "Firozabad",
        "postalCode": "283203",
        "addressCountry": "IN"
      },
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday"
        ],
        "opens": "10:00",
        "closes": "23:00"
      },
      "priceRange": "₹₹"
    }
    </script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            Shivhare Bangles
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="products.php">Collection</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
