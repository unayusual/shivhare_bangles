<?php
// includes/functions.php

/**
 * Sanitize input data
 */
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Format price currency
 */
function format_price($price) {
    return '₹' . number_format($price, 2);
}

/**
 * Get Image URL or Placeholder
 */
function get_image_url($path) {
    if (!empty($path) && file_exists('uploads/' . $path)) {
        return 'uploads/' . $path;
    }
    // Return a placeholder or default image
    return 'https://via.placeholder.com/300x300?text=No+Image'; 
}
?>
