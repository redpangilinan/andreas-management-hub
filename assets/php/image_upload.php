<?php
$dir = "../../images/products/";
$file_name = $_FILES['image']['name'];
$file_tmp_name = $_FILES['image']['tmp_name'];
$ext = array("jpg", "jpeg", "png", "bmp");
$split = explode('.', $file_name);
$image_ext = strtolower(end($split));

if (empty($_FILES['image']['tmp_name'])) {
    $file_name = 'default.jpg';
} else {
    if (in_array($image_ext, $ext)) {
        $file_name = uniqid() . "-" . time() . "-" . date("Y-m-d") . "." . $image_ext;

        // Compress the image using the GD library
        $image = imagecreatefromstring(file_get_contents($file_tmp_name));
        if ($image_ext == "png") {
            imagepng($image, "$dir" . $file_name, 9); // Adjust the compression level as needed
        } else {
            imagejpeg($image, "$dir" . $file_name, 75); // Adjust the compression level as needed
        }
        imagedestroy($image);
    } else {
        $file_name = 'default.jpg';
        echo "no image ";
    }
}
