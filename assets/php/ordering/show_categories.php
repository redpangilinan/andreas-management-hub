<?php
include "./assets/php/connection.php";

// Fetch distinct categories from database
$query =
    "SELECT category, COUNT(product_id) AS product_count, MIN(image) AS image, MIN(product_id) AS min_product_id 
    FROM tb_products 
    WHERE status = 'Available' 
    GROUP BY category
    ORDER BY category DESC";
$result = mysqli_query($conn, $query);

// Print categories in desired format
while ($row = mysqli_fetch_assoc($result)) {
    echo '
    <a class="category-tab w-100" href="#" data-category="' . $row['category'] . '" data-count="' . $row['product_count'] . '">
        <div class="prod-navi-img">
            <div class="circle-bg"><img src="./assets/images/products/' . $row['image'] . '" alt="" class="rounded-circle"></div>
        </div>
        <span class="d-inline-block text-truncate" style="max-width: 100px;">' . $row['category'] . '</span>
    </a>';
}

// Close database connection
mysqli_close($conn);
