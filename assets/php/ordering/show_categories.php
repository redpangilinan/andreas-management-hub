<?php
include "./assets/php/connection.php";

// Fetch distinct categories from database
$query =
    "SELECT category, MIN(image) AS image, MIN(product_id) AS min_product_id 
    FROM tb_products 
    WHERE status = 'Available' 
    GROUP BY category
    ORDER BY min_product_id ASC";
$result = mysqli_query($conn, $query);

// Print categories in desired format
while ($row = mysqli_fetch_assoc($result)) {
    echo '
    <a href="#home">
        <div class="prod-navi-img">
            <div class="circle-bg"><img src="./assets/images/products/' . $row['image'] . '" alt="" class="rounded-circle"></div>
        </div>' . $row['category'] . '
    </a>';
}

// Close database connection
mysqli_close($conn);
