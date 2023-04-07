<?php
include "./assets/php/connection.php";

// Query the database for all products
$query = "SELECT product_id, product, category, details, price, image FROM tb_products ORDER BY category";
$result = mysqli_query($conn, $query);

// Initialize a variable to keep track of the current category
$current_category = null;

// Loop through the results and print the products
while ($row = mysqli_fetch_assoc($result)) {
    $category = $row['category'];
    $product = $row['product'];
    $price = $row['price'];
    $image = $row['image'];
    $details = $row['details'];

    // If this is the first product or a new category, print the category header
    if ($current_category == null || $category != $current_category) {
        // Close the previous product container, if any
        if ($current_category != null) {
            echo "</div>";
        }
        // Open a new product container for this category
        echo "<h3>$category</h3>";
        echo "<div class='product-container'>";
        $current_category = $category;
    }

    // Print the product
    echo "
    <div class='product' data-bs-toggle='modal' data-bs-target='#orderModal'>
        <img src='./assets/images/products/$image' alt=''>
        <div class='product-text'>
            <h5>$product</h5>
            <span>$details</span>
            <h4>₱$price</h4>
        </div>
    </div>
    ";
}

// Close the final product container
if ($current_category != null) {
    echo "</div>";
}

// Close the database connection
mysqli_close($conn);
