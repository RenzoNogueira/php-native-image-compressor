<?php

/**
 * @author Renzo Nogueira
 * 2020/14/01
 * 
 * Example of how to use the tool.
 */

include_once "lib/image-compressor.php";

// Array with base64 and binary image
$compressedImage = CompressImage::compress("img/image.jpg", 'compress/', 'new_image', 200, 200, 75, 'jpeg');

// echo $compressedImage['base64'];
// echo $compressedImage['binary'];
