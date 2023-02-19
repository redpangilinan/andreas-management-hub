<?php
if (!empty($_FILES['image'])) {
    $dir = "./";
    $filename = $_FILES['image']['name'];
    $file_tmp_name = $_FILES['image']['tmp_name'];
    $ext = array("jpg", "png", "jpeg", "bmp");
    $split = explode('.', $filename);
    $image_ext = strtolower(end($split));

    if (in_array($image_ext, $ext)) {
        move_uploaded_file($file_tmp_name, "$dir" . $filename);
        $image = $filename;
    } else {
        $image = 'default.jpg';
        echo "name: " . $filename . " tmp name: " . $file_tmp_name;
    }
} else {
    $image = 'default.jpg';
    echo "No file uploaded.";
}
